<?php

use App\Http\Controllers\backend\AboutUsController;
use App\Http\Controllers\backend\auth\LoginController as AdminLoginController;
use App\Http\Controllers\backend\ContactInfoController;
use App\Http\Controllers\backend\CustomEmailController;
use App\Http\Controllers\backend\CustomInvoiceController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\EmailInboxController;
use App\Http\Controllers\backend\FaqController;
use App\Http\Controllers\backend\MessageController as BackendMessageController;
use App\Http\Controllers\backend\OrderController as BackendOrderController;
use App\Http\Controllers\backend\PlanController;
use App\Http\Controllers\backend\PrivacyPolicyController;
use App\Http\Controllers\backend\RatingController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\SocialLinkController;
use App\Http\Controllers\backend\TeamController;
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\frontend\AboutUsController as FrontendAboutUsController;
use App\Http\Controllers\frontend\auth\LoginController as UserLoginController;
use App\Http\Controllers\frontend\auth\RegisterController;
use App\Http\Controllers\frontend\auth\ResetPasswordController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\FaqController as FrontendFaqController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\MessageController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\PlanController as FrontendPlanController;
use App\Http\Controllers\frontend\PricingController;
use App\Http\Controllers\frontend\PrivacyPolicyController as FrontendPrivacyPolicyController;
use App\Http\Controllers\frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\frontend\TestimonialController as FrontendTestimonialController;
use App\Http\Controllers\frontend\TrackOrderController;
use App\Http\Controllers\frontend\UserAccountController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// User Routes
// Routes that require user to be authenticated
Route::middleware(['auth'])->group(function () {

    // User Checkout
    Route::get('checkout/{id}', [CheckoutController::class, 'index'])->middleware('verified')->name('user.checkout');
    Route::post('checkout', [OrderController::class, 'store'])->middleware('verified')->name('user.order');

    // User Account
    Route::get('user-account', [UserAccountController::class, 'index'])->middleware('verified')->name('user.account');

    // Track Order
    Route::get('track-order', [TrackOrderController::class, 'index'])->middleware('verified')->name('user.track-order');
    Route::get('order-details/{id}', [TrackOrderController::class, 'orderDetails'])->middleware('verified')->name('user.order-details');

    // The Email Verification Notice
    Route::get('/email/verify', [RegisterController::class, 'verifyNotice'])->name('verification.notice');
    // The Email Verification Handler
    Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
    // Resending the Verification Email
    Route::post('/email/verification-notification', [RegisterController::class, 'verifyHandler'])->middleware(['throttle:6,1'])->name('verification.send');
});

Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::get('sign-up', [RegisterController::class, 'index'])->name('signup.user');
Route::post('login', [UserLoginController::class, 'login']);
Route::get('/', [HomeController::class, 'index'])->name('user.dashboard');
Route::post('logout', [UserLoginController::class, 'logout'])->name('logout.user');

Route::get('sign-up', [RegisterController::class, 'index'])->name('signup.user');
Route::post('sign-up', [RegisterController::class, 'register'])->name('register.user');

// user services
Route::get('services/{slug}', [FrontendServiceController::class, 'index'])->name('user.service-details');

// user plans
Route::get('plans/{slug}', [FrontendPlanController::class, 'index'])->name('user.plan-details');

// user faq
Route::get('faqs', [FrontendFaqController::class, 'index'])->name('user.faqs');

// user message
Route::get('contact', [MessageController::class, 'index'])->name('user.message');
Route::post('contact', [MessageController::class, 'message'])->name('user.send-message');


// user testimonials
Route::get('testimonials', [FrontendTestimonialController::class, 'index'])->name('user.testimonials');

// user footer about us
Route::get('about-us', [FrontendAboutUsController::class, 'index'])->name('user.about-us');

// user footer privacy policy
Route::get('privacy-policy', [FrontendPrivacyPolicyController::class, 'index'])->name('user.privacy-policy');

// user footer pricing
Route::get('pricing', [PricingController::class, 'index'])->name('user.pricing');


// user reset password
// The Password Reset Link Request Form
Route::view('/forgot-password', 'frontend/auth/forgot-password')->name('password.request');

// Handling the Form Submission
Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])->name('password.email');

// The Password Reset Form
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');

// Handling the Form Submission
Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');



// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login']);
    // Route::get('/dashboard', function () {
    //     return view('backend.home');
    // })->middleware('auth:admin')->name('admin.dashboard');
    
    // group by middlewar 
    Route::middleware('auth:admin')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout.admin');


        // admin services 
        Route::get('services', [ServiceController::class, 'index'])->name('admin.all-services');
        Route::get('add-services', [ServiceController::class, 'create'])->name('admin.add-service');
        Route::post('add-services', [ServiceController::class, 'store'])->name('admin.store-service');
        Route::get('edit-service/{id}', [ServiceController::class, 'edit'])->name('admin.edit-service');
        Route::post('update-service/{id}', [ServiceController::class, 'update'])->name('admin.update-service');
        Route::delete('delete-service/{id}', [ServiceController::class, 'destroy'])->name('admin.delete-service');
        Route::get('view-service/{id}', [ServiceController::class, 'view'])->name('admin.view-service');

        // admin plans
        Route::get('plans', [PlanController::class, 'index'])->name('admin.all-plans');
        Route::get('add-plans', [PlanController::class, 'create'])->name('admin.add-plan');
        Route::post('add-plans', [PlanController::class, 'store'])->name('admin.store-plan');
        Route::get('edit-plan/{id}', [PlanController::class, 'edit'])->name('admin.edit-plan');
        Route::post('update-plan/{id}', [PlanController::class, 'update'])->name('admin.update-plan');
        Route::delete('delete-plan/{id}', [PlanController::class, 'destroy'])->name('admin.delete-plan');
        // get plans by service
        Route::get('/get-plans-by-service/{service_id}', [PlanController::class, 'getPlansByService']);
        Route::get('view-plan/{id}', [PlanController::class, 'view'])->name('admin.view-plan');

        // admin plan ratings
        Route::get('ratings', [RatingController::class, 'index'])->name('admin.all-ratings');
        Route::get('add-ratings', [RatingController::class, 'create'])->name('admin.add-rating');
        Route::post('add-ratings', [RatingController::class, 'store'])->name('admin.store-rating');
        Route::get('edit-rating/{id}', [RatingController::class, 'edit'])->name('admin.edit-rating');
        Route::post('update-rating/{id}', [RatingController::class, 'update'])->name('admin.update-rating');
        Route::delete('delete-rating/{id}', [RatingController::class, 'destroy'])->name('admin.delete-rating');
        Route::get('view-rating/{id}', [RatingController::class, 'view'])->name('admin.view-rating');

        // admin contact info
        Route::get('contact-info', [ContactInfoController::class, 'index'])->name('admin.all-contact-infoes');
        Route::get('add-contact-info', [ContactInfoController::class, 'create'])->name('admin.add-contact-info');
        Route::post('add-contact-info', [ContactInfoController::class, 'store'])->name('admin.store-contact-info');
        Route::get('edit-contact-info/{id}', [ContactInfoController::class, 'edit'])->name('admin.edit-contact-info');
        Route::post('update-contact-info/{id}', [ContactInfoController::class, 'update'])->name('admin.update-contact-info');
        Route::delete('delete-contact-info/{id}', [ContactInfoController::class, 'destroy'])->name('admin.delete-contact-info');
        Route::get('view-contact-info/{id}', [ContactInfoController::class, 'view'])->name('admin.view-contact-info');

        // admin social links
        Route::get('social-links', [SocialLinkController::class, 'index'])->name('admin.all-social-links');
        Route::get('add-social-links', [SocialLinkController::class, 'create'])->name('admin.add-social-link');
        Route::post('add-social-links', [SocialLinkController::class, 'store'])->name('admin.store-social-link');
        Route::get('edit-social-link/{id}', [SocialLinkController::class, 'edit'])->name('admin.edit-social-link');
        Route::post('update-social-link/{id}', [SocialLinkController::class, 'update'])->name('admin.update-social-link');
        Route::delete('delete-social-link/{id}', [SocialLinkController::class, 'destroy'])->name('admin.delete-social-link');
        Route::get('view-social-link/{id}', [SocialLinkController::class, 'view'])->name('admin.view-social-link');

        // admin privacy policy
        Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('admin.privacy-policies');
        Route::get('add-privacy-policy', [PrivacyPolicyController::class, 'create'])->name('admin.add-privacy-policy');
        Route::post('add-privacy-policy', [PrivacyPolicyController::class, 'store'])->name('admin.store-privacy-policy');
        Route::get('edit-privacy-policy/{id}', [PrivacyPolicyController::class, 'edit'])->name('admin.edit-privacy-policy');
        Route::post('update-privacy-policy/{id}', [PrivacyPolicyController::class, 'update'])->name('admin.update-privacy-policy');
        Route::delete('delete-privacy-policy/{id}', [PrivacyPolicyController::class, 'destroy'])->name('admin.delete-privacy-policy');
        Route::get('view-privacy-policy/{id}', [PrivacyPolicyController::class, 'view'])->name('admin.view-privacy-policy');

        // admin about us
        Route::get('about-us', [AboutUsController::class, 'index'])->name('admin.about-us');
        Route::get('add-about-us', [AboutUsController::class, 'create'])->name('admin.add-about-us');
        Route::post('add-about-us', [AboutUsController::class, 'store'])->name('admin.store-about-us');
        Route::get('edit-about-us/{id}', [AboutUsController::class, 'edit'])->name('admin.edit-about-us');
        Route::post('update-about-us/{id}', [AboutUsController::class, 'update'])->name('admin.update-about-us');
        Route::delete('delete-about-us/{id}', [AboutUsController::class, 'destroy'])->name('admin.delete-about-us');
        Route::get('view-about-us/{id}', [AboutUsController::class, 'view'])->name('admin.view-about-us');

        // admin testimonial
        Route::get('testimonial', [TestimonialController::class, 'index'])->name('admin.testimonials');
        Route::get('add-testimonial', [TestimonialController::class, 'create'])->name('admin.add-testimonials');
        Route::post('add-testimonial', [TestimonialController::class, 'store'])->name('admin.store-testimonial');
        Route::get('edit-testimonial/{id}', [TestimonialController::class, 'edit'])->name('admin.edit-testimonial');
        Route::post('update-testimonial/{id}', [TestimonialController::class, 'update'])->name('admin.update-testimonial');
        Route::delete('delete-testimonial/{id}', [TestimonialController::class, 'destroy'])->name('admin.delete-testimonial');
        Route::get('view-testimonial/{id}', [TestimonialController::class, 'view'])->name('admin.view-testimonial');

        // admin team
        Route::get('team', [TeamController::class, 'index'])->name('admin.team');
        Route::get('add-team', [TeamController::class, 'create'])->name('admin.add-team');
        Route::post('add-team', [TeamController::class, 'store'])->name('admin.store-team');
        Route::get('edit-team/{id}', [TeamController::class, 'edit'])->name('admin.edit-team');
        Route::post('update-team/{id}', [TeamController::class, 'update'])->name('admin.update-team');
        Route::delete('delete-team/{id}', [TeamController::class, 'destroy'])->name('admin.delete-team');
        Route::get('view-team/{id}', [TeamController::class, 'view'])->name('admin.view-team');



        // admin messages
        Route::get('messages', [BackendMessageController::class, 'showMessages'])->name('admin.show-messages');
        Route::get('view-messages/{id}', [BackendMessageController::class, 'viewMessage'])->name('admin.view-message');
        Route::get('messages/{id}/reply', [BackendMessageController::class, 'showReplyForm'])->name('messages.replyForm');
        Route::post('messages/{id}/send-reply', [BackendMessageController::class, 'sendReply'])->name('messages.sendReply');
        Route::get('messages/{id}/view-reply', [BackendMessageController::class, 'viewReply'])->name('messages.viewReply');
        Route::delete('delete-message/{id}', [BackendMessageController::class, 'deleteMessage'])->name('message.delete');
        // for real time message counter and lists 
        Route::get('messages/unseen-count', [BackendMessageController::class, 'getUnseenCount'])->name('admin.messages.unseenCount');
        Route::get('messages/unseen-dropdown', [BackendMessageController::class, 'unseenDropdown'])->name('admin.messages.unseenDropdown');
        Route::post('messages/mark-seen/{id}', [BackendMessageController::class, 'markSeen'])->name('admin.messages.markSeen');
        




        // admin orders
        Route::get('orders', [BackendOrderController::class, 'index'])->name('admin.orders');
        Route::get('view-order/{id}', [BackendOrderController::class, 'viewOrder'])->name('admin.view-order');
        Route::post('update-order-status/{id}', [BackendOrderController::class, 'updateStatus'])->name('admin.update-order-status');
        Route::get('orders/{id}/download-invoice', [BackendOrderController::class, 'downloadInvoice'])->name('admin.download-invoice');
        Route::post('order/{id}/send-invoice', [BackendOrderController::class, 'sendInvoice'])->name('admin.send-invoice');
        // for real time order counter and lists 
        Route::post('orders/mark-seen/{id}', [BackendOrderController::class, 'markSeen'])->name('admin.orders.markSeen');
        Route::get('orders/unseen-count', [BackendOrderController::class, 'getUnseenCount'])->name('admin.orders.unseenCount');
        Route::get('orders/unseen-dropdown', [BackendOrderController::class, 'unseenDropdown'])->name('admin.orders.unseenDropdown');



        // admin faqs
        Route::get('faqs', [FaqController::class, 'index'])->name('admin.all-faq');
        Route::get('add-faqs', [FaqController::class, 'create'])->name('admin.add-faq');
        Route::post('add-faqs', [FaqController::class, 'store'])->name('admin.store-faq');
        Route::get('view-faq/{id}', [FaqController::class, 'view'])->name('admin.view-faq');
        Route::get('edit-faq/{id}', [FaqController::class, 'edit'])->name('admin.edit-faq');
        Route::post('update-faq/{id}', [FaqController::class, 'update'])->name('admin.update-faq');
        Route::delete('delete-faq/{id}', [FaqController::class, 'delete'])->name('admin.delete-faq');

        // admin custom invoice
        Route::get('custom-invoices', [CustomInvoiceController::class, 'index'])->name('admin.custom-invoices');
        Route::get('create-custom-invoice', [CustomInvoiceController::class, 'create'])->name('admin.create-custom-invoice');
        Route::post('store-custom-invoice', [CustomInvoiceController::class, 'store'])->name('admin.store-custom-invoice');
        Route::get('edit-custom-invoice/{id}', [CustomInvoiceController::class, 'edit'])->name('admin.edit-custom-invoice');
        Route::post('update-custom-invoice/{id}', [CustomInvoiceController::class, 'update'])->name('admin.update-custom-invoice');
        Route::delete('delete-custom-invoice/{id}', [CustomInvoiceController::class, 'destroy'])->name('admin.delete-custom-invoice');
        Route::get('view-custom -invoice/{id}', [CustomInvoiceController::class, 'view'])->name('admin.view-custom-invoice');
        // Route::get('download-custom-invoice/{invoice}', [CustomInvoiceController::class, 'download'])->name('admin.download-custom-invoice');
        // Route::get('custom-invoices/{id}/send-invoice', [CustomInvoiceController::class, 'sendInvoice'])->name('admin.send-custom-invoice');
        // Route::get('custom-invoices/{id}/download-pdf', [CustomInvoiceController::class, 'downloadPdf'])->name('admin.download-custom-invoice-pdf');
        Route::get('custom-invoice/download/{id}', [CustomInvoiceController::class, 'downloadInvoice'])->name('custom-invoice.download');


        // admin custom email 
        Route::get('/custom-email', [CustomEmailController::class, 'create'])->name('admin.custom-email.create');
        Route::post('/custom-email', [CustomEmailController::class, 'send'])->name('admin.custom-email.send');
        Route::get('custom-emails', [CustomEmailController::class, 'index'])->name('admin.view-custom-email');
        Route::get('custom-email/{id}/view', [CustomEmailController::class, 'view'])->name('admin.view-custom-email-details');
        Route::delete('custom-email/{id}/delete', [CustomEmailController::class, 'destroy'])->name('admin.delete-custom-email');

        
        Route::prefix('inbox')->group(function () {
            Route::get('/', [EmailInboxController::class, 'index'])->name('inbox.index');
            Route::get('/{id}', [EmailInboxController::class, 'show'])->name('inbox.show');
        });

        Route::get('/inbox/{id}/attachment/{index}', [EmailInboxController::class, 'downloadAttachment'])->name('inbox.download');

        Route::get('/inbox/{id}/reply', [EmailInboxController::class, 'replyForm'])->name('inbox.reply.form');
        Route::post('/inbox/{id}/reply', [EmailInboxController::class, 'sendReply'])->name('inbox.reply.send');

    });
    

});