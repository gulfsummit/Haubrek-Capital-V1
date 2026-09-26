# محضر حالة المشروع

> هذه لقطة تاريخية للمستودع السابق `capital` قبل إعادة تهيئة Git في 2026-09-26. لا تمثل حالة المستودع الجديد `main` ولا تعني أن محتوى النسخة مطابق للإنتاج. تاريخ Git السابق محفوظ في `../hauberk-capital-git-backup-20260926`.

**تاريخ توثيق الحالة:** 2026-09-26  
**الغرض:** تثبيت نقطة بداية واضحة قبل بدء تعديلات جديدة اليوم.  
**المشروع:** Hauberk Capital  
**الفرع المحلي:** `capital`

أُخذت أرقام Git أدناه قبل إنشاء ملف المحضر هذا؛ ملف المحضر نفسه إضافة توثيقية جديدة وغير متتبعة.

## أساس المقارنة

هذا المحضر مبني على حالة Git الموجودة محليًا وقت الفحص. المقارنة هي مع آخر commit محلي (`HEAD`)، وليست مقارنة مباشرة بملفات السيرفر الحي أو بقاعدة بياناته. مرجع `origin/capital` هو المرجع المسجل محليًا ولم يتم تحديثه من remote أثناء إعداد هذا المحضر.

- `HEAD`: `c25d1bc`، رسالة commit: `test`، التاريخ: 2025-08-25.
- الفرع المحلي متقدم commit واحدًا عن `origin/capital` وفقًا لبيانات Git المحلية.
- لا توجد في هذه اللقطة دلالة تثبت أن محتوى الملفات الحالي مطابق تمامًا لما كان منشورًا على live.

## حالة التغييرات وقت التوثيق

### تغييرات في Git staging

إجمالي 485 تغييرًا جاهزًا للـ commit:

- 393 ملفًا مضافًا.
- 49 ملفًا معدّلًا.
- 39 ملفًا محذوفًا.
- 4 عمليات إعادة تسمية.

أكبر مجموعات الملفات المتأثرة: `app/Filament` (160 ملفًا)، `resources` (121)، `database` (116)، و`app/Models` (34).

### تغييرات خارج staging

- 23 ملفًا معدّلًا، بينها ملفات واجهات وقوالب، `routes/web.php`، `composer.json` و`composer.lock`.
- تحتوي `composer.json` و`composer.lock` على تغييرات مرحّلة وغير مرحّلة معًا.

### ملفات غير متتبعة

- `hauberk_capital.sql`
- `public/sitemap-static.xml`
- `resources/views/services/partials/responsive-styles.blade.php`

## ملخص نطاق العمل الموجود

بحسب أسماء الملفات والاختلافات المسجلة في Git، تشمل التغييرات الواسعة ما يلي:

- توسعة لوحة Filament وموارد إدارة محتوى الموقع.
- نماذج وعمليات قاعدة بيانات لخدمات وصفحات الموقع، الفريق، المدونات ودراسات الحالة، الوظائف، الطلبات والمواعيد، الأدوات، النشرة البريدية، السياسات القانونية وبيانات SEO.
- تغييرات كبيرة على قوالب صفحات الموقع، بما فيها الرئيسية والخدمات والفريق والمدونة والتواصل، مع ملفات CSS وJavaScript وأصول واجهة إضافية.
- إضافة إعدادات وعمليات مرتبطة بـ reCAPTCHA والإشعارات وإدارة إعدادات الموقع.
- حذف أو استبدال بعض موارد Filament والقوالب القديمة ضمن إعادة تنظيم أوسع.

## نقاط محددة في التغييرات غير المرحّلة

- `routes/web.php`: إضافة مسار `/sitemap.xml` يستخدم `spatie/laravel-sitemap` ويكتب الناتج إلى `public/sitemap-static.xml`.
- `composer.json`: إضافة الاعتماد `spatie/schema-org`.
- `public/robots.txt`: منع فهرسة مسارات إدارية وخاصة وبعض أنماط البحث والاستعلام.
- `app/Http/Controllers/Admin/FrontendController.php`: مسار طلب الاجتماع أصبح يعيد المستخدم إلى صفحة الطلب برسالة نجاح مباشرة؛ أزيل من هذا المسار فحص الأهلية وإرسال إشعار البريد.

## ما يمكن وما لا يمكن نسبته

التغييرات الموجودة في staging أو working tree لم تُحفظ بعد كـ commits؛ لذلك لا يسجل Git مؤلفها أو الشخص الذي أضافها إلى staging، ولا يمكن من هذه اللقطة إثبات من كتبها.

سجل Git المتاح يعرض:

- `c25d1bc`: المؤلف `root <root@vps.server.local>`، رسالة `test`.
- `ebda8ed` و`ed3016f`: المؤلف `hayamali-developer <hayam3573@gmail.com>`، رسالة `first commit`.

هذه بيانات مؤلفي commits السابقة فقط، ولا تثبت أن أيًا منهم نفّذ التغييرات الحالية. كما أن اسم `root` قد يمثل حسابًا على الخادم وليس هوية شخص بعينه.

## احتياطات قبل اعتماد الحالة

- راجع `hauberk_capital.sql` و`crm.sql` قبل مشاركتهما أو إضافتهما إلى Git؛ ملفات SQL قد تحتوي بيانات إنتاجية أو معلومات حساسة.
- لا تعتبر هذه التغييرات منشورة على live لمجرد وجودها في النسخة المحلية.
- لم يشغّل هذا الفحص اختبارات أو migrations، ولم يتحقق من محتوى قاعدة بيانات live.
- يُستحسن حفظ مرجع commit/نسخة من live قبل بدء التعديلات الجديدة إذا كان المطلوب لاحقًا إثبات الفرق مع الإنتاج بدقة.

## إعادة فحص الحالة

من جذر المشروع يمكن استخدام:

```sh
git status --short --branch
git diff --cached --stat
git diff --stat
git log -3 --date=short --pretty=format:'%h | %ad | %an <%ae> | %s'
```

## Organization After The Snapshot

The paths below were reorganized after the Git counts above were captured. File contents were moved without editing as part of that organization:

- `crm.sql` -> `database/backups/crm.sql`
- `hauberk_capital.sql` -> `database/backups/hauberk_capital.sql`
- `serviceSection.blade.php` -> `resources/views/homePage/serviceSection.blade.php`
- `fix-permissions.sh` -> `scripts/fix-permissions.sh`

The snapshot records the earlier baseline; these moves are later local changes and are not included in its staged/unstaged counts.
