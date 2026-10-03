# Implementation Plan

## Exploration Findings

### Task 1 — Lazy Loading
- **Zero** `<img>` tags across all non-vendor blade files currently have `loading="lazy"` or `loading="eager"`.
- No `srcset` is used anywhere — constraint matches the task (no srcset to add).
- **Above-the-fold / hero images that must NOT get lazy** (they appear in the first viewport on every page):
  - `layouts/nav.blade.php` — the site logo (lines 180, 182) → `loading="eager"`
  - `homePage/home.blade.php` line 453 — hero slider image `$slideImage` → `loading="eager"`
  - `services/service.blade.php` lines 95, 97, 103, 105 — hero desktop & mobile images → `loading="eager"`
  - `services/governance-services.blade.php` lines 86, 88, 94, 96 — hero desktop & mobile → `loading="eager"`
  - `services/wealth-services.blade.php` lines 87, 89, 95, 97 — hero desktop & mobile → `loading="eager"`
  - `services/cio-services.blade.php` — hero images (same pattern) → `loading="eager"`
  - `services/investment-services.blade.php` — hero images → `loading="eager"`
  - `case-studies/index.blade.php` lines 52, 55 — hero desktop & mobile → `loading="eager"`
  - All other `<img>` tags are below the fold and get `loading="lazy"`.
- **Width/height attributes**: The project uses Tailwind utility classes (`w-full h-full`, `w-8 h-8`, etc.) to control image dimensions. Because every image already has explicit CSS sizing via Tailwind, adding HTML `width`/`height` attributes is not needed — they would conflict with the fluid Tailwind layout. **Decision**: skip width/height attribute additions; they are not required and would break layout.

### Task 2 — Research Download System
- **Already fully implemented.** Findings:
  - Migration `2026_09_26_100300_create_research_table.php` — `research` table with `form_required boolean default true` ✅
  - Migration `2026_09_26_100400_create_research_downloads_table.php` — `research_downloads` table with all required columns (`first_name`, `last_name`, `business_email`, `company`, `job_title`, `country`, `phone_number nullable`, `downloaded_at`, timestamps) ✅
  - Model `app/Models/Research.php` — `form_required` in `$fillable` and `$casts`, `downloads()` relationship ✅
  - Model `app/Models/ResearchDownload.php` — full model with correct `$fillable` ✅
  - `ResearchResource.php` — Toggle `form_required` in Filament admin form, `downloads_count` badge in table ✅
  - Routes in `web.php` — `POST /resources-center/research/{research}/download`, `GET /resources-center/research/{research}/thank-you` ✅
  - `FrontendController::researchDownload()` — validates, saves `ResearchDownload`, handles AJAX (returns `pdf_url`) and standard redirect ✅
  - `FrontendController::researchThankYou()` — passes `$research` to thank-you view ✅
  - Blade `resources/research/show.blade.php` — full Alpine-free modal (vanilla JS), conditional "free download" button vs modal gate ✅
  - Blade `resources/research/thank-you.blade.php` — complete thank-you page ✅
  - **Note**: The migration column for email is `business_email`, the model `$fillable` uses `business_email`, the controller stores `business_email`. All consistent. The task spec said `email` as the column name, but the actual schema used `business_email` and that is already deployed — no change needed.
- **Conclusion**: Task 2 requires **no implementation work**. Everything described in the task brief is already in place and consistent.

### Task 3 — Monday Window
- **Already fully implemented.** Findings:
  - Migration `2026_09_26_100200_create_monday_windows_table.php` — `short_summary_en`, `short_summary_ar` (text nullable), `market_topics` (json nullable), `external_sources` (json nullable), `related_articles` (json nullable) all present ✅
  - Model `app/Models/MondayWindow.php` — all five fields in `$fillable`, `$casts` has `market_topics`, `external_sources`, `related_articles` as `'array'`, `short_summary_en/ar` locale-aware accessor ✅
  - `MondayWindowResource.php` — `TagsInput::make('market_topics')` (Section "Market Topics"), `Repeater::make('external_sources')` with `label_en/label_ar/url` sub-fields, `Repeater::make('related_articles')` with same sub-fields; `CustomRichEditor` for `short_summary_en/ar` ✅
  - Blade `resources/monday-window/show.blade.php` — renders market_topics as tag badges, `{!! $summary !!}` for short summary, external_sources and related_articles as link lists ✅
  - **Conclusion**: Task 3 requires **no implementation work**. Everything described in the task brief is already in place.

---

## Implementation Plan

Only **Task 1 (Lazy Loading)** requires implementation. Tasks 2 and 3 are already complete.

---

- [ ] 1. Add `loading="eager"` to hero/above-the-fold images in the nav layout and all hero sections.

  The nav logo must load immediately on every page. The hero (first-viewport) images on each page must also not be deferred.

  **Files to modify:**

  - `resources/views/layouts/nav.blade.php`
    — Lines 180, 182: both `<img>` for the site logo → add `loading="eager"`

  - `resources/views/homePage/home.blade.php`
    — Line 453: hero slider image `$slideImage` → add `loading="eager"`

  - `resources/views/services/service.blade.php`
    — Lines 95, 97 (hero desktop), 103, 105 (hero mobile) → add `loading="eager"`

  - `resources/views/services/governance-services.blade.php`
    — Lines 86, 88 (hero desktop), 94, 96 (hero mobile) → add `loading="eager"`

  - `resources/views/services/wealth-services.blade.php`
    — Lines 87, 89 (hero desktop), 95, 97 (hero mobile) → add `loading="eager"`

  - `resources/views/services/cio-services.blade.php`
    — Hero desktop + mobile `<img>` tags (same pattern as governance/wealth) → add `loading="eager"`

  - `resources/views/services/investment-services.blade.php`
    — Hero desktop + mobile `<img>` tags → add `loading="eager"`

  - `resources/views/case-studies/index.blade.php`
    — Lines 52, 55: hero desktop + mobile → add `loading="eager"`

  **Verify:** `php -l` on each modified file (syntax check). Then visually confirm in browser that hero images load without deferral.

---

- [ ] 2. Add `loading="lazy"` to every remaining `<img>` tag in non-vendor blade files.

  All images not covered in step 1 are below the fold or in-page content (blog cards, team photos, sidebar thumbnails, service section images, approach backgrounds, service icons, journey logos, research covers, white paper covers, etc.).

  **Files to modify (all `<img>` tags except those made eager in step 1):**

  - `resources/views/homePage/home.blade.php` — lines 540, 556, 618, 623, 663, 685, 703, 706, 725, 744, 763, 770, 777, 794, 815, 824, 833, 873, 905, 973, 992, 1001, 1010, 1019, 1068, 1085, 1093, 1101, 1109 (and any remaining below)
  - `resources/views/homePage/serviceSection.blade.php` — all `<img>` tags
  - `resources/views/about-us.blade.php` — all `<img>` tags
  - `resources/views/app/app.blade.php` — all `<img>` tags
  - `resources/views/app.blade.php` — all `<img>` tags
  - `resources/views/articles/index.blade.php` — all `<img>` tags
  - `resources/views/articles/show.blade.php` — all `<img>` tags
  - `resources/views/blogs/blog.blade.php` — all `<img>` tags
  - `resources/views/blogs/show.blade.php` — all `<img>` tags
  - `resources/views/books/index.blade.php` — all `<img>` tags
  - `resources/views/books/show.blade.php` — all `<img>` tags
  - `resources/views/calendar/calendar.blade.php` — all `<img>` tags
  - `resources/views/careers/careers.blade.php` — all `<img>` tags
  - `resources/views/case-studies/show.blade.php` — all `<img>` tags (social share icons, sidebar thumbnails)
  - `resources/views/components/newsletter-popup.blade.php` — all `<img>` tags
  - `resources/views/contact.blade.php` — all `<img>` tags
  - `resources/views/glossaries/index.blade.php` — all `<img>` tags
  - `resources/views/glossaries/show.blade.php` — all `<img>` tags
  - `resources/views/layouts/footer.blade.php` — all `<img>` tags
  - `resources/views/legal/cookie-policy.blade.php` — all `<img>` tags
  - `resources/views/legal/privacy-policy.blade.php` — all `<img>` tags
  - `resources/views/legal/terms-conditions.blade.php` — all `<img>` tags
  - `resources/views/meeting/requestmeeting.blade.php` — all `<img>` tags
  - `resources/views/pages/show.blade.php` — all `<img>` tags
  - `resources/views/partials/cta-section.blade.php` — all `<img>` tags
  - `resources/views/questions/faq.blade.php` — all `<img>` tags
  - `resources/views/resources/cio-flash/index.blade.php` — all `<img>` tags
  - `resources/views/resources/cio-flash/show.blade.php` — all `<img>` tags
  - `resources/views/resources/monday-window/index.blade.php` — all `<img>` tags
  - `resources/views/resources/monday-window/show.blade.php` — all `<img>` tags (sidebar thumbnails)
  - `resources/views/resources/partials/resource-card.blade.php` — all `<img>` tags
  - `resources/views/resources/research/index.blade.php` — all `<img>` tags
  - `resources/views/resources/research/show.blade.php` — all `<img>` tags (sidebar thumbnails, cover in thank-you)
  - `resources/views/resources/research/thank-you.blade.php` — cover image
  - `resources/views/resources/resources-center.blade.php` — all `<img>` tags
  - `resources/views/resources/white-papers/index.blade.php` — all `<img>` tags
  - `resources/views/resources/white-papers/show.blade.php` — all `<img>` tags
  - `resources/views/services/service.blade.php` — all non-hero `<img>` tags (lines 217, 219, 223, 225, 243, 245, 247, 260, 262, 283, 285, 289, 291, 299, 301, 319, 321, 323, 349, 351, 355, 357, 375, 377, 379, 392, 394, 415, 417, 421, 423, 431, 433, 451, 453, 455, 488, 490, 503, 511, 519, 527, 535, 543, 551, 559, 570, 572)
  - `resources/views/services/governance-services.blade.php` — all non-hero `<img>` tags (lines 159, 161, 167, 169, 171, 282, 284, 287)
  - `resources/views/services/wealth-services.blade.php` — all non-hero `<img>` tags (lines 167, 169, 175, 177, 179, 389, 391)
  - `resources/views/services/cio-services.blade.php` — all non-hero `<img>` tags
  - `resources/views/services/investment-services.blade.php` — all non-hero `<img>` tags
  - `resources/views/teams/teams.blade.php` — all `<img>` tags
  - `resources/views/tools/index.blade.php` — all `<img>` tags

  **Verify:** `php -l` on each modified file. Then load a page with many images (e.g., `/blog`, `/teams`, `/services`) and confirm in DevTools Network tab that images below the fold are marked as "lazy" and only load on scroll.

---

## Ambiguities & Notes

1. **Task 2 & 3 are already done.** The code, migrations, models, Filament resources, controllers, routes, and views for both the Research Download System and Monday Window fields are fully implemented and consistent. No work is needed.

2. **Hero classification for CIO & Investment service pages**: The task confirms the same hero pattern as governance/wealth. Read `cio-services.blade.php` and `investment-services.blade.php` before editing to identify the exact line numbers for the first-viewport hero `<img>` tags (same structure as governance-services).

3. **No `width`/`height` attributes**: The project uses Tailwind for all image sizing. Adding HTML dimension attributes would conflict with the fluid CSS. The task says to note missing width/height but does not mandate adding them — and since Tailwind covers layout stability, this is a deliberate omission.

4. **No srcset**: Confirmed — none used anywhere. No srcset changes needed.

5. **Column name discrepancy (Task 2 note)**: The task brief says the `research_downloads` table should have a column `email`, but the actual migration uses `business_email` (consistent with the WhitePaper downloads pattern and the model). Since this is already live and consistent, no change is needed.
