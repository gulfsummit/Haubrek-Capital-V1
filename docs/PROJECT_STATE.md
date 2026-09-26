# Project State and Architecture

**Reviewed:** 2026-09-26  
**Repository:** Hauberk Capital  
**Purpose:** Project-wide orientation for developers starting work in this repository. This describes the checked-out working tree, not a verified production deployment.

## Git Repository

The active `.git` repository was initialized from scratch on 2026-09-26 on branch `main`. It has no commits or remote configured yet. The previous repository metadata, including its history and prior index, is preserved outside this project at `../hauberk-capital-git-backup-20260926`. SQL files in `database/backups` are locally retained but ignored by Git.

## Project Summary

Hauberk Capital is a bilingual corporate website and content-management application. Public pages are rendered with Laravel Blade and read content from Eloquent models; editors manage much of that content through Filament. Public forms persist submissions and may send notifications or use reCAPTCHA depending on the workflow.

| Area | Current implementation |
| --- | --- |
| Backend | PHP `^8.1`, Laravel `^10.10` |
| Admin/CMS | Filament `3.3` |
| Public rendering | Laravel routes, controllers, Eloquent models, Blade views |
| Frontend assets | Vite 5 is configured; public pages also use static files under `public/design`, CDN assets, and Blade markup |
| Languages | English (`en`) and Arabic (`ar`), with locale stored in session |
| Media | Spatie Media Library and Filament upload components |
| Forms/security | Laravel validation, reCAPTCHA service/rule, mail notifications where wired |
| Tests | PHPUnit/Laravel test setup exists under `tests/`; run focused tests for touched behavior |

## Application Structure

### Public request flow

Most public page requests follow this path:

1. A route in `routes/web.php` maps the URL to a method on `App\Http\Controllers\Admin\FrontendController`.
2. The controller loads page content or records through models in `app/Models`.
3. The controller returns a Blade view from `resources/views`.
4. Shared layout, navigation, footer, metadata, and global assets are rendered by the shared Blade layout and related partials.

For a page change, trace the route, controller method, model/migration, and view together. Some content is database-backed, some is hardcoded, and some combines both with a fallback.

### CMS and admin

- Filament resources and pages are under `app/Filament/Admin`.
- Panel providers are under `app/Providers/Filament` and registered in `config/app.php`.
- Models define persistence and casts; migrations under `database/migrations` define schema changes.
- Shared Filament fields/components are under `app/Filament/Forms` and `app/Forms/Components`.

Before adding an editor field, confirm the database column, model fillable/casts, resource form, and public rendering path all agree.

### Main code areas

| Path | Responsibility |
| --- | --- |
| `routes/web.php` | Public page, form, locale, and sitemap routes |
| `app/Http/Controllers/Admin/FrontendController.php` | Main controller for public pages and several form submissions |
| `app/Http/Controllers/NewsletterController.php` | Newsletter subscription endpoint |
| `app/Models` | Eloquent page-content and submission models |
| `app/Filament/Admin/Resources` | CMS editors and submission-management resources |
| `app/Notifications` | Mail notification classes |
| `app/Services` and `app/Rules` | Application services and validation rules, including reCAPTCHA |
| `database/migrations` | Database schema history |
| `database/seeders` | Initial/default data |
| `database/backups` | SQL snapshots; handle as sensitive data |
| `resources/views` | Public Blade pages and Filament view overrides |
| `resources/css`, `resources/js` | Vite entry points |
| `public/design` | Static design assets used by public pages |
| `scripts` | Operational shell scripts |
| `docs` | Project overview and implementation guides |

The root route currently returns `homePage.home`. The older `resources/views/index.blade.php` includes `homePage.serviceSection`; treat that partial as a legacy view dependency unless the route is changed to use `index`.

## Functional Areas

The repository contains page content and CMS/submission flows for the home page, about and leadership pages, apps, service lines, articles, books, glossaries, blogs, case studies, careers, contact, resource center, tools/risk assessment, newsletter, meeting requests, appointments, FAQs, and legal pages. Site-wide content and behavior also use website settings and SEO metadata.

The database-backed page-content record and its public submission record are not necessarily the same resource. For example, page copy is managed separately from meeting, appointment, career, newsletter, or tools submissions. Follow the specific model/resource/controller path rather than assuming one admin screen owns both.

## Localization

- The locale route is `lang/{locale}` and currently accepts `en` and `ar`.
- The selected locale is stored in session; the application default and fallback locale are `en`.
- Many records use paired fields such as `title_en` and `title_ar`; preserve both when modifying bilingual content.
- Blade closures do not inherit surrounding local variables automatically. Capture values such as `$isArabic` with `use (...)` when a closure needs them.

## Forms and Data

Before changing a public form, inspect its Blade template, route, controller method, model, migration, and notification class if applicable. Check that frontend reCAPTCHA action names match server-side validation and that stored fields still match notification expectations.

The current `DatabaseSeeder` invokes only `CioServicesSeeder`, `InvestmentServicesSeeder`, and `WealthServicesSeeder`. A plain `php artisan db:seed` therefore does not populate every CMS area; check the relevant seeder and existing data before assuming defaults exist.

## Local Development

Prerequisites: PHP 8.1 or newer, Composer, Node.js/npm, and a database configured for this environment.

```sh
composer install
npm install
```

Create `.env` from `.env.example` only when needed, then configure the application URL, database, mail, storage, and any required reCAPTCHA values. Do not copy production secrets into documentation or commit `.env`.

```sh
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

Run migrations only against the intended database and take an appropriate backup first, especially when using a database copied from production. Use a separate terminal for Vite if changing Vite-managed assets:

```sh
npm run dev
```

Useful checks/builds:

```sh
php artisan route:list
php artisan migrate:status
php artisan test
npm run build
```

Most marketing-page work is Blade/static-asset work and may not require Vite. Check `vite.config.js` before assuming every public asset is built through Vite.

## Current Repository Baseline

The historical Git comparison captured on 2026-09-26 is against the previous repository's local `HEAD` `c25d1bc`, not against a production server and not against the new repository's history. At capture time, 485 changes were staged, 23 tracked files had unstaged edits, and 3 project files were untracked. The branch was `capital`, one commit ahead of the locally recorded `origin/capital` reference. The detailed counts, changed areas, untracked files, and commit-author evidence are in [the Git change snapshot](GIT_CHANGE_SNAPSHOT_2026-09-26.md).

Staged and unstaged work may represent different versions of the same file. Review both `git diff --cached` and `git diff` before editing or resetting anything. Do not assume the remote-tracking reference is current unless it has been fetched.

## Known Checks Before Further Changes

- `routes/web.php` currently contains repeated definitions for `/about-us`, `/contact-us`, and `/sitemap.xml`. Use `php artisan route:list` to confirm which action/name Laravel resolves before changing these endpoints.
- The sitemap endpoint has more than one definition in the route file; check its controller implementation and the later route closure together before modifying sitemap behavior.
- In the current `storeMeetingRequest()` path, a successful save redirects to the request-meeting page. The current method no longer performs the eligibility redirect or sends the meeting-request notification described by older notes; confirm the desired workflow before changing it.
- SQL files under `database/backups` may contain real data. Inspect for personal data and secrets before sharing, committing, or loading them.
- `scripts/fix-permissions.sh` uses `sudo` and removes contents of `storage/framework/views` and `storage/framework/cache` before resetting ownership/permissions. Do not run it unless that maintenance is required on the intended Linux environment.
- This working tree came from a live copy, but this document does not certify that it matches production. A reliable live comparison needs a known production revision or a separately captured production file/database snapshot.

## Documentation Map

- [Git change snapshot](GIT_CHANGE_SNAPSHOT_2026-09-26.md): dated local Git baseline and authorship limits.
- [Working with this project](SOP_WORKING_WITH_THIS_PROJECT.md): detailed workflow, architecture notes, and known implementation gotchas.
- [Page builder components](SOP_PAGE_BUILDER_COMPONENTS.md): guidance for adding dynamic Filament-managed page sections.
- [reCAPTCHA setup](RECAPTCHA_SETUP.md): environment setup and form integration notes.
- [Newsletter popup guide](NEWSLETTER_POPUP_GUIDE.md): editing and triggering the newsletter popup.

Keep this document current when routes, providers, key modules, database ownership, or local setup conventions change.
