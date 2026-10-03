# تقرير مقارنة المتطلبات مقابل التنفيذ الفعلي
## مشروع Hauberk Capital — Laravel / Filament

> **تاريخ التقرير:** مستخرج من الكود الحالي  
> **نطاق الفحص:** 15 نقطة محددة من المتطلبات  
> **المنهجية:** قراءة مباشرة للملفات دون تعديل

---

## ملخص تنفيذي

الموقع يتضمن بنية تقنية متقدمة في الغالب، لكنه يفتقر إلى **عدة ميزات جوهرية** طلبها المالك. أهم النتائج:
- **لا يوجد /ar/ في الروابط** — اللغة تعمل بالجلسة فقط
- **لا يوجد نظام إعادة توجيه (Redirects)** في اللوحة
- **لا يوجد حقل publish_time** — يوجد publish_date فقط
- **لا توجد صورة منفصلة للجوال (mobile image) في محتوى البلوج** — الصور مقسومة إلى featured + thumbnail فقط
- **لا يوجد حقل title للصور** — يوجد alt فقط
- **لا يوجد lazy loading** للصور في معظم القوالب
- **صفحة الـ Home لا تحتوي على SeoTab** في مورد Filament رغم أن النموذج يدعم HasSeoMeta

---

## النقاط التفصيلية

---

### ✅ / ❌ 1. هيكل الروابط — اللغة العربية (/ar/ prefix)

**الحالة: ❌ غير مطبق**

**الدليل:**  
ملف `routes/web.php` — جميع الروابط بدون بادئة `/ar/`:

```php
Route::get('/about-us',[FrontendController::class,'about_us'])->name('about_us');
Route::get('/blog',[FrontendController::class,'blog'])->name('blog');
```

تغيير اللغة يعمل عبر:
```php
Route::get('lang/{locale}', function ($locale) {
    Session::put('locale', $locale);
    App::setLocale($locale);
    return redirect()->back();
})->name('lang.switch');
```

وفي `app/Http/Middleware/SetLocale.php`:
```php
App::setLocale(Session::get('locale', config('app.locale')));
```

**التقييم:** اللغة تُحفظ في الـ Session وليست في الـ URL. رابط البلوج بالعربي هو `/blog` وليس `/ar/blog`. هذا يعني غياب تام لبادئة `/ar/` في الروابط.

**التوصية:** إضافة Route Group بـ `prefix('ar')` وتعيين الـ locale تلقائياً منه.

---

### ✅ 2. بطاقات المقالات — قابلية النقر، العنوان، المقتطف، زر "اقرأ المزيد"

**الحالة: ✅ مطبق كاملاً**

**الدليل** من `resources/views/blogs/blog.blade.php`:

```blade
<a href="{{ route('blog.show', $blog->slug) }}" class="block overflow-hidden">
    <img src="{{ $cardImage }}" alt="{{ $cardImageAlt }}" ... />
</a>
<a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-[#D4AF37] ...">
    {{ $blogTitle }}
</a>
<p ...>{!! $trimmedDescription !!}</p>
<a href="{{ route('blog.show', $blog->slug) }}" class="... bg-[#D4AF37] ...">
    {{ $postButtonLabel }}
</a>
```

- الصورة قابلة للنقر ✅  
- العنوان قابل للنقر ✅  
- المقتطف (description مختصر) يظهر ✅  
- زر "اقرأ المزيد" موجود ومخصص من لوحة التحكم ✅  

---

### ⚠️ 3. التحكم في تاريخ ووقت النشر

**الحالة: ⚠️ جزئي — يوجد publication_date، لا يوجد publish_time**

**الدليل:**

نموذج `Blog.php`:
```php
'publication_date' => 'date',
```

مورد `BlogResource.php`:
```php
Forms\Components\DatePicker::make('publication_date')
    ->label('Publication Date'),
```

الصور: نماذج WhitePaper، CioFlash، MondayWindow، Research — كلها تحتوي على `publication_date` (date فقط).

**لا يوجد حقل `publish_time` في أي migration أو نموذج.**

**التوصية:** إضافة `publish_time` (timepicker) في الموارد ذات الصلة + إضافة `scheduled_at` لدعم النشر المستقبلي المتحكم به.

---

### ✅ 4. الـ Canonical URL — آلي أم يدوي؟

**الحالة: ✅ يدعم الاثنين**

نظام الـ Canonical يعمل كالتالي:

في `SeoTab.php`:
```php
Forms\Components\TextInput::make('canonical_url')
    ->label('Canonical URL')
    ->helperText('Auto-generated from the slug ...')
```

في `BlogResource.php` — يُعبأ تلقائياً عند إدخال الـ slug:
```php
$canonical = rtrim(config('app.url'), '/') . '/blog/' . $state;
if (blank($get('seoMeta.canonical_url'))) {
    $set('seoMeta.canonical_url', $canonical);
}
```

في layout `app.blade.php`:
```php
$canonicalUrl = $seoMeta && $seoMeta->canonical_url
    ? $seoMeta->canonical_url
    : url()->current();
```

**يُعبأ تلقائياً من الـ slug عند الإنشاء، ويمكن تعديله يدوياً، وعند الترك فارغاً يعود لـ url()->current().**

---

### ⚠️ 5. نظام الصور — مفرد أم متعدد؟

**الحالة: ⚠️ مختلط حسب نوع المحتوى**

| النوع | الحقول |
|-------|--------|
| Blog | `featured_image` + `thumbnail_image` (اثنتان) |
| WhitePaper | `featured_image` + `cover_image` (اثنتان) |
| CioFlash | `featured_image` (واحدة) |
| MondayWindow | `featured_image` (واحدة) |
| Research | `cover_image` (واحدة) |
| Article (قديم) | Spatie MediaLibrary collection `main_image_article` |

**لا يوجد حقل منفصل للجوال (mobile_image) في محتوى المقالات/البلوج** — بعض صفحات الخدمات تحتوي على hero_mobile_background لكن هذا للخلفيات فقط.

**التوصية:** إذا كان المطلوب حقلاً منفصلاً لصورة الجوال في البطاقات، يجب إضافته.

---

### ❌ 6. إدارة إعادة التوجيه (Redirects)

**الحالة: ❌ غير موجود**

**الدليل:**
- لا يوجد ملف `Redirect.php` في `app/Models/`
- لا توجد migration تحتوي على كلمة "redirect"
- لا يوجد `RedirectResource.php` في `app/Filament/Admin/Resources/`
- الملف الوحيد المرتبط: `app/Http/Middleware/RedirectIfAuthenticated.php` وهو middleware قياسي لـ Laravel

**التوصية:** إنشاء نموذج `Redirect` + migration + مورد Filament لإدارة 301/302 redirects، وإضافة Middleware يمر على الجدول ويُطبق الإعادة.

---

### ✅ / ⚠️ 7. هيكل العناوين H1/H2 في الصفحة الرئيسية

**الحالة: ⚠️ جزئي**

**الدليل** من `home.blade.php`:

```blade
<h1 class="...">{{ $slideTitle }}</h1>  {{-- في الـ Slider --}}
```

```blade
<h2 class="...">HOW WE CAN ASSIST</h2>
```

- عنوان الـ Slider يستخدم `<h1>` ✅
- قسم "How We Can Assist" يستخدم `<h2>` ✅

**لكن المشكلة:**  
`HomeResource.php` **لا يحتوي على SeoTab** — أي لا يوجد حقل "Primary H1" منفصل في لوحة التحكم لصفحة الهوم. H1 مرتبط فقط بعنوان الـ slide الأول.

المورد يحتوي على حقول `assist_title_en/ar` لتعديل نص "HOW WE CAN ASSIST" ✅ لكن لا يوجد حقل H1 مستقل للـ Home SEO.

**التوصية:** إضافة SeoTab لـ HomeResource يتضمن حقل Primary H1 مستقل.

---

### ✅ 8. HTML Tags في حقول المحتوى

**الحالة: ✅ مطبق**

**الدليل:**

في `service.blade.php`:
```blade
{!! $getContent('description', '...html...') !!}
```

في `home.blade.php`:
```blade
{!! app()->getLocale() == 'ar'
    ? ($homeData->assist_description_ar ?? '...')
    : ($homeData->assist_description_en ?? '...') !!}
```

في `blog.blade.php`:
```blade
<p ...>{!! $trimmedDescription !!}</p>
```

كل الحقول المُستخرجة من `CustomRichEditor` تُعرض بـ `{!! !!}` أي تدعم HTML الخام. المحرر يحتوي على أدوات تنسيق متقدمة.

---

### ⚠️ 9. أخطاء النسخة العربية

**9.1 قسم "How We Can Assist" في الصفحة الرئيسية**

**الحالة: ⚠️ قد يوجد خلل في serviceSection.blade.php القديم**

يوجد ملفان:
1. **`resources/views/homePage/serviceSection.blade.php`** — نسخة قديمة ثابتة تحتوي على نصوص إنجليزية مباشرة (hardcoded):
   ```blade
   <h2 ...>HOW WE CAN ASSIST</h2>
   <p ...>Our services are designed to...</p>
   ```
   وروابط قديمة مثل `services.html` (HTML وليس route).

2. **`resources/views/homePage/home.blade.php`** — النسخة الحديثة تدعم الثنائية اللغوية بشكل صحيح.

إذا كان `serviceSection.blade.php` لا يزال مضمناً في أي مكان، فسيظهر محتوى إنجليزي ثابت بالعربية.

**9.2 صفحة الخدمات — القسم الثاني**

في `service.blade.php` القسم الثاني يعتمد على `$serviceData['services_list']` من اللوحة. إذا لم تُدخل البيانات العربية، سيظهر فارغاً. لا يوجد خلل في الكود نفسه.

**9.3 قسم CTA في مركز الموارد**

**الحالة: ⚠️ محتمل خلل عند عدم وجود بيانات عربية**

الكود في `resources-center.blade.php`:
```php
'titleHtml' => $resourceCenter
    ? nl2br(e(app()->getLocale() === 'ar'
        ? $resourceCenter->cta_title_ar
        : $resourceCenter->cta_title_en))
    : 'READY TO<br/>START GROWING?!',
```

إذا كان `cta_title_ar` فارغاً، سيرجع `null` وستظهر المنطقة فارغة (بدلاً من النص الافتراضي الإنجليزي). هذا سلوك غير متوقع.

---

### ⚠️ 10. خاصية ALT و Title للصور

**الحالة: ⚠️ جزئي — ALT موجود، Title غائب**

**الدليل:**

حقول ALT موجودة في النماذج والموارد:
- `featured_image_alt_en` / `featured_image_alt_ar` في Blog, WhitePaper, CioFlash, MondayWindow
- `image_alt_en` / `image_alt_ar` في الـ Home repeater للخدمات والرودماب

لكن:
- **لا يوجد حقل `title` للصور** (`image_title_en` / `image_title_ar`) في أي نموذج أو مورد
- البحث في القوالب: `img.*title=` → لا نتائج
- الـ `title="..."` الموجودة في الكود هي على وسوم `<a>` (روابط المشاركة الاجتماعية) وليس على الصور

**التوصية:** إضافة حقول `title` للصور في النماذج والموارد، وإضافة `title="{{ $imageTitle }}"` في وسوم img.

---

### ❌ 11. تحسينات الأداء (Lazy Loading, srcset, WebP)

**الحالة: ❌ غير مطبق في معظم القوالب**

**الدليل:**

البحث عن `loading="lazy"` في القوالب → نتيجة واحدة فقط:
- `contact.blade.php` — على خريطة Google Maps `<iframe>` وليس على صورة.

البحث عن `srcset=` → لا نتائج.  
البحث عن `<picture>` → لا نتائج (ما وُجد هو كلمة "picture" في نص عادي).  
البحث عن WebP → لا نتائج.

**في معظم القوالب الصور تُحمَّل مباشرة:**
```blade
<img src="{{ $cardImage }}" alt="{{ $cardImageAlt }}"
     class="w-full h-48 sm:h-56 md:h-64 object-cover ..." />
```

**التوصية:**
- إضافة `loading="lazy"` لجميع الصور خارج الـ above-the-fold
- إضافة `srcset` لدعم أحجام مختلفة
- دراسة استخدام مكتبة مثل `spatie/laravel-image-optimizer` أو Intervention Image

---

### ✅ 12. البيانات الهيكلية (Schema / JSON-LD)

**الحالة: ✅ مطبق وديناميكي**

**الدليل** من `app.blade.php`:

يُولَّد تلقائياً:
```php
$schemaBlocks[] = $filterSchema([
    '@context' => 'https://schema.org',
    '@type' => 'Organization', ...
]);
$schemaBlocks[] = $filterSchema([
    '@context' => 'https://schema.org',
    '@type' => request()->routeIs('home') ? 'WebSite' : 'WebPage', ...
]);
// BreadcrumbList ديناميكي لكل صفحة
// BlogPosting لصفحات البلوج
// Article لدراسات الحالة والمقالات
// Book للكتب
// DefinedTerm للمصطلحات
```

ويستخدم `spatie/schema-org`:
```php
$localBusiness = Spatie\SchemaOrg\Schema::localBusiness()...
```

ويُخرج في `<head>`:
```blade
@foreach($schemaBlocks as $schemaBlock)
    <script type="application/ld+json">
        {!! json_encode($schemaBlock, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
    </script>
@endforeach
```

**ملاحظة:** لا يوجد schema مخصص لـ WhitePaper, CioFlash, Research, MondayWindow.

---

### ✅ / ⚠️ 13. حقول SEO (العنوان والوصف) في جميع الصفحات

**الحالة: ✅ معظم الصفحات — ⚠️ بعض الصفحات تفتقرها**

**الصفحات التي تدعم SEO Meta (HasSeoMeta trait):**
- Home ✅ (النموذج يدعمه لكن HomeResource لا يُظهر SeoTab ❌)
- Blog ✅
- CaseStudy ✅
- WhitePaper ✅
- CioFlash ✅
- MondayWindow ✅
- Research ✅
- About ✅
- Services (الأنواع المختلفة) ✅
- ResourceCenter ✅
- Careers ✅
- Teams ✅
- AppointmentPage ✅
- WebsiteSettings ✅
- Tools ✅
- ContactUs ✅

**الصفحات التي تفتقر إلى SeoTab في Filament (رغم وجود HasSeoMeta في النموذج):**
- **HomeResource** — لا يحتوي على SeoTab في الكود المفحوص
- **ServicesResource** — لا يحتوي على SeoTab

**في layout app.blade.php:**
```php
$seoMetaTitle = $seoMeta ? $localize($seoMeta->meta_title_en, $seoMeta->meta_title_ar) : null;
$metaDescription = $seoMeta ? $localize($seoMeta->meta_description_en, $seoMeta->meta_description_ar) : null;
```
الحقول تُخرج صحيحاً في الـ `<head>`.

**الـ SeoTab يتضمن:**  
`meta_title_en/ar`, `meta_description_en/ar`, `h1_en/ar`, `meta_keywords_en/ar`, `canonical_url`, `og_title_en/ar`, `og_description_en/ar`, `og_image`, `og_image_alt_en/ar`

---

### ✅ 14. مركز الموارد — أنواع المحتوى

**الحالة: ✅ مطبق كاملاً**

| نوع المحتوى | النموذج | Migration | Filament Resource | صفحة الواجهة |
|------------|---------|-----------|-------------------|---------------|
| White Papers | `WhitePaper.php` ✅ | ✅ | `WhitePaperResource.php` ✅ | `resources/white-papers/` ✅ |
| CIO Flash | `CioFlash.php` ✅ | ✅ | `CioFlashResource.php` ✅ | `resources/cio-flash/` ✅ |
| Monday Window | `MondayWindow.php` ✅ | ✅ | `MondayWindowResource.php` ✅ | `resources/monday-window/` ✅ |
| Research | `Research.php` ✅ | ✅ | `ResearchResource.php` ✅ | `resources/research/` ✅ |
| Blog | `Blog.php` ✅ | ✅ | `BlogResource.php` ✅ | `/blog` ✅ |

**الروابط في web.php:**
```php
Route::get('/resources-center/white-papers', ...)->name('white-papers');
Route::get('/resources-center/cio-flash', ...)->name('cio-flash');
Route::get('/resources-center/monday-window', ...)->name('monday-window');
Route::get('/resources-center/research', ...)->name('research');
```

**ملاحظة:** تبويبات قديمة "HAUBERK MANUALS" و"NEWS & EVENTS" و"INVESTOR TOOLS" موجودة في الكود لكنها مُخفّية داخل تعليق HTML (`<!-- ... -->`).

---

### ✅ 15. فحص المجلدات الرئيسية

**app/Models/ — النماذج الموجودة:**
About, App, Appointment, AppointmentPage, Article, Blog, Book, Career, CareerApplication, Careers, CaseStudy, Category, CioFlash, CioServices, Contact, ContactUs, CookiePolicy, Glossary, GovernanceServices, Home, InvestmentServices, MeetingRequest, MondayWindow, Newsletter, NewsletterSubscription, Page, PrivacyPolicy, Question, Research, ResearchDownload, ResourceCenter, SeoMeta, Services, Setting, SubCategory, Team, Teams, TermsConditions, ToolsFormField, Tools, ToolsSubmission, User, WealthServices, WebsiteSettings, WhitePaper, WhitePaperDownload

**app/Filament/Admin/Resources/ — الموارد الموجودة:**
جميع الموارد الرئيسية موجودة بما يشمل كل أنواع مركز الموارد.

**routes/web.php:**
جميع الروابط تُعرَّف بدون prefix `/ar/`.

**resources/views/ — القوالب:**
بنية منطقية ومنظمة جيداً: homePage, blogs, services, resources, layouts, components, partials.

**database/migrations:**
~80 ملف migration، يغطي جميع الصفحات والأنواع بشكل تدريجي.

**app/Http/Controllers/Admin/FrontendController.php:**
Controller رئيسي يخدم جميع الصفحات، منظم جيداً.

---

## ملخص النتائج والتوصيات

| النقطة | الحالة | الأولوية |
|--------|--------|----------|
| 1. روابط /ar/ prefix | ❌ غير موجود | 🔴 عالية |
| 2. بطاقات المقالات | ✅ مكتملة | — |
| 3. وقت النشر (publish_time) | ⚠️ تاريخ فقط | 🟡 متوسطة |
| 4. Canonical URL | ✅ آلي + يدوي | — |
| 5. نظام الصور (desktop/mobile) | ⚠️ featured+thumbnail للبلوج فقط | 🟡 متوسطة |
| 6. إدارة Redirects | ❌ غير موجود | 🔴 عالية |
| 7. H1 مستقل في الهوم | ⚠️ لا SeoTab في HomeResource | 🟡 متوسطة |
| 8. HTML في حقول المحتوى | ✅ يعمل | — |
| 9. أخطاء النسخة العربية | ⚠️ ملف قديم + CTA رسورس سنتر | 🟡 متوسطة |
| 10. ALT + Title للصور | ⚠️ ALT فقط، Title غائب | 🟡 متوسطة |
| 11. Lazy loading / srcset | ❌ غير موجود | 🔴 عالية |
| 12. Schema / JSON-LD | ✅ ديناميكي وشامل | — |
| 13. SEO لجميع الصفحات | ⚠️ HomeResource و ServicesResource ناقصان | 🟡 متوسطة |
| 14. مركز الموارد (5 أنواع) | ✅ مكتمل | — |
| 15. فحص المجلدات | ✅ بنية سليمة | — |

---

## أولويات الإصلاح المقترحة

### 🔴 عاجل
1. **نظام Redirects:** إنشاء `Redirect` model + migration + Filament resource + middleware
2. **روابط اللغة العربية:** إضافة Route Group بـ `prefix('ar')` وربطه بالـ locale middleware
3. **Lazy loading للصور:** إضافة `loading="lazy"` لجميع `<img>` خارج الـ hero

### 🟡 متوسطة
4. **publish_time:** إضافة حقل TimePicker في موارد البلوج ومحتويات الريسورس سنتر
5. **Image title attribute:** إضافة حقول `image_title_en/ar` في النماذج والموارد والقوالب
6. **SeoTab في HomeResource و ServicesResource**
7. **ملف serviceSection.blade.php القديم:** إما حذفه أو تحديثه بدعم الثنائية اللغوية
8. **CTA section في مركز الموارد عربياً:** إضافة fallback إذا كان `cta_title_ar` فارغاً

### 🟢 تحسين إضافي
9. **srcset و WebP:** تحسين شامل لأداء الصور
10. **Schema لـ WhitePaper/Research/CioFlash/MondayWindow:** إضافة أنواع schema مخصصة
