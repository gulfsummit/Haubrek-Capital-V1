<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FrontendController;
use Illuminate\Support\Facades\Session;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\SchemaOrg\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [FrontendController::class, 'robots'])->name('robots');

Route::get('/',[FrontendController::class,'home'])->name('home');
Route::get('/board-of-directors',[FrontendController::class,'board_of_directors'])->name('board_of_directors');
Route::get('/app',[FrontendController::class,'app'])->name('app');
Route::get('/services',[FrontendController::class,'service'])->name('services');
Route::get('/articles',[FrontendController::class,'articles'])->name('articles');
Route::get('/article/show/{id}',[FrontendController::class,'article'])->name('article.show');
Route::get('/blog',[FrontendController::class,'blog'])->name('blog');
Route::get('/blog/{blog}',[FrontendController::class,'blogShow'])->name('blog.show');
Route::get('/case-studies',[FrontendController::class,'caseStudies'])->name('case-studies');
Route::get('/case-studies/{caseStudy}',[FrontendController::class,'caseStudyShow'])->name('case-studies.show');
Route::get('/teams',[FrontendController::class,'teamsPage'])->name('teams');

Route::get('/teams-page',[FrontendController::class,'teamsPage'])->name('teams.page');

// Service-specific routes
Route::get('/governance-services',[FrontendController::class,'governanceServices'])->name('governance-services');
Route::get('/wealth-services',[FrontendController::class,'wealthServices'])->name('wealth-services');
Route::get('/wealth-planning-services',[FrontendController::class,'wealthPlanningServices'])->name('wealth-planning-services');
Route::get('/investment-services',[FrontendController::class,'investmentServices'])->name('investment-services');
Route::get('/cio-services',[FrontendController::class,'cioServices'])->name('cio-services');
Route::get('/request-meeting',[FrontendController::class,'requestMeeting'])->name('request-meeting');
Route::post('/request-meeting',[FrontendController::class,'storeMeetingRequest'])->name('meeting.submit');
Route::get('/appointment',[FrontendController::class,'appointment'])->name('appointment');
Route::get('/appointment/availability',[FrontendController::class,'appointmentAvailability'])->name('appointment.availability');
Route::get('/books',[FrontendController::class,'books'])->name('books');
Route::get('/book/show/{id}',[FrontendController::class,'book'])->name('book.show');
Route::get('/glossaries',[FrontendController::class,'glossaries'])->name('glossaries');
Route::get('/glossary/show/{id}',[FrontendController::class,'glossary'])->name('glossary.show');
Route::get('/tools',[FrontendController::class,'tools'])->name('tools');
Route::post('/risk-assessments',[FrontendController::class,'risk_assessments'])->name('risk.submit');
Route::get('/about-us',[FrontendController::class,'about_us'])->name('about-us');
Route::get('/contact-us',[FrontendController::class,'contactUs'])->name('contact-us');
Route::post('/contact-us/submit',[FrontendController::class,'storeContact'])->name('contact.submit');
Route::get('/careers',[FrontendController::class,'careers'])->name('careers');
Route::post('/careers/submit',[FrontendController::class,'storeCareerApplication'])->name('careers.submit');
Route::post('/appointment/submit',[FrontendController::class,'storeAppointment'])->name('appointment.submit');
Route::get('/faq',[FrontendController::class,'question'])->name('faq');
Route::get('/resources-center',[FrontendController::class,'resourcesCenter'])->name('resources-center');

// ── Resources Center sub-sections ──────────────────────────────────────────
Route::get('/resources-center/white-papers', [FrontendController::class, 'whitePapers'])->name('white-papers');
Route::get('/resources-center/white-papers/{whitePaper}', [FrontendController::class, 'whitePaperShow'])->name('white-papers.show');
Route::post('/resources-center/white-papers/{whitePaper}/download', [FrontendController::class, 'whitePaperDownload'])->name('white-papers.download');

Route::get('/resources-center/cio-flash', [FrontendController::class, 'cioFlash'])->name('cio-flash');
Route::get('/resources-center/cio-flash/{cioFlash}', [FrontendController::class, 'cioFlashShow'])->name('cio-flash.show');

Route::get('/resources-center/monday-window', [FrontendController::class, 'mondayWindow'])->name('monday-window');
Route::get('/resources-center/monday-window/{mondayWindow}', [FrontendController::class, 'mondayWindowShow'])->name('monday-window.show');

Route::get('/resources-center/research', [FrontendController::class, 'research'])->name('research');
Route::get('/resources-center/research/{research}', [FrontendController::class, 'researchShow'])->name('research.show');
Route::post('/resources-center/research/{research}/download', [FrontendController::class, 'researchDownload'])->name('research.download');
Route::get('/resources-center/research/{research}/thank-you', [FrontendController::class, 'researchThankYou'])->name('research.thank-you');

// Newsletter subscription
Route::post('/newsletter/subscribe', 'App\Http\Controllers\NewsletterController@subscribe')->name('newsletter.subscribe');

// Simple popup route for easy linking
Route::get('/popup', function() {
    return response()->json(['success' => true, 'message' => 'Popup should open']);
})->name('popup');

Route::get('setting', [FrontendController::class, 'setting'])->name('setting');

// Legal Pages
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-conditions', [FrontendController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/cookie-policy', [FrontendController::class, 'cookiePolicy'])->name('cookie-policy');

// ── Arabic Routes (/ar/ prefix) ────────────────────────────
Route::prefix('ar')
    ->middleware('locale.url:ar')
    ->name('ar.')
    ->group(function () {

        Route::get('/', [FrontendController::class, 'home'])->name('home');
        Route::get('/about-us', [FrontendController::class, 'about_us'])->name('about-us');
        Route::get('/services', [FrontendController::class, 'service'])->name('services');
        Route::get('/governance-services', [FrontendController::class, 'governanceServices'])->name('governance-services');
        Route::get('/wealth-services', [FrontendController::class, 'wealthServices'])->name('wealth-services');
        Route::get('/wealth-planning-services', [FrontendController::class, 'wealthPlanningServices'])->name('wealth-planning-services');
        Route::get('/investment-services', [FrontendController::class, 'investmentServices'])->name('investment-services');
        Route::get('/cio-services', [FrontendController::class, 'cioServices'])->name('cio-services');
        Route::get('/contact-us', [FrontendController::class, 'contactUs'])->name('contact-us');
        Route::get('/careers', [FrontendController::class, 'careers'])->name('careers');
        Route::get('/faq', [FrontendController::class, 'question'])->name('faq');
        Route::get('/appointment', [FrontendController::class, 'appointment'])->name('appointment');
        Route::get('/request-meeting', [FrontendController::class, 'requestMeeting'])->name('request-meeting');
        Route::get('/teams', [FrontendController::class, 'teamsPage'])->name('teams');
        Route::get('/resources-center', [FrontendController::class, 'resourcesCenter'])->name('resources-center');
        Route::get('/resources-center/white-papers', [FrontendController::class, 'whitePapers'])->name('white-papers');
        Route::get('/resources-center/white-papers/{whitePaper}', [FrontendController::class, 'whitePaperShow'])->name('white-papers.show');
        Route::get('/resources-center/cio-flash', [FrontendController::class, 'cioFlash'])->name('cio-flash');
        Route::get('/resources-center/cio-flash/{cioFlash}', [FrontendController::class, 'cioFlashShow'])->name('cio-flash.show');
        Route::get('/resources-center/monday-window', [FrontendController::class, 'mondayWindow'])->name('monday-window');
        Route::get('/resources-center/monday-window/{mondayWindow}', [FrontendController::class, 'mondayWindowShow'])->name('monday-window.show');
        Route::get('/resources-center/research', [FrontendController::class, 'research'])->name('research');
        Route::get('/resources-center/research/{research}', [FrontendController::class, 'researchShow'])->name('research.show');
        Route::get('/resources-center/research/{research}/thank-you', [FrontendController::class, 'researchThankYou'])->name('research.thank-you');
        Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
        Route::get('/blog/{blog}', [FrontendController::class, 'blogShow'])->name('blog.show');
        Route::get('/case-studies', [FrontendController::class, 'caseStudies'])->name('case-studies');
        Route::get('/case-studies/{caseStudy}', [FrontendController::class, 'caseStudyShow'])->name('case-studies.show');
        Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
        Route::get('/terms-conditions', [FrontendController::class, 'termsConditions'])->name('terms-conditions');
        Route::get('/cookie-policy', [FrontendController::class, 'cookiePolicy'])->name('cookie-policy');

    });

Route::fallback([FrontendController::class, 'fallback']);

