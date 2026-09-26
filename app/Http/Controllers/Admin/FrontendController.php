<?php

namespace App\Http\Controllers\Admin;

use Carbon\CarbonImmutable;
use App\Models\Book;
use App\Models\Home;
use App\Models\App;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Glossary;
use App\Models\Question;
use App\Models\SubCategory;
use App\Models\Appointment;
use App\Models\AppointmentPage;
use App\Models\WebsiteSettings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Http\Resources\BookResource;


use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Notification;

use App\Http\Resources\ArticleResource;

use App\Http\Resources\SettingResource;
use App\Http\Resources\GlossaryResource;
use App\Models\About;
use App\Http\Resources\TeamsResource;
use App\Notifications\ContactUsNotification;
use App\Notifications\ToolsNotification;
use App\Notifications\CareerApplicationNotification;
use App\Notifications\AppointmetNotification;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class FrontendController extends Controller
{
    public function home()
    {
        $homeData = Home::first();
        $seoMeta = $homeData?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta ?? null;

        return view('homePage.home', [
            'homeData' => $homeData,
            'seoMeta' => $seoMeta,
            'insightItems' => $this->getHomeInsightItems(),
        ]);
    }

    public function service()
    {
        $serviceData = \App\Models\Services::first();
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();

        return view('services.service', [
            'serviceData' => $serviceData ? (new \App\Http\Resources\ServicesResource($serviceData))->resolve() : null,
            'servicesPage' => $serviceData,
            'services' => $services,
            'settings' => $settings,
            'seoMeta' => $serviceData?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
        ]);
    }

    public function governanceServices()
    {
        try {
            $services = SubCategory::get();
            $settings = SettingResource::collection(Setting::first()->get())->resolve();
            $governanceServices = \App\Models\GovernanceServices::getContent();

            return view('services.governance-services', [
                'services' => $services,
                'settings' => $settings,
                'governanceServices' => $governanceServices,
                'seoMeta' => $governanceServices?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('GovernanceServices error: ' . $e->getMessage());
            return response('Error: ' . $e->getMessage(), 500);
        }
    }

    public function cioServices()
    {
        try {
            $services = SubCategory::get();
            $settings = SettingResource::collection(Setting::first()->get())->resolve();
            $cioServices = \App\Models\CioServices::getContent();

            return view('services.cio-services', [
                'services' => $services,
                'settings' => $settings,
                'cioServices' => $cioServices,
                'seoMeta' => $cioServices?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in cioServices: ' . $e->getMessage());
            return response('Error: ' . $e->getMessage(), 500);
        }
    }

    public function investmentServices()
    {
        try {
            $services = SubCategory::get();
            $settings = SettingResource::collection(Setting::first()->get())->resolve();
            $investmentServices = \App\Models\InvestmentServices::getContent();

            return view('services.investment-services', [
                'services' => $services,
                'settings' => $settings,
                'investmentServices' => $investmentServices,
                'seoMeta' => $investmentServices?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in investmentServices: ' . $e->getMessage());
            return response('Error: ' . $e->getMessage(), 500);
        }
    }

    public function wealthServices()
    {
        try {
            $services = SubCategory::get();
            $settings = SettingResource::collection(Setting::first()->get())->resolve();
            $wealthServices = \App\Models\WealthServices::getContent();

            return view('services.wealth-services', [
                'services' => $services,
                'settings' => $settings,
                'wealthServices' => $wealthServices,
                'seoMeta' => $wealthServices?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in wealthServices: ' . $e->getMessage());
            return response('Error: ' . $e->getMessage(), 500);
        }
    }

    public function wealthPlanningServices()
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();

        return view('services.wealth-planning', [
            'services' => $services,
            'settings' => $settings,
        ]);
    }


    public function requestMeeting()
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $pageContent = $this->getPageContent('request-meeting');

        return view('meeting.requestmeeting', [
            'services' => $services,
            'settings' => $settings,
            'pageContent' => $pageContent,
            'seoMeta' => $this->getPageSeoMeta('request-meeting'),
        ]);
    }


      public function articles()
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $categories = Category::query()->orderBy('name_en')->get();

        return view('articles.index', [
              'articles' => ArticleResource::collection(Article::all())->resolve(),
              'services' => $services,
              'settings' => $settings,
              'categories' => $categories,
              'pageContent' => $this->getPageContent('articles-list'),
        ]);

    }

    public function article($id)
    {
        $article = Article::findOrFail($id);
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $latestArticles = Article::query()
            ->where('id', '!=', $article->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('articles.show', [
            'article' => (new ArticleResource($article))->resolve(),
            'services' => $services,
            'settings' => $settings,
            'latestArticles' => ArticleResource::collection($latestArticles)->resolve(),
            'categories' => Category::query()->orderBy('name_en')->get(),
            'pageContent' => $this->getPageContent('articles-detail'),
        ]);

    }

    public function blog(Request $request)
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $categories = $this->getBlogCategories();
        $categoryLookup = $categories->keyBy('slug');
        
        $query = Blog::published()->ordered();
        
        // Only apply search filter if search term is provided
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title_en', 'like', "%{$searchTerm}%")
                  ->orWhere('title_ar', 'like', "%{$searchTerm}%")
                  ->orWhere('description_en', 'like', "%{$searchTerm}%")
                  ->orWhere('description_ar', 'like', "%{$searchTerm}%")
                  ->orWhere('content_en', 'like', "%{$searchTerm}%")
                  ->orWhere('content_ar', 'like', "%{$searchTerm}%");
            });
        }
        
        $selectedCategory = $request->get('category', 'all');
        if ($selectedCategory !== 'all') {
            if ($categoryLookup->has($selectedCategory)) {
                $query->byCategory($categoryLookup->get($selectedCategory)['value']);
            } else {
                $selectedCategory = 'all';
            }
        }
        
        $blogs = $query->get();

        $pageContent = $this->getPageContent('blog-list');

        return view('blogs.blog', [
            'services' => $services,
            'settings' => $settings,
            'blogs' => $blogs,
            'categories' => $categories,
            'currentCategory' => $selectedCategory,
            'searchTerm' => $request->get('search', ''),
            'seoMeta' => $pageContent?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
            'pageContent' => $pageContent,
        ]);
    }

    public function blogShow(Blog $blog)
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $categories = $this->getBlogCategories();
        
        // Get latest 3 blogs (excluding current blog)
        $latestBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('blogs.show', [
            'blog' => $blog,
            'services' => $services,
            'settings' => $settings,
            'latestBlogs' => $latestBlogs,
            'categories' => $categories,
            'seoMeta' => $blog->seoMeta,
            'pageContent' => $this->getPageContent('blog-detail'),
        ]);
    }

    public function caseStudies(Request $request)
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $categories = $this->getCaseStudyCategories();
        $categoryLookup = $categories->keyBy('slug');

        $query = CaseStudy::published()->ordered();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title_en', 'like', "%{$searchTerm}%")
                    ->orWhere('title_ar', 'like', "%{$searchTerm}%")
                    ->orWhere('description_en', 'like', "%{$searchTerm}%")
                    ->orWhere('description_ar', 'like', "%{$searchTerm}%")
                    ->orWhere('content_en', 'like', "%{$searchTerm}%")
                    ->orWhere('content_ar', 'like', "%{$searchTerm}%");
            });
        }

        $selectedCategory = $request->get('category', 'all');
        if ($selectedCategory !== 'all') {
            if ($categoryLookup->has($selectedCategory)) {
                $query->byCategory($categoryLookup->get($selectedCategory)['value']);
            } else {
                $selectedCategory = 'all';
            }
        }

        $caseStudies = $query->get();

        $pageContent = $this->getPageContent('case-studies-list');

        return view('case-studies.index', [
            'services' => $services,
            'settings' => $settings,
            'caseStudies' => $caseStudies,
            'categories' => $categories,
            'currentCategory' => $selectedCategory,
            'searchTerm' => $request->get('search', ''),
            'seoMeta' => $pageContent?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
            'pageContent' => $pageContent,
        ]);
    }

    public function caseStudyShow(CaseStudy $caseStudy)
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $categories = $this->getCaseStudyCategories();

        $latestCaseStudies = CaseStudy::published()
            ->where('id', '!=', $caseStudy->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('case-studies.show', [
            'caseStudy' => $caseStudy,
            'services' => $services,
            'settings' => $settings,
            'latestCaseStudies' => $latestCaseStudies,
            'categories' => $categories,
            'seoMeta' => $caseStudy->seoMeta,
            'pageContent' => $this->getPageContent('case-studies-detail'),
        ]);
    }





    public function teamsPage()
    {
        $teamsData = \App\Models\Teams::first();
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();

        return view('teams.teams', [
            'teamsData' => $teamsData,
            'services' => $services,
            'settings' => $settings,
            'seoMeta' => $teamsData?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
        ]);
    }
     public function books()
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $categories = Category::query()->orderBy('name_en')->get();

        return view('books.index',[
            'books'=>BookResource::collection(Book::all())->resolve(),
            'services' => $services,
            'settings' => $settings,
            'categories' => $categories,
            'pageContent' => $this->getPageContent('books-list'),
    ]);

    }


        public function book($id)
    {
        $book = Book::findOrFail($id);
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $latestBooks = Book::query()
            ->where('id', '!=', $book->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('books.show', [
            'book' => (new BookResource($book))->resolve(),
            'services' => $services,
            'settings' => $settings,
            'latestBooks' => BookResource::collection($latestBooks)->resolve(),
            'categories' => Category::query()->orderBy('name_en')->get(),
            'pageContent' => $this->getPageContent('books-detail'),
        ]);

    }

    public function about_us()
    {
        $faqs=About::first();
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();

        return view('about-us',[
            'faqs' => (new AboutResource($faqs))->resolve(),
            'services' => $services,
            'settings' => $settings,
            'aboutModel' => $faqs,
            'seoMeta' => $faqs?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
        ]);

    }



    public function glossaries()
    {
        return view('glossaries.index', [
            'glossaries' => GlossaryResource::collection(Glossary::all())->resolve(),
            'categories' => Category::query()->orderBy('name_en')->get(),
            'pageContent' => $this->getPageContent('glossaries-list'),
        ]);

    }

    public function glossary($id)
    {
        $glossary = Glossary::findOrFail($id);
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $latestGlossaries = Glossary::query()
            ->where('id', '!=', $glossary->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('glossaries.show', [
            'glossary' => (new GlossaryResource($glossary))->resolve(),
            'services' => $services,
            'settings' => $settings,
            'latestGlossaries' => GlossaryResource::collection($latestGlossaries)->resolve(),
            'categories' => Category::query()->orderBy('name_en')->get(),
            'pageContent' => $this->getPageContent('glossaries-detail'),
        ]);

    }


    public function tools()
    {
        $tools = \App\Models\Tools::first();
        $formFields = \App\Models\ToolsFormField::orderBy('order')->get();
        
        return view('tools.index', [
            'tools' => $tools,
            'formFields' => $formFields,
            'seoMeta' => $tools?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
        ]);
    }


    public function question(){
        $pageContent = $this->getPageContent('faq');

        return view('questions.faq', [
            'pageContent' => $pageContent,
            'seoMeta' => $pageContent?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
        ]);
    }

    public function risk_assessments(Request $request) {
        // Get all form fields from database to build dynamic validation rules
        $formFields = \App\Models\ToolsFormField::all();
        
        // Build dynamic validation rules based on form fields
        $rules = [];
        foreach ($formFields as $field) {
            $fieldRules = [];
            
            // Add required rule if needed
            if ($field->is_required) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }
            
            // Add type-specific rules
            switch ($field->field_type) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'tel':
                    $fieldRules[] = 'string';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'text':
                case 'textarea':
                    $fieldRules[] = 'string';
                    $fieldRules[] = 'max:1000';
                    break;
                case 'radio':
                case 'select':
                    $fieldRules[] = 'string';
                    break;
                case 'checkbox':
                    $fieldRules[] = 'array';
                    break;
            }
            
            $rules[$field->field_name] = $fieldRules;
            
            // For checkbox arrays, add validation for individual items
            if ($field->field_type === 'checkbox') {
                $rules[$field->field_name . '.*'] = ['string'];
            }
        }
        
        // Add reCAPTCHA validation
        $rules['g-recaptcha-response'] = ['required', new \App\Rules\RecaptchaRule('risk_assessment')];
        
        // Validate the request with dynamic rules
        $validated = $request->validate($rules);
        
        // Store the submission in the new tools_submissions table
        \App\Models\ToolsSubmission::create([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'form_data' => $validated,
        ]);
        
        // Return back to the same page with success message (no redirect)
        return back()->with('success', 'Form submitted successfully! Thank you for your interest.');
    }

  public function app()
    {
        $appData = App::first();
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();

        return view('app.app', [
            'appData' => $appData,
            'services' => $services,
            'settings' => $settings,
            'seoMeta' => $appData?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
        ]);
    }

    public function contactUs()

    {
        $contactUs = \App\Models\ContactUs::where('is_active', true)->first();
        $websiteSettings = \App\Models\WebsiteSettings::first();
        return view('contact',[
            'settings'=>SettingResource::collection(Setting::first()->get())->resolve(),
            'contactUs' => $contactUs,
            'websiteSettings' => $websiteSettings,
            'seoMeta' => $contactUs?->seoMeta ?? $websiteSettings?->seoMeta,
        ]);

    }


    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^[0-9+\-\s\(\)]{7,20}$/',
            'message' => 'required|string',
            'g-recaptcha-response' => ['required', new \App\Rules\RecaptchaRule('contact_form')],
        ]);


        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ]);

        Notification::route('mail', 'admin@hauberkcapital.com')
            ->notify(new ContactUsNotification($contact));


        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    public function storeAppointment(Request $request)
    {
        $appointmentPage = AppointmentPage::first();
        $localizeAppointmentCopy = function (string $englishField, string $arabicField, string $fallback) use ($appointmentPage) {
            $isArabic = app()->getLocale() === 'ar';

            $englishValue = $appointmentPage?->{$englishField};
            $arabicValue = $appointmentPage?->{$arabicField};

            return $isArabic
                ? ($arabicValue ?: $englishValue ?: $fallback)
                : ($englishValue ?: $arabicValue ?: $fallback);
        };

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^[0-9+\-\s\(\)]{7,20}$/',
            'company_name' => 'nullable|string|max:255',
            'user_type' => 'required|string|in:Family office,Individual,Individual / HNWI,Corporate,Endowment,Others',
            'message' => 'nullable|string',
            'g-recaptcha-response' => ['required', new \App\Rules\RecaptchaRule('appointment_booking')],
            'selected_date' => 'required|date_format:Y-m-d',
            'selected_time' => 'required|string',
        ]);

        $validator->after(function ($validator) use ($request, $localizeAppointmentCopy) {
            $selectedDate = $request->input('selected_date');
            $selectedTime = $this->normalizeAppointmentTime($request->input('selected_time'));

            if (! $selectedTime) {
                $validator->errors()->add('selected_time', $localizeAppointmentCopy(
                    'slot_unavailable_message_en',
                    'slot_unavailable_message_ar',
                    'Please select a valid appointment time.'
                ));
                return;
            }

            try {
                $date = CarbonImmutable::createFromFormat('Y-m-d', $selectedDate, $this->appointmentTimezone())->startOfDay();
            } catch (\Throwable $exception) {
                $validator->errors()->add('selected_date', $localizeAppointmentCopy(
                    'past_date_validation_message_en',
                    'past_date_validation_message_ar',
                    'Please select a valid appointment date.'
                ));
                return;
            }

            $todayDubai = CarbonImmutable::now($this->appointmentTimezone())->startOfDay();

            if ($date->lt($todayDubai)) {
                $validator->errors()->add('selected_date', $localizeAppointmentCopy(
                    'past_date_validation_message_en',
                    'past_date_validation_message_ar',
                    'Please select today or a future date.'
                ));
            }

            if ($date->isWeekend()) {
                $validator->errors()->add('selected_date', $localizeAppointmentCopy(
                    'weekend_validation_message_en',
                    'weekend_validation_message_ar',
                    'Appointments are only available from Monday to Friday.'
                ));
            }

            $availableSlots = $this->appointmentAvailabilityForDate($date);

            if (! in_array($selectedTime, $availableSlots, true)) {
                $validator->errors()->add('selected_time', $localizeAppointmentCopy(
                    'slot_unavailable_message_en',
                    'slot_unavailable_message_ar',
                    'This appointment slot is no longer available. Please choose another time.'
                ));
            }
        });

        $validated = $validator->validate();
        $validated['selected_time'] = $this->normalizeAppointmentTime($validated['selected_time']);

        // Ensure optional fields have sensible defaults for non-nullable columns
        if (empty($validated['company_name'])) {
            $validated['company_name'] = 'N/A';
        }

        $appointment = Appointment::create($validated);


        Notification::route('mail', 'admin@hauberkcapital.com')
            ->notify(new AppointmetNotification($appointment));

        return redirect()->back()->with('success', $localizeAppointmentCopy(
            'success_message_en',
            'success_message_ar',
            'Appointment booked successfully! We will contact you soon.'
        ));
    }

    public function appointmentAvailability(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        $date = CarbonImmutable::createFromFormat('Y-m-d', $validated['date'], $this->appointmentTimezone())->startOfDay();

        return response()->json([
            'date' => $validated['date'],
            'timezone' => $this->appointmentTimezone(),
            'available_slots' => $this->appointmentAvailabilityForDate($date),
            'booked_slots' => $this->bookedAppointmentSlotsForDate($date),
        ]);
    }

    public function appointment()
    {
        $appointmentPage = AppointmentPage::first();

        return view('calendar.calendar', [
            'appointmentPage' => $appointmentPage,
            'seoMeta' => $appointmentPage?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
            'appointmentAvailabilityUrl' => route('appointment.availability'),
            'appointmentTimezone' => $this->appointmentTimezone(),
            'appointmentBusinessDays' => [1, 2, 3, 4, 5],
            'appointmentSlotIntervalMinutes' => 30,
            'appointmentStartTime' => '10:00',
            'appointmentEndTime' => '18:00',
            'appointmentTodayDubai' => CarbonImmutable::now($this->appointmentTimezone())->toDateString(),
        ]);
    }

    protected function appointmentTimezone(): string
    {
        return 'Asia/Dubai';
    }

    protected function appointmentAvailabilityForDate(CarbonImmutable $date): array
    {
        if ($date->isWeekend()) {
            return [];
        }

        $allowedSlots = $this->allowedAppointmentSlots();
        $bookedSlots = $this->bookedAppointmentSlotsForDate($date);
        $availableSlots = array_values(array_diff($allowedSlots, $bookedSlots));

        $todayDubai = CarbonImmutable::now($this->appointmentTimezone())->startOfDay();

        if ($date->equalTo($todayDubai)) {
            $bufferTime = CarbonImmutable::now($this->appointmentTimezone())->addMinutes(30);

            $availableSlots = array_values(array_filter($availableSlots, function (string $slot) use ($date, $bufferTime) {
                $slotDateTime = $this->appointmentDateTimeFromDateAndTime($date, $slot);

                return $slotDateTime && $slotDateTime->greaterThanOrEqualTo($bufferTime);
            }));
        }

        return array_values($availableSlots);
    }

    protected function bookedAppointmentSlotsForDate(CarbonImmutable $date): array
    {
        return Appointment::query()
            ->whereDate('selected_date', $date->toDateString())
            ->pluck('selected_time')
            ->map(fn ($time) => $this->normalizeAppointmentTime((string) $time))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    protected function allowedAppointmentSlots(): array
    {
        $slots = [];
        $start = CarbonImmutable::createFromFormat('H:i', '10:00', $this->appointmentTimezone());
        $end = CarbonImmutable::createFromFormat('H:i', '18:00', $this->appointmentTimezone());

        for ($current = $start; $current->lessThanOrEqualTo($end); $current = $current->addMinutes(30)) {
            $slots[] = strtolower($current->format('g:ia'));
        }

        return $slots;
    }

    protected function normalizeAppointmentTime(?string $time): ?string
    {
        if (! is_string($time) || trim($time) === '') {
            return null;
        }

        $normalizedInput = strtolower(trim(preg_replace('/\s+/', '', $time)));

        foreach (['g:ia', 'H:i'] as $format) {
            try {
                $parsed = CarbonImmutable::createFromFormat($format, $normalizedInput, $this->appointmentTimezone());

                if ($parsed !== false) {
                    return strtolower($parsed->format('g:ia'));
                }
            } catch (\Throwable $exception) {
                //
            }
        }

        return null;
    }

    protected function appointmentDateTimeFromDateAndTime(CarbonImmutable $date, string $time): ?CarbonImmutable
    {
        $normalizedTime = $this->normalizeAppointmentTime($time);

        if (! $normalizedTime) {
            return null;
        }

        try {
            return CarbonImmutable::createFromFormat(
                'Y-m-d g:ia',
                $date->toDateString() . ' ' . $normalizedTime,
                $this->appointmentTimezone()
            );
        } catch (\Throwable $exception) {
            return null;
        }
    }

    public function resourcesCenter()
    {
        $resourceCenter = \App\Models\ResourceCenter::where('is_active', true)->first();
        return view('resources.resources-center', [
            'resourceCenter' => $resourceCenter,
            'seoMeta' => $resourceCenter?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
        ]);
    }

    public function storeMeetingRequest(Request $request)
    {
        // Use the same validation as the tools page
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^[0-9+\-\s\(\)]{7,20}$/',
            // radio button fields (single values)
            'percentage' => 'required|string|in:Less than 25%,25-50%,50-75%,More than 75%',
            'age_group' => 'required|string|in:Under 30,30-45,46-60,Over 60',
            'investment_experience' => ['required', 'string', Rule::in(['None', 'Limited', 'Moderate', 'Extensive'])],
            'wealth_size' => ['required', 'string', Rule::in([
                'Less than USD 1 million',
                'USD 1 million - USD 10 million',
                'USD 10 million - USD 50 million',
                'USD 50 million - USD 500 million',
            ])],

            'investment_goal' => ['required', 'array'],
            'investment_goal.*' => ['string', Rule::in(['Capital Preservation', 'Income Generation', 'Capital Growth'])],

            'investment_horizon' => ['required', 'string', Rule::in(['Less than 3 years', '3-5 years', 'More than 5 years'])],

            'investment_reaction' => ['required', 'array'],
            'investment_reaction.*' => ['string', Rule::in([
                'Sell all investments',
                'Sell some investments',
                'Do nothing',
                'Buy more investments',
            ])],

            'income_source' => ['required', 'array'],
            'income_source.*' => ['string', Rule::in(['Salary', 'Business Income', 'Investment Income'])],

            'investment_style' => ['required', 'array'],
            'investment_style.*' => [
                'string',
                Rule::in([
                    'Conservative (low risk, lower returns)',
                    'Balanced (moderate risk, moderate returns)',
                    'Aggressive (high risk, higher returns)',
                ]),
            ],

            'asset_allocation' => ['required', 'array'],
            'asset_allocation.*' => [
                'string',
                Rule::in([
                    'Equities',
                    'Bonds',
                    'Real Estate',
                    'Cash',
                    'Family Business',
                    'Other Investments',
                ]),
            ],
            'g-recaptcha-response' => ['required', new \App\Rules\RecaptchaRule('meeting_request')],
        ]);

        // Create a new meeting request record using the same structure as tools
        \App\Models\MeetingRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'percentage' => $validated['percentage'],
            'age_group' => $validated['age_group'],
            'investment_experience' => $validated['investment_experience'],
            'wealth_size' => $validated['wealth_size'],
            'investment_goal' => $validated['investment_goal'],
            'investment_horizon' => $validated['investment_horizon'],
            'investment_reaction' => $validated['investment_reaction'],
            'income_source' => $validated['income_source'],
            'investment_style' => $validated['investment_style'],
            'asset_allocation' => $validated['asset_allocation'],
        ]);

        return redirect()
            ->route('request-meeting')
            ->with('success', 'Thank you! Your meeting request has been submitted successfully.');
    }

    public function careers()
    {
        $services = SubCategory::get();
        $settings = SettingResource::collection(Setting::first()->get())->resolve();
        $careers = \App\Models\Careers::where('is_active', true)->first();

        return view('careers.careers', [
             'services' => $services,
             'settings' => $settings,
             'careers' => $careers,
            'seoMeta' => $careers?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta,
         ]);

    }

    public function storeCareerApplication(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            'g-recaptcha-response' => ['required', new \App\Rules\RecaptchaRule('career_application')],
        ]);

        // Store the CV file
        $cvPath = $request->file('cv')->store('careers/cvs', 'public');

        // Create career application record
        $careerApplication = \App\Models\CareerApplication::create([
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'cv_path' => $cvPath,
        ]);

        // Send notification email
        Notification::route('mail', 'careers@hauberkcapital.com')
            ->notify(new CareerApplicationNotification($careerApplication));

        return redirect()->back()->with('success', 'Your application has been submitted successfully! We will contact you soon.');
    }

    public function privacyPolicy()
    {
        $privacyPolicy = \App\Models\PrivacyPolicy::where('is_active', true)->first();
        return view('legal.privacy-policy', compact('privacyPolicy'));
    }

    public function termsConditions()
    {
        $termsConditions = \App\Models\TermsConditions::where('is_active', true)->first();
        return view('legal.terms-conditions', compact('termsConditions'));
    }

    public function cookiePolicy()
    {
        $cookiePolicy = \App\Models\CookiePolicy::where('is_active', true)->first();
        return view('legal.cookie-policy', compact('cookiePolicy'));
    }

    public function sitemap(): Response
    {
        $urls = collect($this->staticSitemapEntries())
            ->merge(
                Blog::published()->ordered()->get()->map(fn (Blog $blog) => [
                    'loc' => route('blog.show', $blog),
                    'lastmod' => optional($blog->updated_at ?? $blog->created_at)?->toAtomString(),
                ])
            )
            ->merge(
                CaseStudy::published()->ordered()->get()->map(fn (CaseStudy $caseStudy) => [
                    'loc' => route('case-studies.show', $caseStudy),
                    'lastmod' => optional($caseStudy->updated_at ?? $caseStudy->created_at)?->toAtomString(),
                ])
            )
            ->merge(
                Article::query()->latest('updated_at')->get()->map(fn (Article $article) => [
                    'loc' => route('article.show', $article->id),
                    'lastmod' => optional($article->updated_at ?? $article->created_at)?->toAtomString(),
                ])
            )
            ->merge(
                Book::query()->latest('updated_at')->get()->map(fn (Book $book) => [
                    'loc' => route('book.show', $book->id),
                    'lastmod' => optional($book->updated_at ?? $book->created_at)?->toAtomString(),
                ])
            )
            ->merge(
                Glossary::query()->latest('updated_at')->get()->map(fn (Glossary $glossary) => [
                    'loc' => route('glossary.show', $glossary->id),
                    'lastmod' => optional($glossary->updated_at ?? $glossary->created_at)?->toAtomString(),
                ])
            )
            ->unique('loc')
            ->values();

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /dashboard',
            'Disallow: /admin',
            'Disallow: /storage/*.php',
            'Sitemap: ' . url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    public function fallback(Request $request)
    {
        if ($redirect = $this->legacyRedirectFor($request)) {
            return redirect($redirect, 301);
        }

        return response()->view('errors.404', [], 404);
    }

    protected function getPageContent(string $slug): ?Page
    {
        return Page::forSlug($slug);
    }

    protected function getPageSeoMeta(string $slug): ?\App\Models\SeoMeta
    {
        return $this->getPageContent($slug)?->seoMeta ?? WebsiteSettings::getSettings()->seoMeta;
    }

    protected function staticSitemapEntries(): array
    {
        return [
            ['loc' => route('home'), 'lastmod' => optional(Home::first()?->updated_at)->toAtomString()],
            ['loc' => route('about-us'), 'lastmod' => optional(About::first()?->updated_at)->toAtomString()],
            ['loc' => route('teams'), 'lastmod' => optional(\App\Models\Teams::first()?->updated_at)->toAtomString()],
            ['loc' => route('app'), 'lastmod' => optional(App::first()?->updated_at)->toAtomString()],
            ['loc' => route('services'), 'lastmod' => optional(\App\Models\Services::first()?->updated_at)->toAtomString()],
            ['loc' => route('governance-services'), 'lastmod' => optional(\App\Models\GovernanceServices::first()?->updated_at)->toAtomString()],
            ['loc' => route('wealth-services'), 'lastmod' => optional(\App\Models\WealthServices::first()?->updated_at)->toAtomString()],
            ['loc' => route('investment-services'), 'lastmod' => optional(\App\Models\InvestmentServices::first()?->updated_at)->toAtomString()],
            ['loc' => route('cio-services'), 'lastmod' => optional(\App\Models\CioServices::first()?->updated_at)->toAtomString()],
            ['loc' => route('resource-center'), 'lastmod' => optional(\App\Models\ResourceCenter::first()?->updated_at)->toAtomString()],
            ['loc' => route('tools'), 'lastmod' => optional(\App\Models\Tools::first()?->updated_at)->toAtomString()],
            ['loc' => route('blog'), 'lastmod' => optional($this->getPageContent('blog-list')?->updated_at)->toAtomString()],
            ['loc' => route('case-studies'), 'lastmod' => optional($this->getPageContent('case-studies-list')?->updated_at)->toAtomString()],
            ['loc' => route('articles'), 'lastmod' => optional($this->getPageContent('articles-list')?->updated_at)->toAtomString()],
            ['loc' => route('books'), 'lastmod' => optional($this->getPageContent('books-list')?->updated_at)->toAtomString()],
            ['loc' => route('glossaries'), 'lastmod' => optional($this->getPageContent('glossaries-list')?->updated_at)->toAtomString()],
            ['loc' => route('contact-us'), 'lastmod' => optional(\App\Models\ContactUs::first()?->updated_at)->toAtomString()],
            ['loc' => route('request-meeting'), 'lastmod' => optional($this->getPageContent('request-meeting')?->updated_at)->toAtomString()],
            ['loc' => route('appointment'), 'lastmod' => optional(AppointmentPage::first()?->updated_at)->toAtomString()],
            ['loc' => route('careers'), 'lastmod' => optional(\App\Models\Careers::first()?->updated_at)->toAtomString()],
            ['loc' => route('faq'), 'lastmod' => optional($this->getPageContent('faq')?->updated_at)->toAtomString()],
            ['loc' => route('privacy-policy'), 'lastmod' => optional(\App\Models\PrivacyPolicy::where('is_active', true)->first()?->updated_at)->toAtomString()],
            ['loc' => route('terms-conditions'), 'lastmod' => optional(\App\Models\TermsConditions::where('is_active', true)->first()?->updated_at)->toAtomString()],
            ['loc' => route('cookie-policy'), 'lastmod' => optional(\App\Models\CookiePolicy::where('is_active', true)->first()?->updated_at)->toAtomString()],
        ];
    }

    protected function legacyRedirectFor(Request $request): ?string
    {
        $path = trim(Str::of($request->path())->trim('/')->lower()->replace('//', '/')->toString(), '/');

        if ($path === '') {
            return null;
        }

        $staticRedirects = [
            'about_us' => route('about-us'),
            'about-us.html' => route('about-us'),
            'contact_us' => route('contact-us'),
            'contact-us.html' => route('contact-us'),
            'resource-center' => route('resources-center'),
            'resource-center.html' => route('resources-center'),
            'request-a-meeting' => route('request-meeting'),
            'request-meeting.html' => route('request-meeting'),
            'appointment.html' => route('appointment'),
            'faqs' => route('faq'),
            'fqa' => route('faq'),
            'faq.html' => route('faq'),
            'privacy-policy.html' => route('privacy-policy'),
            'terms-conditions.html' => route('terms-conditions'),
            'cookie-policy.html' => route('cookie-policy'),
        ];

        if (array_key_exists($path, $staticRedirects)) {
            return $staticRedirects[$path];
        }

        if (preg_match('#^article/(\d+)$#', $path, $matches)) {
            return route('article.show', $matches[1]);
        }

        if (preg_match('#^book/(\d+)$#', $path, $matches)) {
            return route('book.show', $matches[1]);
        }

        if (preg_match('#^glossary/(\d+)$#', $path, $matches)) {
            return route('glossary.show', $matches[1]);
        }

        return null;
    }

    protected function getBlogCategories()
    {
        if (!Schema::hasTable('blogs')) {
            return collect();
        }

        $categoryTranslations = [
            'articles' => [
                'en' => 'Articles',
                'ar' => 'المقالات',
            ],
            'news' => [
                'en' => 'News',
                'ar' => 'الأخبار',
            ],
            'market-updates' => [
                'en' => 'Market Updates',
                'ar' => 'تحديثات السوق',
            ],
            'insights' => [
                'en' => 'Insights',
                'ar' => 'رؤى',
            ],
            'uncategorized' => [
                'en' => 'Uncategorized',
                'ar' => 'غير مصنف',
            ],
        ];

        return Blog::published()
            ->whereNotNull('category')
            ->get(['category', 'category_ar'])
            ->filter(fn (Blog $blog) => filled($blog->category))
            ->unique('category')
            ->map(function (Blog $blog) use ($categoryTranslations) {
                $category = $blog->category;
                $slug = Str::slug($category) ?: 'uncategorized';
                $translation = $categoryTranslations[$slug] ?? null;
                $labelEn = $translation['en'] ?? Str::headline($category);
                $labelAr = $blog->category_ar ?: ($translation['ar'] ?? $labelEn);

                return [
                    'value' => $category,
                    'slug' => $slug,
                    'label' => $labelEn,
                    'label_en' => $labelEn,
                    'label_ar' => $labelAr,
                ];
            })
            ->sortBy('label')
            ->values();
    }

    protected function getCaseStudyCategories()
    {
        if (!Schema::hasTable('case_studies')) {
            return collect();
        }

        return CaseStudy::published()
            ->whereNotNull('category')
            ->get(['category', 'category_ar'])
            ->unique('category')
            ->filter(fn (CaseStudy $caseStudy) => filled($caseStudy->category))
            ->map(function (CaseStudy $caseStudy) {
                $slug = Str::slug($caseStudy->category);
                return [
                    'value' => $caseStudy->category,
                    'slug' => $slug ?: 'uncategorized',
                    'label' => Str::headline($caseStudy->category),
                    'label_en' => Str::headline($caseStudy->category),
                    'label_ar' => $caseStudy->category_ar ?: Str::headline($caseStudy->category),
                ];
            })
            ->sortBy('label')
            ->values();
    }

    protected function getHomeInsightItems()
    {
        $items = collect();

        $items = $items
            ->merge(
                Blog::published()
                    ->ordered()
                    ->take(4)
                    ->get()
                    ->map(function (Blog $blog) {
                        return [
                            'label_en' => 'Blogs',
                            'label_ar' => 'المدونة',
                            'title_en' => $blog->title_en,
                            'title_ar' => $blog->title_ar,
                            'description_en' => $blog->description_en,
                            'description_ar' => $blog->description_ar,
                            'button_text_en' => $blog->button_text_en,
                            'button_text_ar' => $blog->button_text_ar,
                            'image_url' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('design/images/blog.png'),
                            'url' => route('blog.show', $blog->slug),
                            'created_at' => $blog->created_at,
                        ];
                    })
            )
            ->merge(
                CaseStudy::published()
                    ->ordered()
                    ->take(4)
                    ->get()
                    ->map(function (CaseStudy $caseStudy) {
                        return [
                            'label_en' => 'Case Studies',
                            'label_ar' => 'دراسات الحالة',
                            'title_en' => $caseStudy->title_en,
                            'title_ar' => $caseStudy->title_ar,
                            'description_en' => $caseStudy->description_en,
                            'description_ar' => $caseStudy->description_ar,
                            'button_text_en' => $caseStudy->button_text_en,
                            'button_text_ar' => $caseStudy->button_text_ar,
                            'image_url' => $caseStudy->featured_image ? asset('storage/' . $caseStudy->featured_image) : asset('design/images/blog.png'),
                            'url' => route('case-studies.show', $caseStudy->slug),
                            'created_at' => $caseStudy->created_at,
                        ];
                    })
            )
            ->merge(
                Article::query()
                    ->with('category')
                    ->latest('created_at')
                    ->take(4)
                    ->get()
                    ->map(function (Article $article) {
                        return [
                            'label_en' => 'Articles',
                            'label_ar' => 'المقالات',
                            'title_en' => $article->title_en,
                            'title_ar' => $article->title_ar,
                            'description_en' => $article->description_en,
                            'description_ar' => $article->description_ar,
                            'image_url' => $article->getFirstMediaUrl('main_image_article') ?: asset('design/images/blog.png'),
                            'url' => route('article.show', $article->id),
                            'created_at' => $article->created_at,
                        ];
                    })
            )
            ->merge(
                Book::query()
                    ->with('category')
                    ->latest('created_at')
                    ->take(4)
                    ->get()
                    ->map(function (Book $book) {
                        return [
                            'label_en' => 'Books',
                            'label_ar' => 'الكتب',
                            'title_en' => $book->title_en,
                            'title_ar' => $book->title_ar,
                            'description_en' => $book->description_en,
                            'description_ar' => $book->description_ar,
                            'image_url' => $book->getFirstMediaUrl('main_image_book') ?: asset('design/images/blog.png'),
                            'url' => route('book.show', $book->id),
                            'created_at' => $book->created_at,
                        ];
                    })
            )
            ->merge(
                Glossary::query()
                    ->with('category')
                    ->latest('created_at')
                    ->take(4)
                    ->get()
                    ->map(function (Glossary $glossary) {
                        return [
                            'label_en' => 'Glossaries',
                            'label_ar' => 'المصطلحات',
                            'title_en' => $glossary->title_en,
                            'title_ar' => $glossary->title_ar,
                            'description_en' => $glossary->description_en,
                            'description_ar' => $glossary->description_ar,
                            'image_url' => $glossary->getFirstMediaUrl('glossary_image') ?: asset('design/images/blog.png'),
                            'url' => route('glossary.show', $glossary->id),
                            'created_at' => $glossary->created_at,
                        ];
                    })
            );

        return $items
            ->sortByDesc('created_at')
            ->take(4)
            ->values()
            ->map(function (array $item) {
                $descriptionEn = $this->normalizeHomeInsightText($item['description_en'] ?? null);
                $descriptionAr = $this->normalizeHomeInsightText($item['description_ar'] ?? null);

                return [
                    'label_en' => $item['label_en'],
                    'label_ar' => $item['label_ar'],
                    'title_en' => $item['title_en'] ?? null,
                    'title_ar' => $item['title_ar'] ?? null,
                    'description_en' => $descriptionEn,
                    'description_ar' => $descriptionAr,
                    'button_text_en' => $item['button_text_en'] ?? null,
                    'button_text_ar' => $item['button_text_ar'] ?? null,
                    'image_url' => $item['image_url'],
                    'url' => $item['url'],
                ];
            })
            ->all();
    }

    protected function normalizeHomeInsightText(?string $text): string
    {
        if (blank($text)) {
            return '';
        }

        $decoded = html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return Str::of($decoded)
            ->replaceMatches('/\s+/u', ' ')
            ->trim()
            ->toString();
    }
}
