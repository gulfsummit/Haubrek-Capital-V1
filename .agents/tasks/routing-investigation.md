# Routing & Language Investigation Report
## Hauberk Capital — Laravel Project
**Generated:** Read-only investigation, no code changed.

---

## Executive Summary

The application uses **session-based language switching** with no URL prefix for Arabic (`/ar/`). The current system stores the locale in `Session::put('locale', ...)` and reads it back on every request via the `SetLocale` middleware. All routes are flat English-only URIs. There is **no `hreflang`** in any blade template. There is also a confirmed **broken route name** (`resource-center`) used in the nav blade that does not exist in `routes/web.php` — it was renamed to `resources-center` but the nav was not updated everywhere.

---

## 1. routes/web.php — All Defined Routes

**Total routes: 57 (GET: 47, POST: 9, fallback: 1)**
No route groups are used (no `prefix`, no `middleware` group wrapping).

| # | Method | URI | Route Name |
|---|--------|-----|------------|
| 1 | GET | `lang/{locale}` | `lang.switch` |
| 2 | GET | `/sitemap.xml` | `sitemap` *(duplicated — see note)* |
| 3 | GET | `/robots.txt` | `robots` |
| 4 | GET | `/` | `home` |
| 5 | GET | `/about-us` | `about_us` *(duplicated — see note)* |
| 6 | GET | `/board-of-directors` | `board_of_directors` |
| 7 | GET | `/app` | `app` |
| 8 | GET | `/contact-us` | `contact_us` *(duplicated — see note)* |
| 9 | GET | `/services` | `services` |
| 10 | GET | `/articles` | `articles` |
| 11 | GET | `/article/show/{id}` | `article.show` |
| 12 | GET | `/blog` | `blog` |
| 13 | GET | `/blog/{blog}` | `blog.show` |
| 14 | GET | `/case-studies` | `case-studies` |
| 15 | GET | `/case-studies/{caseStudy}` | `case-studies.show` |
| 16 | GET | `/teams` | `teams` |
| 17 | GET | `/teams-page` | `teams.page` |
| 18 | GET | `/governance-services` | `governance-services` |
| 19 | GET | `/wealth-services` | `wealth-services` |
| 20 | GET | `/wealth-planning-services` | `wealth-planning-services` |
| 21 | GET | `/investment-services` | `investment-services` |
| 22 | GET | `/cio-services` | `cio-services` |
| 23 | GET | `/request-meeting` | `request-meeting` |
| 24 | POST | `/request-meeting` | `meeting.submit` |
| 25 | GET | `/appointment` | `appointment` |
| 26 | GET | `/appointment/availability` | `appointment.availability` |
| 27 | GET | `/books` | `books` |
| 28 | GET | `/book/show/{id}` | `book.show` |
| 29 | GET | `/glossaries` | `glossaries` |
| 30 | GET | `/glossary/show/{id}` | `glossary.show` |
| 31 | GET | `/tools` | `tools` |
| 32 | POST | `/risk-assessments` | `risk.submit` |
| 33 | GET | `/about-us` | `about-us` *(duplicate of #5)* |
| 34 | GET | `/contact-us` | `contact-us` *(duplicate of #8)* |
| 35 | POST | `/contact-us/submit` | `contact.submit` |
| 36 | GET | `/careers` | `careers` |
| 37 | POST | `/careers/submit` | `careers.submit` |
| 38 | POST | `/appointment/submit` | `appointment.submit` |
| 39 | GET | `/faq` | `faq` |
| 40 | GET | `/resources-center` | `resources-center` |
| 41 | GET | `/resources-center/white-papers` | `white-papers` |
| 42 | GET | `/resources-center/white-papers/{whitePaper}` | `white-papers.show` |
| 43 | POST | `/resources-center/white-papers/{whitePaper}/download` | `white-papers.download` |
| 44 | GET | `/resources-center/cio-flash` | `cio-flash` |
| 45 | GET | `/resources-center/cio-flash/{cioFlash}` | `cio-flash.show` |
| 46 | GET | `/resources-center/monday-window` | `monday-window` |
| 47 | GET | `/resources-center/monday-window/{mondayWindow}` | `monday-window.show` |
| 48 | GET | `/resources-center/research` | `research` |
| 49 | GET | `/resources-center/research/{research}` | `research.show` |
| 50 | POST | `/resources-center/research/{research}/download` | `research.download` |
| 51 | GET | `/resources-center/research/{research}/thank-you` | `research.thank-you` |
| 52 | POST | `/newsletter/subscribe` | `newsletter.subscribe` |
| 53 | GET | `/popup` | `popup` |
| 54 | GET | `/setting` | `setting` |
| 55 | GET | `/privacy-policy` | `privacy-policy` |
| 56 | GET | `/terms-conditions` | `terms-conditions` |
| 57 | GET | `/cookie-policy` | `cookie-policy` |
| — | fallback | `*` | *(no name)* |
| — | GET | `/sitemap.xml` | *(anonymous, overwrites #2)* |

**⚠️ Known Issues in routes/web.php:**
- `/about-us` is declared twice — once as `about_us` (underscore) and once as `about-us` (hyphen). The second declaration wins; the first name `about_us` is orphaned.
- `/contact-us` is declared twice — once as `contact_us` (underscore) and once as `contact-us` (hyphen). Same issue.
- `/sitemap.xml` is declared twice. The anonymous closure at the bottom overwrites the named `FrontendController::sitemap` route.
- Route name `resource-center` does **not exist** — the actual name is `resources-center`. The nav uses `route('resource-center')` which will throw a runtime error.

---

## 2. Language Switching — How It Works

### Middleware: `app/Http/Middleware/SetLocale.php`
```php
public function handle(Request $request, Closure $next): Response
{
    App::setLocale(Session::get('locale', config('app.locale')));
    return $next($request);
}
```
- Reads from session key **`locale`**
- Falls back to `config('app.locale')` = `en`
- Applied to **all web routes** via `Kernel.php` → `$middlewareGroups['web']`

### Switch Route: `routes/web.php` line 1
```php
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');
```
- URL: `GET /lang/en` or `GET /lang/ar`
- Stores locale in session and redirects back to the referring page
- The URL **does not change** — `/about-us` stays `/about-us` whether in English or Arabic

### Session Key
- **Key name:** `locale`
- **Allowed values:** `en`, `ar`

### Nav Switcher Links (from `resources/views/layouts/nav.blade.php` lines 276–278)
```blade
<a href="{{ route('lang.switch', 'en') }}">EN</a>
<a href="{{ route('lang.switch', 'ar') }}">AR</a>
```
These generate: `https://hauberkcapital.com/lang/en` and `https://hauberkcapital.com/lang/ar`

The language switcher is only shown when `$websiteSettings->show_language_switcher` is truthy.

---

## 3. Named Routes Used in Blade Files

All unique route names found across blade files (excluding vendor):

| Route Name | Used In |
|------------|---------|
| `home` | nav, footer, show pages (blogs, case-studies, 404) |
| `about-us` | nav (fallback), sitemap |
| `teams` | nav (fallback) |
| `app` | nav (fallback) |
| `services` | nav (fallback), footer |
| `governance-services` | nav, blog show, case-study show |
| `wealth-services` | nav (mobile), blog show, case-study show |
| `investment-services` | blog show, case-study show |
| `cio-services` | blog show, case-study show |
| `resource-center` | **nav — BROKEN, this name does not exist in routes/web.php** |
| `resources-center` | used correctly in other places |
| `blog` | nav, blog listing, blog show |
| `blog.show` | blog listing, home insights |
| `white-papers` | nav |
| `cio-flash` | nav |
| `monday-window` | nav |
| `research` | nav |
| `contact-us` | nav, 404, FAQ, case-studies, calendar |
| `request-meeting` | blog, FAQ, case-studies, calendar |
| `careers.submit` | careers page form |
| `appointment.submit` | calendar form |
| `appointment.availability` | calendar AJAX |
| `contact.submit` | contact page form |
| `contact-us` | contact form |
| `case-studies` | case-study listing |
| `case-studies.show` | home insights, case-study listing |
| `article.show` | articles listing, home insights |
| `book.show` | books listing, home insights |
| `glossary.show` | glossaries listing |
| `popup` | blog show (subscribe button) |
| `newsletter.subscribe` | newsletter popup component |
| `privacy-policy` | footer |
| `terms-conditions` | footer |
| `cookie-policy` | footer |
| `lang.switch` | nav (EN/AR switcher) |

**⚠️ Critical: `route('resource-center')` in nav.blade.php does NOT exist.** This will throw a `RouteNotFoundException` at runtime for any page that includes the nav when the fallback nav branch renders. The correct name is `resources-center`.

---

## 4. Controllers — FrontendController Public Methods

File: `app/Http/Controllers/Admin/FrontendController.php`

| Method | Returns View |
|--------|-------------|
| `home()` | `homePage.home` |
| `service()` | `services.service` |
| `governanceServices()` | `services.governance-services` |
| `cioServices()` | `services.cio-services` |
| `investmentServices()` | `services.investment-services` |
| `wealthServices()` | `services.wealth-services` |
| `wealthPlanningServices()` | `services.wealth-planning` |
| `requestMeeting()` | `meeting.requestmeeting` |
| `articles()` | `articles.index` |
| `article($id)` | `articles.show` |
| `blog(Request)` | `blogs.blog` |
| `blogShow(Blog)` | `blogs.show` |
| `caseStudies(Request)` | `case-studies.index` |
| `caseStudyShow(CaseStudy)` | `case-studies.show` |
| `teamsPage()` | `teams.teams` |
| `books()` | `books.index` |
| `book($id)` | `books.show` |
| `about_us()` | `about-us` |
| `glossaries()` | `glossaries.index` |
| `glossary($id)` | `glossaries.show` |
| `tools()` | `tools.index` |
| `question()` | `questions.faq` |
| `risk_assessments(Request)` | redirect back |
| `app()` | `app.app` |
| `contactUs()` | `contact` |
| `storeContact(Request)` | redirect back |
| `storeAppointment(Request)` | redirect back |
| `appointmentAvailability(Request)` | JSON response |
| `appointment()` | `calendar.calendar` |
| `resourcesCenter()` | `resources.resources-center` |
| `storeMeetingRequest(Request)` | redirect to `request-meeting` |
| `careers()` | `careers.careers` |
| `storeCareerApplication(Request)` | redirect back |
| `privacyPolicy()` | `legal.privacy-policy` |
| `termsConditions()` | `legal.terms-conditions` |
| `cookiePolicy()` | `legal.cookie-policy` |
| `sitemap()` | XML response |
| `robots()` | plain-text response |
| `fallback(Request)` | `errors.404` (or 301 redirect for legacy URLs) |
| `whitePapers(Request)` | `resources.white-papers.index` |
| `whitePaperShow(WhitePaper)` | `resources.white-papers.show` |
| `whitePaperDownload(Request, WhitePaper)` | JSON / redirect |
| `cioFlash(Request)` | `resources.cio-flash.index` *(assumed)* |
| `cioFlashShow(CioFlash)` | `resources.cio-flash.show` *(assumed)* |
| `mondayWindow(Request)` | `resources.monday-window.index` *(assumed)* |
| `mondayWindowShow(MondayWindow)` | `resources.monday-window.show` *(assumed)* |
| `research(Request)` | `resources.research.index` *(assumed)* |
| `researchShow(Research)` | `resources.research.show` *(assumed)* |
| `researchDownload(...)` | JSON / redirect |
| `researchThankYou(Research)` | view |

---

## 5. Views Structure — Page Views vs Partials

### Actual Page Views (correspond to routes):

| View File | Route |
|-----------|-------|
| `resources/views/homePage/home.blade.php` | `home` → `/` |
| `resources/views/about-us.blade.php` | `about-us` → `/about-us` |
| `resources/views/teams/teams.blade.php` | `teams` → `/teams` |
| `resources/views/app/app.blade.php` | `app` → `/app` |
| `resources/views/contact.blade.php` | `contact-us` → `/contact-us` |
| `resources/views/services/service.blade.php` | `services` → `/services` |
| `resources/views/services/governance-services.blade.php` | `governance-services` |
| `resources/views/services/wealth-services.blade.php` | `wealth-services` |
| `resources/views/services/investment-services.blade.php` | `investment-services` |
| `resources/views/services/cio-services.blade.php` | `cio-services` |
| `resources/views/meeting/requestmeeting.blade.php` | `request-meeting` |
| `resources/views/calendar/calendar.blade.php` | `appointment` |
| `resources/views/articles/index.blade.php` | `articles` |
| `resources/views/articles/show.blade.php` | `article.show` |
| `resources/views/blogs/blog.blade.php` | `blog` |
| `resources/views/blogs/show.blade.php` | `blog.show` |
| `resources/views/case-studies/index.blade.php` | `case-studies` |
| `resources/views/case-studies/show.blade.php` | `case-studies.show` |
| `resources/views/books/index.blade.php` | `books` |
| `resources/views/books/show.blade.php` | `book.show` |
| `resources/views/glossaries/index.blade.php` | `glossaries` |
| `resources/views/glossaries/show.blade.php` | `glossary.show` |
| `resources/views/tools/index.blade.php` | `tools` |
| `resources/views/questions/faq.blade.php` | `faq` |
| `resources/views/careers/careers.blade.php` | `careers` |
| `resources/views/resources/resources-center.blade.php` | `resources-center` |
| `resources/views/resources/white-papers/index.blade.php` | `white-papers` |
| `resources/views/resources/white-papers/show.blade.php` | `white-papers.show` |
| `resources/views/resources/cio-flash/index.blade.php` | `cio-flash` |
| `resources/views/resources/cio-flash/show.blade.php` | `cio-flash.show` |
| `resources/views/resources/monday-window/index.blade.php` | `monday-window` |
| `resources/views/resources/monday-window/show.blade.php` | `monday-window.show` |
| `resources/views/resources/research/index.blade.php` | `research` |
| `resources/views/resources/research/show.blade.php` | `research.show` |
| `resources/views/legal/privacy-policy.blade.php` | `privacy-policy` |
| `resources/views/legal/terms-conditions.blade.php` | `terms-conditions` |
| `resources/views/legal/cookie-policy.blade.php` | `cookie-policy` |
| `resources/views/errors/404.blade.php` | fallback |

### Layout / Partials (not pages):
- `resources/views/app.blade.php` — master layout
- `resources/views/layouts/nav.blade.php` — navigation partial
- `resources/views/layouts/footer.blade.php` — footer partial
- `resources/views/partials/cta-section.blade.php` — reusable CTA
- `resources/views/homePage/serviceSection.blade.php` — home section partial
- `resources/views/services/partials/responsive-styles.blade.php` — styles partial
- `resources/views/components/newsletter-popup.blade.php` — popup component
- `resources/views/seo/sitemap.blade.php` — XML sitemap template

---

## 6. Language Files

**There are NO language files.** Neither `lang/` nor `resources/lang/` directories exist in this project.

The application does **not use Laravel's `__()`/`trans()` translation system** at all. Instead:
- All bilingual content is stored in the **database** with `_en` / `_ar` field suffixes (e.g., `title_en`, `title_ar`, `content_en`, `content_ar`)
- Views use inline `$localize()` closures or direct `app()->getLocale() === 'ar'` conditionals
- Example from `FrontendController.php`: `$localize = fn($en, $ar) => app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar)`

This means all UI string translations (button labels, nav items, breadcrumbs) are either hardcoded inline in blade files (Arabic and English in the same file) or pulled from the database model.

---

## 7. SEO Meta / hreflang

### hreflang
**There is NO `hreflang` tag anywhere in the project's blade templates.**

The `app.blade.php` master layout has an extensive `<head>` section with:
- `<title>` — localized via `$seoMeta`
- `<meta name="description">` — localized
- `<meta name="keywords">` — localized
- `<link rel="canonical">` — set from `$seoMeta->canonical_url` or `url()->current()`
- Open Graph tags (`og:title`, `og:description`, `og:image`, `og:url`)
- Twitter Card tags
- Schema.org JSON-LD (Organization, WebPage, BreadcrumbList, BlogPosting, etc.)
- Google Tag Manager, GA4, Facebook Pixel, LinkedIn Pixel, TikTok Pixel

**Missing:** `<link rel="alternate" hreflang="en" href="...">` and `<link rel="alternate" hreflang="ar" href="...">` are completely absent.

### Canonical URL Behavior
Since both English and Arabic content live at the **same URL** (e.g., `/about-us`), the canonical URL is always `url()->current()` regardless of language. This means Google sees the same URL for both languages — there's no alternate URL to point `hreflang` at, because there is no `/ar/about-us`.

---

## 8. Arabic Content Coverage

The database model uses `_en` / `_ar` column pairs. Based on the controller and model structure, **all major content models have Arabic fields**:

| Model | Arabic Fields |
|-------|--------------|
| `Blog` | `title_ar`, `description_ar`, `content_ar`, `category_ar`, `button_text_ar` |
| `CaseStudy` | `title_ar`, `description_ar`, `content_ar`, `category_ar`, `button_text_ar` |
| `Article` | `title_ar`, `description_ar` (via ArticleResource) |
| `Book` | `title_ar`, `description_ar` (via BookResource) |
| `Glossary` | `title_ar`, `description_ar` (via GlossaryResource) |
| `Home`, `About`, `Teams`, `App` | Full `_ar` fields on all content fields |
| `Services`, `GovernanceServices`, `WealthServices`, `InvestmentServices`, `CioServices` | Full `_ar` fields |
| `WhitePaper`, `CioFlash`, `MondayWindow`, `Research` | `title_ar`, `short_description_ar` |
| `AppointmentPage` | `_ar` variants for all message fields |
| `SeoMeta` | `meta_title_ar`, `meta_description_ar`, `og_title_ar`, `og_description_ar`, `h1_ar` |

All models use a `localize()` pattern at the view/controller layer — Arabic content fields exist but whether they are **populated** in the database depends on the content editors, not the code.

---

## 9. Nav / Header — Language Switcher Link

File: `resources/views/layouts/nav.blade.php` (lines 275–280)

```blade
@if(isset($websiteSettings) && $websiteSettings->show_language_switcher)
<div class="flex items-center space-x-2 ml-6 pl-6 ...">
    <a href="{{ route('lang.switch', 'en') }}" 
       class="{{ app()->getLocale() === 'en' ? 'text-white' : 'text-[#BF9874]' }} hover:text-white">EN</a>
    <span class="text-[#BF9874]">|</span>
    <a href="{{ route('lang.switch', 'ar') }}" 
       class="{{ app()->getLocale() === 'ar' ? 'text-white' : 'text-[#BF9874]' }} hover:text-white">AR</a>
</div>
@endif
```

- Generates: `/lang/en` and `/lang/ar`
- The active language is visually highlighted with `text-white` vs `text-[#BF9874]`
- The switcher is guarded by `$websiteSettings->show_language_switcher` — if this is `false` in the database, the switcher is invisible to users
- The same pattern is duplicated for the mobile menu at lines 383–385

**After clicking AR:** the user stays on the same page (via `redirect()->back()`) but with Arabic content served because the session now holds `locale = ar`. The URL does **not change**.

---

## 10. Config — Locale Settings

File: `config/app.php`

```php
'locale' => 'en',
'fallback_locale' => 'en',
'faker_locale' => 'en_US',
```

- **Default locale:** `en`
- **Fallback locale:** `en`
- No `supported_locales` config array (not standard Laravel, but not needed here since the route-based switch validates against a hardcoded `['en', 'ar']` array)

---

## Conclusions & Recommendations

### What Needs to Be Done (for SEO with /ar/ prefix)

The client confirmed they want:
1. **`/ar/` prefix in Arabic URLs** (e.g., `/ar/about-us`, `/ar/blog`)
2. **`hreflang` tags** linking the two language versions

To implement this properly:

#### Fix 1: Broken route name (immediate bug)
In `resources/views/layouts/nav.blade.php`, change `route('resource-center')` (lines 163, 255, 363) to `route('resources-center')`. The route named `resource-center` does not exist and will throw a `RouteNotFoundException`.

#### Fix 2: Duplicate route names in web.php
- Remove the first `Route::get('/about-us', ...)->name('about_us')` (underscore name) — or rename it. The hyphen version `about-us` is what all views use.
- Same for `contact_us` vs `contact-us`.
- Remove the duplicate `/sitemap.xml` anonymous closure at the bottom — or remove the named one at the top. Two routes for the same URI is a silent bug.

#### Fix 3: Add `/ar/` route prefix (new work)
Wrap all page routes in a `Route::prefix('ar')->name('ar.')` group and apply a middleware that sets `locale = ar`. Keep the existing routes as-is for English. The existing `SetLocale` middleware already reads from session; a new URL-based locale middleware would need to override the session.

The recommended approach:
```php
// English (default) — keep existing routes unchanged
Route::middleware('web')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    // ... all existing routes ...
});

// Arabic — mirror with /ar/ prefix
Route::prefix('ar')
    ->middleware(['web', 'set.locale:ar'])
    ->name('ar.')
    ->group(function () {
        Route::get('/', [FrontendController::class, 'home'])->name('home');
        // ... same routes ...
    });
```

#### Fix 4: Add hreflang to app.blade.php
Once both URL versions exist, add inside `<head>` in `app.blade.php`:
```blade
<link rel="alternate" hreflang="en" href="{{ $englishUrl }}">
<link rel="alternate" hreflang="ar" href="{{ $arabicUrl }}">
<link rel="alternate" hreflang="x-default" href="{{ $englishUrl }}">
```
Where `$englishUrl` = the current route without `/ar/` prefix, and `$arabicUrl` = the same route with `/ar/` prefix.

#### Fix 5: Update the language switcher
Instead of `route('lang.switch', 'ar')`, the AR link should point to the `/ar/` prefixed version of the current page. This requires knowing the "ar equivalent" of the current route. Since all routes have a 1:1 mirror, this can be done with a helper that swaps the `ar.` name prefix on the current route.

---

## File/Symbol Index

| Finding | File | Line(s) |
|---------|------|---------|
| Language switch route | `routes/web.php` | 20–25 |
| SetLocale middleware | `app/Http/Middleware/SetLocale.php` | 16–19 |
| SetLocale registered | `app/Http/Kernel.php` | 37 |
| Nav language switcher | `resources/views/layouts/nav.blade.php` | 275–280, 381–386 |
| **BROKEN** `route('resource-center')` | `resources/views/layouts/nav.blade.php` | 163, 255, 363 |
| **BROKEN** `route('resource-center')` in sitemap | `app/Http/Controllers/Admin/FrontendController.php` | 1080 |
| hreflang — absent | `resources/views/app.blade.php` | entire `<head>` section |
| Duplicate `about_us` / `about-us` | `routes/web.php` | 30, 58 |
| Duplicate `contact_us` / `contact-us` | `routes/web.php` | 31, 59 |
| Duplicate `/sitemap.xml` | `routes/web.php` | 26, 84 |
| Default locale = `en` | `config/app.php` | 77 |
| No lang files exist | `lang/` or `resources/lang/` | — (directories absent) |
