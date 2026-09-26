# Standard Operating Procedure (SOP)
# Working With Hauberk Capital

## Purpose
This SOP explains how this project is structured, how it runs, and how to make changes safely.

It is based on the current repository state and should be updated if routes, providers, or deployment conventions change.

## Project Summary
This repository is a Laravel 10 application used as a bilingual corporate website and CMS.

Core characteristics:
- Backend framework: Laravel 10
- PHP version: `^8.1`
- Admin/CMS: Filament `3.3`
- Frontend rendering: Blade templates
- Frontend styling/runtime: mostly static assets, CDN Tailwind, inline JS, and Blade-driven content
- Media handling: Spatie Media Library plus Filament file uploads
- Security on public forms: Google reCAPTCHA v3
- Authentication/API: Laravel Sanctum is installed, but the public API is minimal

## High-Level Architecture
The project has two main surfaces:

1. Public website
- Public routes are defined in `routes/web.php`
- Most frontend pages are handled by `App\Http\Controllers\Admin\FrontendController`
- Pages render Blade views in `resources/views`
- Global layout and SEO/meta tags are centralized in `resources/views/app.blade.php`
- Site-wide settings come from `App\Models\WebsiteSettings`

2. Admin dashboard / content management
- Filament resources live under `app/Filament/Admin/Resources`
- The registered main panel is `App\Providers\Filament\DashboardPanelProvider`
- The current dashboard path is `/dashboard`
- A secondary provider exists at `App\Providers\Filament\ViewPanelProvider` with path `/view`, but it points to `app/Filament/View/...`, which is not populated in the current codebase

Important note:
- Older docs in this repository may refer to `/admin`
- In the current codebase, `config/app.php` registers `DashboardPanelProvider` and `ViewPanelProvider`
- `AdminPanelProvider` exists but is not currently registered in `config/app.php`
- Treat `/dashboard` as the primary Filament entry point unless the environment has been customized outside this repo

## Key Directories
- `app/Http/Controllers/Admin/FrontendController.php`: main public-site controller
- `app/Http/Controllers/NewsletterController.php`: newsletter popup subscription endpoint
- `app/Filament/Admin/Resources`: Filament CMS resources
- `app/Filament/Admin/Pages`: custom Filament pages
- `app/Filament/Forms/Components`: shared Filament form components
- `app/Models`: Eloquent models
- `app/Notifications`: email notifications for submissions
- `app/Providers`: application and Filament providers
- `database/migrations`: schema history
- `database/seeders`: content and setup seeders
- `resources/views`: Blade templates for public pages and Filament overrides
- `resources/css` and `resources/js`: Vite inputs
- `public/design`: public static design assets referenced by the views

## Request Flow
Most public pages follow this pattern:
- Route in `routes/web.php`
- Method in `FrontendController`
- Data loaded from one or more models
- Blade view returned from `resources/views/...`

Example categories already present:
- Home page content
- About and teams pages
- Services pages
- Blog and case studies
- Careers and contact pages
- Legal pages
- Appointment and meeting request flows
- Tools/risk assessment flow

## Content Management Pattern
Most editable pages are database-backed and managed through Filament resources.

Typical pattern:
1. A model stores page content or records.
2. A Filament resource exposes form fields to editors.
3. The public controller loads the first active record or the first record overall.
4. A Blade view renders the content with English/Arabic fallbacks.

Common examples:
- `Home`, `About`, `Blog`, `WebsiteSettings`
- service-specific content models such as `CioServices`, `InvestmentServices`, `WealthServices`, and `GovernanceServices`
- submission models such as `Contact`, `Appointment`, `MeetingRequest`, and `CareerApplication`

### Page Content Resource vs Submission Resource
This repository now uses two distinct CMS patterns for public-facing forms and content pages:

- Page-content resources own the words, labels, hero images, CTA copy, button URLs, and other presentation-layer content seen by visitors.
- Submission resources own the records created when visitors submit forms.

Current examples:
- `PageResource` stores singleton-like page settings for FAQ, Request Meeting, Blog list/detail, Case Studies list/detail, Articles list/detail, Books list/detail, and Glossaries list/detail.
- `AppointmentPageResource`, `ContactUsResource`, `CareersResource`, `HomeResource`, and similar resources store singleton page content for their specific public pages.
- `MeetingRequestResource`, `AppointmentResource`, `ContactResource`, `CareerApplicationResource`, `NewsletterSubscriptionResource`, and `ToolsSubmissionResource` store inbox/submission data and should not be treated as page-copy editors.

Practical rule:
- If you need to change labels, headings, CTA text, hero images, or page-specific URLs, inspect the page-content resource first.
- If you need to review what a visitor submitted, inspect the submission resource first.

### Generic `Page` Model Pattern
The `Page` model is now the reusable store for public page chrome where a full dedicated singleton model would be excessive.

It is used for:
- FAQ page copy and FAQ accordion items
- Request Meeting page copy and dynamic field labels/options
- Blog and Case Studies list/detail page chrome
- Articles, Books, and Glossaries list/detail page chrome

How it works:
- `slug` identifies the page surface, for example `faq`, `request-meeting`, `blog-list`, or `case-studies-detail`
- Filament editors manage these records through `PageResource`
- `FrontendController` loads the `Page` record by slug and passes it to the Blade view as `pageContent`
- Blade templates fall back to hardcoded defaults only when the page record is still empty or missing

Supported slugs currently wired into the frontend:
- `faq`
- `request-meeting`
- `blog-list`
- `blog-detail`
- `case-studies-list`
- `case-studies-detail`
- `articles-list`
- `articles-detail`
- `books-list`
- `books-detail`
- `glossaries-list`
- `glossaries-detail`

## Localization
This project supports at least two locales:
- `en`
- `ar`

How localization works:
- Locale switch route: `lang/{locale}`
- Locale is stored in session
- `AppServiceProvider` sets the app locale from session
- Many views use paired English/Arabic columns such as `title_en` and `title_ar`
- Fallback logic is often handled inline in Blade or via small closures

Blade localization safety rules:
- If a Blade `@php` block defines a locale flag like `$isArabic`, define it before any closures that depend on it.
- If an anonymous function in Blade uses a local variable, capture it explicitly with `use (...)`. Example: `function ($en, $ar) use ($isArabic) { ... }`.
- Do not assume a variable defined outside a closure is automatically available inside the closure. This caused a real runtime error on the appointment page: `Undefined variable $isArabic`.
- When copying a localization helper between views, re-check both variable initialization order and closure scope before testing the page.

When editing content structures:
- Preserve both language fields where the model already supports them
- Do not add English-only fields to a bilingual model unless that is explicitly intended

## Layout, SEO, and Tracking
`resources/views/app.blade.php` is the main public layout and includes:
- SEO title, description, keywords, canonical URL
- Open Graph and Twitter metadata
- GTM, Google Analytics, Facebook, Twitter, LinkedIn, and TikTok tracking snippets
- site favicon handling
- Tailwind CDN
- Google reCAPTCHA script
- shared typography and visual styles

`WebsiteSettings` is central to many site-wide behaviors, so changes there can affect every page.

## Forms and Submission Workflows
Several public forms post into controller methods and store data in the database.

Current important form flows:
- Contact form -> `storeContact()`
- Appointment booking -> `storeAppointment()`
- Meeting request -> `storeMeetingRequest()`
- Career application -> `storeCareerApplication()`
- Tools/risk assessment -> `risk_assessments()`
- Newsletter popup -> `NewsletterController::subscribe()`

Common behavior:
- validation is performed server-side
- reCAPTCHA validation is enforced when configured
- records are persisted in DB
- notifications are sent via Laravel notifications to fixed email addresses

Important distinction after the CMS editability rollout:
- the Request Meeting page copy now lives in `PageResource` under the `request-meeting` slug
- the submitted meeting-request records still live in `MeetingRequestResource`
- the Appointment booking page copy still lives in `AppointmentPageResource`
- the submitted appointment records still live in `AppointmentResource`
- the simplified Appointment editor currently focuses on three content areas: Hero, Form intro, and Ready To Start Growing
- Appointment Hero and Ready section text is bilingual: English stays in the original columns and Arabic lives in dedicated `_ar` columns

Before changing a public form:
- inspect both the Blade view and the controller method
- inspect the related model and migration
- verify reCAPTCHA action names still match the frontend widget
- verify email notifications still receive the fields they expect

## Dynamic Tools Form
The tools/risk assessment form is more dynamic than the others.

It currently works like this:
- form field definitions are stored in the database via `ToolsFormField`
- validation rules are assembled dynamically in `FrontendController::risk_assessments()`
- submissions are stored in `ToolsSubmission`

If you change tools form behavior:
- update both field definitions and storage expectations
- verify checkbox/select/radio validation carefully
- manually submit at least one test payload after changes

## Blog and Similar Content Resources
The blog area is a good example of the current Filament pattern:
- resource file in `app/Filament/Admin/Resources/BlogResource.php`
- tabs for grouped content editing
- custom rich editor usage
- SEO tab reuse
- list table with filters and sorting
- public route handled by `FrontendController::blog()` and `FrontendController::blogShow()`

Use the same pattern when extending or standardizing similar resources.

Related editorial resources restored for legacy routed pages:
- `ArticleResource`
- `BookResource`
- `GlossaryResource`

These resources manage the record-level content, while `PageResource` manages the surrounding list/detail page copy.

## Seeders and Initial Data
There are many seeders in `database/seeders`, but `DatabaseSeeder` currently calls only:
- `CioServicesSeeder`
- `InvestmentServicesSeeder`
- `WealthServicesSeeder`

This means:
- `php artisan db:seed` does not fully populate all site content
- if you need page defaults for another area, run the specific seeder explicitly or wire it into `DatabaseSeeder`

When adding a new content area:
- create the model and migration
- create a seeder if the page needs defaults
- decide whether that seeder should be included in `DatabaseSeeder`

For the generic page-content system:
- `php artisan migrate` now creates baseline `pages.slug` records for the wired page surfaces if they do not already exist
- editors can then fill those records through `PageResource` without hand-creating them in SQL

## Frontend Asset Workflow
Vite is configured in:
- `package.json`
- `vite.config.js`

Current configured inputs:
- `resources/css/app.css`
- `resources/js/app.js`

However, much of the public site currently relies on:
- Blade markup
- static files under `public/design`
- CDN Tailwind
- inline styles/scripts

Practical guidance:
- if you are only editing Blade markup or static assets, Vite may not be involved
- if you introduce or modify code that depends on `resources/css/app.css` or `resources/js/app.js`, run the Vite workflow as needed
- do not assume the marketing site is fully driven by Vite

## Local Setup
Recommended setup flow:

1. Install dependencies
```bash
composer install
npm install
```

2. Create environment file
```bash
cp .env.example .env
php artisan key:generate
```

3. Configure environment values
- database credentials
- app URL
- mail settings
- reCAPTCHA keys if testing protected forms
- storage/disks if working with uploads

4. Prepare database
```bash
php artisan migrate
php artisan db:seed
```

5. Link storage for uploads if needed
```bash
php artisan storage:link
```

6. Start development services
```bash
php artisan serve
npm run dev
```

Notes:
- `npm run dev` is only necessary when your changes depend on Vite-managed assets
- Sail is listed in Composer dependencies, but this repo does not currently include a root `docker-compose.yml`

## Useful Commands
```bash
php artisan route:list
php artisan migrate:status
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan test
```

Useful targeted commands:
```bash
php artisan db:seed --class=HomeSeeder
php artisan db:seed --class=WebsiteSettingsSeeder
php artisan db:seed --class=BlogSeeder
```

## How To Work Safely In This Repo
Before making changes:
- run `git status`
- check whether the worktree already contains unrelated edits
- identify whether you are changing public pages, admin resources, database schema, or form workflows

When changing existing features:
- trace the route -> controller -> model -> Blade view path first
- check whether the same data is also edited through a Filament resource
- preserve bilingual fields and SEO fields when present
- do not assume seeders or defaults cover missing records

When changing Filament resources:
- inspect the matching model and migration before changing form fields
- keep field names aligned with DB columns
- if the resource uses shared form components, review those components before replacing behavior

When changing public pages:
- inspect the page view and the main layout
- confirm whether content is hardcoded, DB-backed, or mixed
- verify both English and Arabic rendering
- if the page uses a Blade `@php` helper closure, verify every referenced local variable is either passed with `use (...)` or moved out of the closure
- if you add new view variables in the controller, confirm the Blade template does not reference them before initialization

When changing forms:
- test validation errors and successful submissions
- verify reCAPTCHA behavior
- confirm DB persistence
- confirm notification delivery logic still matches the stored data

Appointment-page specific implementation notes:
- `resources/views/calendar/calendar.blade.php` must localize Hero and Ready section copy with the same `$localize` helper used elsewhere on the page
- the public Hero heading should prefer `AppointmentPage` content before falling back to SEO `h1`, otherwise dashboard edits can appear to "not work"
- if new Appointment text fields are added, add DB columns first, then update `AppointmentPage::$fillable`, then update `AppointmentPageResource`
- if a full `php artisan migrate` is blocked by unrelated migrations, run the targeted appointment migration with `php artisan migrate --path=...` so the editor fields actually persist

When changing schema:
- add a migration rather than editing old migrations in an active project
- update model casts and fillable fields if needed
- update Filament resources and controllers that depend on the changed columns

## Verification Checklist
Because automated tests are minimal in this repository, every substantial change should include focused manual verification.

Minimum checks:
- page loads without exceptions
- Filament resource form loads and saves
- changed frontend page renders in both `en` and `ar`
- images/files still load correctly
- no obvious console or PHP errors

Recommended checks by change type:
- content model changes: open the relevant Filament resource and the public page
- route/controller changes: run `php artisan route:list`
- schema changes: run `php artisan migrate`
- Blade/layout changes: spot-check SEO tags and shared header/footer behavior
- reCAPTCHA/form changes: submit the form end-to-end
- Blade runtime fixes: run `php artisan view:clear` after the change so stale compiled templates do not mask or repeat old errors

Page-editability specific checks:
- open `PageResource` and confirm the expected slug record exists
- save a text change in the slug record and reload the matching public page
- for Request Meeting, verify edited labels still submit successfully to `storeMeetingRequest()`
- for Appointment, verify edited step labels and field labels still progress through the two-step flow
- for Appointment Hero and Ready sections, verify both `en` and `ar` content from `AppointmentPageResource` render on the public page when locale changes
- for Appointment Hero specifically, if the dashboard value saves but the frontend still shows the old heading, check whether SEO `h1` is incorrectly overriding the page-model value
- for legacy Articles/Books/Glossaries, verify the restored Filament CRUD can save record updates and that the list/detail pages reflect them
- for Appointment specifically, verify any localized helper closure in `resources/views/calendar/calendar.blade.php` captures `$isArabic` with `use ($isArabic)`

## Known Project Gotchas
These items should be checked before assuming behavior:

1. Admin path confusion
- Some docs mention `/admin`
- Current registered primary Filament path is `/dashboard`

2. Secondary view panel
- `/view` is registered through `ViewPanelProvider`
- the expected `app/Filament/View/...` structure is not currently populated

3. Duplicate-looking routes
- `routes/web.php` contains repeated definitions such as `/about-us` and `/contact-us`
- last matching route definition wins, so be careful when editing route files

4. Broad panel access
- `App\Models\User::canAccessPanel()` currently returns `true`
- this is important for security reviews and production hardening

5. Seeders are selective
- `DatabaseSeeder` does not populate all content areas

6. In-flight resource churn
- this repository currently shows signs of active refactoring in Filament resources
- check the latest git state before renaming or deleting related resources or models

7. Blade closure scope pitfalls
- some public templates use inline helper closures inside `@php`
- PHP closures do not automatically inherit local variables from the surrounding scope
- if a closure needs `$isArabic` or a similar flag, it must capture it explicitly with `use (...)`
- after fixing Blade runtime errors, clear compiled views with `php artisan view:clear`

8. Appointment page precedence and migration traps
- `resources/views/calendar/calendar.blade.php` previously preferred SEO `h1` over `AppointmentPage.hero_title`, which masked dashboard edits
- fix that by making the Blade view prefer the page-model field first and using SEO only as fallback
- when adding extra Appointment editor fields, saving in Filament is not enough unless the matching migration has already run
- in this project, a blocked unrelated migration can make new Appointment fields appear broken even though the resource UI was updated

## Recommended Workflow For New Features
Use this order unless the feature is intentionally small:

1. Confirm whether the feature is public, admin-only, or both.
2. Identify the model and table that will own the data.
3. Add migration and model updates.
4. Add or update the Filament resource if editors need CMS access.
5. Add or update controller methods and routes.
6. Add or update Blade views.
7. Add defaults via seeder only if the feature requires baseline content.
8. Run focused verification in both admin and public flows.

## Recommended Workflow For Bug Fixes
1. Reproduce the issue from the route or Filament page.
2. Trace the exact controller/resource/model/view path.
3. Confirm whether the problem is data-related, schema-related, or rendering-related.
4. Apply the smallest safe fix.
5. Verify the affected page/form/resource end-to-end.

## Files Worth Reading Before Major Work
- `routes/web.php`
- `app/Http/Controllers/Admin/FrontendController.php`
- `resources/views/app.blade.php`
- the relevant model in `app/Models`
- the relevant Filament resource in `app/Filament/Admin/Resources`
- `database/migrations/*` for the area you are changing
- `database/seeders/*` if the feature depends on seeded defaults
- `RECAPTCHA_SETUP.md` for form protection changes

## Final Guidance
This project behaves like a CMS-backed marketing site, not a pure API app and not a fully componentized SPA.

The safest mental model is:
- public page = route + controller + DB content + Blade view
- admin editing = Filament resource + model + migration
- global behavior = `WebsiteSettings`, `app.blade.php`, and service providers

If you follow those boundaries first, changes in this codebase become much easier to reason about.
