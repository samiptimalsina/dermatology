<?php

use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BeforeAfterController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\VideoController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
//  FRONTEND ROUTES
// ─────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/videos', [VideoController::class, 'index'])->name('videos');
Route::get('/videos/category/{category}', [VideoController::class, 'category'])->name('videos.category');
Route::get('/videos/{video:slug}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/privacy-policy', fn () => app(PageController::class)->show('privacy-policy'))->name('privacy-policy');
Route::get('/terms-and-conditions', fn () => app(PageController::class)->show('terms-and-conditions'))->name('terms-and-conditions');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// SEO helpers
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nSitemap: " . route('sitemap');
    return response($content, 200)->header('Content-Type', 'text/plain');
})->name('robots');

// ─────────────────────────────────────────────
//  ADMIN AUTH ROUTES (guest only)
// ─────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ─────────────────────────────────────────
    //  ADMIN PROTECTED ROUTES
    // ─────────────────────────────────────────

    Route::middleware('auth')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Services
        Route::get('/services', [AdminServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [AdminServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [AdminServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [AdminServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [AdminServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [AdminServiceController::class, 'destroy'])->name('services.destroy');
        Route::patch('/services/{service}/toggle', [AdminServiceController::class, 'toggleActive'])->name('services.toggle');

        // Blog Categories
        Route::get('/blog-categories', [\App\Http\Controllers\Admin\BlogCategoryController::class, 'index'])->name('blog-categories.index');
        Route::post('/blog-categories', [\App\Http\Controllers\Admin\BlogCategoryController::class, 'store'])->name('blog-categories.store');
        Route::put('/blog-categories/{category}', [\App\Http\Controllers\Admin\BlogCategoryController::class, 'update'])->name('blog-categories.update');
        Route::delete('/blog-categories/{category}', [\App\Http\Controllers\Admin\BlogCategoryController::class, 'destroy'])->name('blog-categories.destroy');

        // Blogs
        Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');
        Route::patch('/blogs/{blog}/toggle', [AdminBlogController::class, 'togglePublished'])->name('blogs.toggle');

        // Videos
        Route::get('/videos', [AdminVideoController::class, 'index'])->name('videos.index');
        Route::get('/videos/create', [AdminVideoController::class, 'create'])->name('videos.create');
        Route::post('/videos', [AdminVideoController::class, 'store'])->name('videos.store');
        Route::get('/videos/{video}/edit', [AdminVideoController::class, 'edit'])->name('videos.edit');
        Route::put('/videos/{video}', [AdminVideoController::class, 'update'])->name('videos.update');
        Route::delete('/videos/{video}', [AdminVideoController::class, 'destroy'])->name('videos.destroy');

        // Testimonials
        Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
        Route::patch('/testimonials/{testimonial}/toggle', [TestimonialController::class, 'toggleActive'])->name('testimonials.toggle');

        // Appointments
        Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
        Route::patch('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.status');
        Route::delete('/appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('appointments.destroy');

        // Team
        Route::get('/team', [TeamMemberController::class, 'index'])->name('team.index');
        Route::get('/team/create', [TeamMemberController::class, 'create'])->name('team.create');
        Route::post('/team', [TeamMemberController::class, 'store'])->name('team.store');
        Route::get('/team/{team}/edit', [TeamMemberController::class, 'edit'])->name('team.edit');
        Route::put('/team/{team}', [TeamMemberController::class, 'update'])->name('team.update');
        Route::delete('/team/{team}', [TeamMemberController::class, 'destroy'])->name('team.destroy');

        // Gallery
        Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
        Route::patch('/gallery/{gallery}/toggle', [AdminGalleryController::class, 'toggleActive'])->name('gallery.toggle');

        // Before / After
        Route::get('/before-afters', [BeforeAfterController::class, 'index'])->name('before-afters.index');
        Route::get('/before-afters/create', [BeforeAfterController::class, 'create'])->name('before-afters.create');
        Route::post('/before-afters', [BeforeAfterController::class, 'store'])->name('before-afters.store');
        Route::get('/before-afters/{beforeAfter}/edit', [BeforeAfterController::class, 'edit'])->name('before-afters.edit');
        Route::put('/before-afters/{beforeAfter}', [BeforeAfterController::class, 'update'])->name('before-afters.update');
        Route::delete('/before-afters/{beforeAfter}', [BeforeAfterController::class, 'destroy'])->name('before-afters.destroy');

        // SEO Meta
        Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
        Route::get('/seo/{seo}/edit', [SeoController::class, 'edit'])->name('seo.edit');
        Route::put('/seo/{seo}', [SeoController::class, 'update'])->name('seo.update');

        // Why Choose Us
        Route::get('/why-choose-us', [SeoController::class, 'whyChooseUs'])->name('why-choose-us.index');
        Route::post('/why-choose-us', [SeoController::class, 'storeWhyChooseUs'])->name('why-choose-us.store');
        Route::put('/why-choose-us/{item}', [SeoController::class, 'updateWhyChooseUs'])->name('why-choose-us.update');
        Route::delete('/why-choose-us/{item}', [SeoController::class, 'destroyWhyChooseUs'])->name('why-choose-us.destroy');

        // Site Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
