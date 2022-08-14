<?php



use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ListingController;
use App\Http\Controllers\User\ListingScheduleController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ConditionPrivacyController;
use App\Http\Controllers\Admin\PaymentAccountController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Controllers\Admin\ValidationTextController;
use App\Http\Controllers\Admin\ListingCategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\ContactInformationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\OverviewController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\AminityController;
use App\Http\Controllers\Admin\ListingPackageController;
use App\Http\Controllers\Admin\PackageSectionController;
use App\Http\Controllers\Admin\AdminListingController;
use App\Http\Controllers\Admin\ListingImageController;
use App\Http\Controllers\Admin\ListingVideoController;
use App\Http\Controllers\Admin\AdminListingScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ListingReviewController;
use App\Http\Controllers\Admin\SeoTextController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BannerImageController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CustomPageController;
use App\Http\Controllers\Admin\PaginatorController;
use App\Http\Controllers\Admin\EmailConfigurationController;
use App\Http\Controllers\Admin\ListingClaimeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ErrorPageController;



use App\Http\Controllers\Staff\Auth\StaffLoginController;
use App\Http\Controllers\Staff\Auth\StaffForgotPasswordController;
use App\Http\Controllers\Staff\StaffProfileController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffListingController;
use App\Http\Controllers\Staff\StaffListingImageController;
use App\Http\Controllers\Staff\StaffListingVideoController;
use App\Http\Controllers\Staff\StaffListingScheduleController;




use Illuminate\Support\Facades\Route;





Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/listings',[HomeController::class,'listings'])->name('listings');
Route::get('/listing/{slug}',[HomeController::class,'listingShow'])->name('listing.show');
Route::get('search-listing',[HomeController::class,'searchListingPage'])->name('search-listing');
Route::post('send-claim',[HomeController::class,'sendClaime'])->name('send-claim');
Route::get('/about-us',[HomeController::class,'aboutUs'])->name('about.us');
Route::get('/blog',[HomeController::class,'blog'])->name('blog');
Route::get('/blog-details/{slug}',[HomeController::class,'blogDetails'])->name('blog.details');
Route::get('/blog-category/{slug}',[HomeController::class,'blogCategory'])->name('blog.category');
Route::get('/blog-search',[HomeController::class,'blogSearch'])->name('blog.search');
Route::post('/blog-comment/{id}',[HomeController::class,'blogComment'])->name('blog.comment');
Route::get('/contact-us',[HomeController::class,'contactUs'])->name('contact.us');
Route::post('/contact-message',[ContactController::class,'sendMessage'])->name('contact.message');
Route::post('/user-contact-message',[ContactController::class,'messageForUser'])->name('user.contact.message');
Route::get('/pricing-plan',[HomeController::class,'pricingPlan'])->name('pricing.plan');
Route::get('/download-listing-file/{file}',[HomeController::class,'downloadListingFile'])->name('download-listing-file');
Route::get('/subscribe-us',[HomeController::class,'subscribeUs'])->name('subscribe-us');
Route::get('subscription-verify/{token}',[HomeController::class,'subscriptionVerify'])->name('subscription.verify');
Route::get('listing-categories',[HomeController::class,'listingCategory'])->name('listing.category');
Route::get('terms-and-condition',[HomeController::class,'termsCondition'])->name('terms.condition');
Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('privacy-policy');
Route::get('page/{slug}',[HomeController::class,'customPage'])->name('custom.page');
Route::get('user-profile',[HomeController::class,'userProfile'])->name('user-profile');









//user profile section
Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){

    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('my-listing',[ListingController::class,'index'])->name('my.listing');
    Route::get('create-listing',[ListingController::class,'create'])->name('create.listing');

    Route::post('store-listing',[ListingController::class,'store'])->name('listing.store');

    Route::get('edit-listing/{id}',[ListingController::class,'edit'])->name('listing.edit');
    Route::post('update-listing/{id}',[ListingController::class,'update'])->name('listing.update');
    Route::get('delete-listing/{id}',[ListingController::class,'destroy'])->name('listing.delete');
    Route::get('delete-listing-image/{id}',[ListingController::class,'deleteImage'])->name('delete-listing-image');
    Route::get('listing-video-delete/{id}',[ListingController::class,'deleteVideo'])->name('listing-video-delete');
    Route::get('delete-file/{id}',[ListingController::class,'deleteFile'])->name('delete-file');

    Route::get('listing-schedule/{id}',[ListingScheduleController::class,'index'])->name('listing.schedule.index');
    Route::get('schedule-create/{id}',[ListingScheduleController::class,'create'])->name('schedule.create');
    Route::post('schedule-store/{id}',[ListingScheduleController::class,'store'])->name('listing.schedule.store');
    Route::get('schedule-edit/{id}',[ListingScheduleController::class,'edit'])->name('listing.schedule.edit');
    Route::post('schedule-update/{id}',[ListingScheduleController::class,'update'])->name('listing.schedule.update');
    Route::get('schedule-delete/{id}',[ListingScheduleController::class,'delete'])->name('listing.schedule.delete');
    Route::get('listing-schedule-status/{id}',[ListingScheduleController::class,'changeStatus'])->name('listing.schedule.status');



    Route::get('review',[UserHomeController::class,'review'])->name('review');
    Route::post('store-review',[UserHomeController::class,'storeReview'])->name('store-review');
    Route::get('edit-review/{id}',[UserHomeController::class,'editReview'])->name('edit-review');
    Route::post('update-review/{id}',[UserHomeController::class,'updateReview'])->name('update-review');
    Route::get('delete-review/{id}',[UserHomeController::class,'deleteReview'])->name('delete-review');
    Route::get('review-status/{id}',[UserHomeController::class,'changeStatus'])->name('review.status');
    Route::get('my-profile',[UserHomeController::class,'profile'])->name('my-profile');
    Route::get('remove-social-link/{id}',[UserHomeController::class,'removeSocialLink'])->name('remove-social-link');
    Route::get('get-social-icon',[UserHomeController::class,'getSocialQty'])->name('get-social-icon');

    Route::post('update-profile',[UserHomeController::class,'updateProfile'])->name('update.profile');
    Route::post('update-password',[UserHomeController::class,'updatePassword'])->name('update.password');
    Route::post('update-profile-banner',[UserHomeController::class,'updateProfileBanner'])->name('update.profile.banner');

    Route::get('my-wishlist',[WishlistController::class,'wishlist'])->name('my-wishlist');
    Route::get('add-to-wishlist/{id}',[WishlistController::class,'create'])->name('add.to.wishlist');
    Route::get('delete-wishlist/{id}',[WishlistController::class,'delete'])->name('delete.wishlist');

    Route::get('purchase-package/{id}',[PaymentController::class,'purchase'])->name('purchase.package');

    Route::post('paypal/{id}',[PaypalController::class,'store'])->name('paypal');
    Route::get('paypal-payment-success',[PaypalController::class,'paymentSuccess']);
    Route::get('paypal-payment-cancled',[PaypalController::class,'paymentCancled']);
    Route::post('stripe-payment/{id}',[PaymentController::class,'stripePayment'])->name('stripe.payment');
    Route::get('my-order',[OrderController::class,'index'])->name('my-order');
    Route::get('order-details/{id}',[OrderController::class,'show'])->name('order.details');
    Route::get('package',[UserHomeController::class,'ListingPackage'])->name('package');
    Route::post('razorpay-payment/{id}',[PaymentController::class,'razorPay'])->name('razorpay-payment');
    Route::post('bank-payment',[PaymentController::class,'bankPayment'])->name('bank-payment');
    Route::post('flutterwave-payment',[PaymentController::class,'flutterWavePayment'])->name('flutterwave-payment');

    Route::post('paystack-payment',[PaymentController::class,'paystackPayment'])->name('paystack-payment');
    Route::get('mollie-payment/{id}',[PaymentController::class,'molliePayment'])->name('mollie-payment');
    Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
    Route::get('/pay-with-instamojo/{id}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
    Route::get('/instamojo-response', [PaymentController::class, 'instamojoResponse'])->name('instamojo-response');


    Route::post('/pay-with-paymongo/{id}', [PaymentController::class, 'payWithPaymongo'])->name('pay-with-paymongo');
    Route::get('/pay-with-grab-pay/{id}', [PaymentController::class, 'payWithPaymongoGrabPay'])->name('pay-with-grab-pay');
    Route::get('/pay-with-gcash/{id}', [PaymentController::class, 'payWithPaymongoGcash'])->name('pay-with-gcash');
    Route::get('/paymongo-payment-success', [PaymentController::class, 'paymongoPaymentSuccess'])->name('paymongo-payment-success');
    Route::get('/paymongo-payment-cancled', [PaymentController::class, 'paymongoPaymentCancled'])->name('paymongo-payment-cancled');

});



// user custom auth route
Route::get('register',[RegisterController::class,'userRegisterPage'])->name('register');
Route::post('register',[RegisterController::class,'storeRegister'])->name('register');
Route::get('user-verify/{token}',[RegisterController::class,'userVerify'])->name('user.verify');
Route::get('login',[LoginController::class,'userLoginPage'])->name('login');
Route::post('login',[LoginController::class,'storeLogin'])->name('login');
Route::get('logout',[LoginController::class,'userLogout'])->name('logout');
Route::post('send-forget-password',[ForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
Route::get('reset-password/{token}',[ForgotPasswordController::class,'resetPassword'])->name('reset.password');
Route::post('store-reset-password/{token}',[ForgotPasswordController::class,'storeResetData'])->name('store.reset.password');




// admin routes

Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
    // login route
    Route::get('/',[AdminLoginController::class,'adminLoginForm'])->name('login');
    Route::get('login',[AdminLoginController::class,'adminLoginForm'])->name('login');
    Route::post('login',[AdminLoginController::class,'storeLoginInfo'])->name('login');
    Route::get('/logout',[AdminLoginController::class,'adminLogout'])->name('logout');
    Route::get('forget-password',[AdminForgotPasswordController::class,'forgetPassword'])->name('forget.password');
    Route::post('send-forget-password',[AdminForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}',[AdminForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('store-reset-password/{token}',[AdminForgotPasswordController::class,'storeResetData'])->name('store.reset.password');

    // manage admin profile
    Route::get('profile',[ProfileController::class,'profile'])->name('profile');
    Route::post('update-profile',[ProfileController::class,'updateProfile'])->name('update.profile');

    //  admin
    Route::resource('admin-list',AdminController::class);
    Route::get('admin-status/{id}', [AdminController::class,'changeStatus'])->name('admin.status');




    // Terms-condition and privacy-policy
    Route::resource('terms-privacy', ConditionPrivacyController::class);

    // manage day
    Route::resource('day',DayController::class);

    // payment Account information
    Route::resource('payment-account',PaymentAccountController::class);
    Route::post('razorpay-update/{id}',[PaymentAccountController::class,'razorpayUpdate'])->name('razorpay-update');
    Route::post('stripe-update/{id}',[PaymentAccountController::class,'stripeUpdate'])->name('stripe-update');
    Route::post('bank-update/{id}',[PaymentAccountController::class,'bankUpdate'])->name('bank-update');
    Route::post('flutterwave-update/{id}',[PaymentAccountController::class,'flutterwaveUpdate'])->name('flutterwave-update');
    Route::post('paystack-update/{id}',[PaymentAccountController::class,'paystackUpdate'])->name('paystack-update');
    Route::post('mollie-update/{id}',[PaymentAccountController::class,'updateMollie'])->name('mollie-update');
    Route::post('instamojo-update/{id}',[PaymentAccountController::class,'updateInstamojo'])->name('instamojo-update');
    Route::post('paymongo-update/{id}',[PaymentAccountController::class,'updatePaymongo'])->name('paymongo-update');


    // setting start
    Route::resource('settings',SettingsController::class);
    Route::get('comment-setting',[SettingsController::class,'blogCommentSetting'])->name('comment.setting');
    Route::post('update-comment-setting',[SettingsController::class,'updateCommentSetting'])->name('update.comment.setting');
    Route::get('cookie-consent-setting',[SettingsController::class,'cookieConsentSetting'])->name('cookie.consent.setting');
    Route::post('update-cookie-consent',[SettingsController::class,'updateCookieConsentSetting'])->name('update.cookie.consent.setting');
    Route::get('captcha-setting',[SettingsController::class,'captchaSetting'])->name('captcha.setting');
    Route::post('update-captcha-setting',[SettingsController::class,'updateCaptchaSetting'])->name('update.captcha.setting');

    Route::get('livechat-setting',[SettingsController::class,'livechatSetting'])->name('livechat.setting');
    Route::post('update-livechat-setting',[SettingsController::class,'updateLivechatSetting'])->name('update.livechat.setting');

    Route::get('preloader-setting',[SettingsController::class,'preloaderSetting'])->name('preloader.setting');
    Route::post('preloader-update/{id}',[SettingsController::class,'preloaderUpdate'])->name('preloader.update');

    Route::get('google-analytic-setting',[SettingsController::class,'googleAnalytic'])->name('google.analytic.setting');
    Route::post('google-analytic-update',[SettingsController::class,'googleAnalyticUpdate'])->name('google.analytic.update');



    Route::get('email-template',[SettingsController::class,'emailTemplate'])->name('email.template');
    Route::get('email-template-edit/{id}',[SettingsController::class,'editEmail'])->name('email-edit');
    Route::post('email-template-update/{id}',[SettingsController::class,'updateEmail'])->name('email.update');

    // clear database
    Route::get('clear-database',[SettingsController::class,'clearDatabase'])->name('clear.database');
    Route::get('clear-all',[SettingsController::class,'destroyDatabase'])->name('clear.all.data');
     // setting end


    // subscriber
    Route::get('subscriber',[SubscriberController::class,'index'])->name('subscriber');
    Route::get('subscriber-delete/{id}',[SubscriberController::class,'delete'])->name('subscriber.delete');
    Route::get('subscriber-email',[SubscriberController::class,'emailTemplate'])->name('subscriber.email');
    Route::post('send-subscriber-email',[SubscriberController::class,'sendMail'])->name('send.subscriber.mail');



    Route::get('theme-color',[SettingsController::class,'themeColor'])->name('theme-color');
    Route::post('theme-color.update',[SettingsController::class,'themeColorUpdate'])->name('theme-color.update');



    // check notification
    Route::get('view-order-notify',[AdminOrderController::class,'viewOrderNotify'])->name('view.order.notify');
    Route::get('view-message-notify',[AdminOrderController::class,'viewMessageNotify'])->name('view.message.notify');



    Route::get('setup-text',[TextController::class,'index'])->name('setup.text');
    Route::post('update-text',[TextController::class,'update'])->name('update.text');




    Route::get('validation-errors',[ValidationTextController::class,'index'])->name('validation.errors');
    Route::post('update-validation-text',[ValidationTextController::class,'update'])->name('update.validation.text');

    Route::get('notification-text',[ValidationTextController::class,'notification'])->name('notification.text');
    Route::post('update-notification-text',[ValidationTextController::class,'updateNotification'])->name('update.notification.text');



     //admin Dashboard
     Route::get('dashboard',[AdminDashboardController::class,'index'])->name('dashboard');

    // listing route
    Route::resource('listing-category',ListingCategoryController::class);
    Route::get('listing-category-status/{id}', [ListingCategoryController::class,'changeStatus'])->name('listing.category.status');

     // manage blog category
    Route::resource('blog-category',BlogCategoryController::class);
    Route::get('blog-category-status/{id}',[BlogCategoryController::class,'changeStatus'])->name('blog.category.status');

    // blog
    Route::resource('blog', BlogController::class);
    Route::get('blog-status/{id}',[BlogController::class,'changeStatus'])->name('blog.status');

    // Blog comment
    Route::get('blog-comment',[BlogCommentController::class,'allComments'])->name('blog-comment');
    Route::get('delete-blog-comment/{id}',[BlogCommentController::class,'deleteComment'])->name('delete.blog.comment');
    Route::get('blog-comment-status/{id}',[BlogCommentController::class,'changeStatus'])->name('blog.comment.status');

    // about
    Route::resource('about', AboutController::class);
    Route::resource('about-section', AboutSectionController::class);

    Route::post('section-about.update/{id}', [AboutSectionController::class,'sectionAboutUpdate'])->name('section-about.update');
    Route::post('section-feature.update/{id}', [AboutSectionController::class,'sectionFeatureUpdate'])->name('section-feature.update');
    Route::post('section-overview.update/{id}', [AboutSectionController::class,'sectionOverviewUpdate'])->name('section-overview.update');
    Route::post('section-partner.update/{id}', [AboutSectionController::class,'sectionPartnerUpdate'])->name('section-partner.update');


    // contact info
    Route::resource('contact-information',ContactInformationController::class);
    Route::post('topbar-contact/{id}',[ContactInformationController::class,'topbarContact'])->name('topbar.contact');
    Route::post('footer-contact/{id}',[ContactInformationController::class,'footerContact'])->name('footer.contact');
    Route::post('social-link/{id}',[ContactInformationController::class,'socialLink'])->name('social.link');
    Route::get('contact-message',[ContactUsController::class,'message'])->name('contact.message');

    // home section
    Route::resource('home-section', HomeSectionController::class);
    Route::post('banner-in-homepage/{id}',[ HomeSectionController::class,'updateBannerSection'])->name('banner-in-homepage');
    Route::post('feature-in-homepage/{id}', [HomeSectionController::class,'updateFeatureSection'])->name('feature-in-homepage');
    Route::post('overview-in-homepage/{id}', [HomeSectionController::class,'updateOverviewSection'])->name('overview-in-homepage');
    Route::post('banner-category-in-homepage/{id}', [HomeSectionController::class,'updateBannerCategorySection'])->name('banner-category-in-homepage');


    Route::get('home-section-status/{id}',[HomeSectionController::class,'changeStatus'])->name('home.section.status');
    Route::resource('banner', SliderController::class);
    Route::resource('feature', FeatureController::class);
    Route::get('feature-status/{id}',[FeatureController::class,'changeStatus'])->name('feature.status');

    // overview
    Route::resource('overview',OverviewController::class);
    Route::get('overview-status/{id}', [OverviewController::class,'changeStatus'])->name('overview.status');
    Route::get('overview-video', [OverviewController::class,'overviewVideo'])->name('overview.video');
    Route::post('overview-video-store', [OverviewController::class,'overviewVideoStore'])->name('overview.video.store');

    Route::post('overview-video-update/{id}', [OverviewController::class,'overviewVideoUpdate'])->name('overview.video.update');
    // manage testimonial and status
    Route::resource('testimonial', TestimonialController::class);
    Route::get('testimonial-status/{id}',[TestimonialController::class,'changeStatus'])->name('testimonial.status');

    // manage partner
    Route::resource('partner', PartnerController::class);
    Route::get('partner-status/{id}', [PartnerController::class,'changeStatus'])->name('partner.status');



    // manage location and status
    Route::resource('location', LocationController::class);
    Route::get('location-status/{id}',[LocationController::class,'changeStatus'])->name('location.status');
    // manage aminity and status
    Route::resource('aminity', AminityController::class);
    Route::get('aminity-status/{id}',[AminityController::class,'changeStatus'])->name('aminity.status');

    Route::resource('listing-package', ListingPackageController::class);
    Route::get('listing-package-status/{id}',[ListingPackageController::class,'changeStatus'])->name('listing.package.status');


    // package section
    Route::resource('package-section', PackageSectionController::class);

    Route::post('package-section-package-page/{id}', [PackageSectionController::class,'updatePackageSection'])->name('package-section-package-page');
    Route::post('subscirbe-section-package-page/{id}',[PackageSectionController::class,'updateSubscribeSection'])->name('subscirbe-section-package-page');


    Route::resource('listing',AdminListingController::class);
    Route::delete('delete-user-listing/{id}',[AdminListingController::class, 'deleteUserListing'])->name('delete-user-listing');
    Route::get('user-listing',[AdminListingController::class,'index'])->name('user.listing');
    Route::get('delete-file/{id}',[AdminListingController::class,'deleteFile'])->name('delete-file');

    Route::get('my-listing',[AdminListingController::class,'myListing'])->name('my.listing');
    Route::get('pending-listing',[AdminListingController::class,'pendingListing'])->name('pending.listing');
    Route::get('listing-status/{id}',[AdminListingController::class,'changeStatus'])->name('listing.status');
    Route::get('listing-image/{id}',[ListingImageController::class,'index'])->name('listing.image');
    Route::post('listing-new-image/',[ListingImageController::class,'newImage'])->name('listing.new.image');
    Route::get('delete-listing-image/{id}',[ListingImageController::class,'deleteImage'])->name('delete.listing.image');
    Route::post('listing-new-logo/',[ListingImageController::class,'newLogo'])->name('listing.new.logo');
    Route::post('listing-new-thumbnail/',[ListingImageController::class,'newThumbnail'])->name('listing.new.thumbnail');
    Route::post('listing-new-banner/',[ListingImageController::class,'newBanner'])->name('listing.new.banner');

    Route::get('listing-video/{id}',[ListingVideoController::class,'index'])->name('listing.video');
    Route::post('listing-new-video',[ListingVideoController::class,'newVideo'])->name('listing.new.video');
    Route::get('delete-listing-video/{id}',[ListingVideoController::class,'deleteVideo'])->name('delete.listing.video');

    Route::get('listing-schedule/{id}',[AdminListingScheduleController::class,'index'])->name('listing.schedule');
    Route::get('listing-new-schedule/{id}',[AdminListingScheduleController::class,'create'])->name('listing.new.schedule');
    Route::post('listing-schedule-store/{id}',[AdminListingScheduleController::class,'store'])->name('listing.schedule.store');
    Route::get('listing-schedule-edit/{id}',[AdminListingScheduleController::class,'edit'])->name('listing.schedule.edit');
    Route::post('listing-schedule-update/{id}',[AdminListingScheduleController::class,'update'])->name('listing.schedule.update');
    Route::get('listing-schedule-delete/{id}',[AdminListingScheduleController::class,'destroy'])->name('listing.schedule.delete');
    Route::get('listing-schedule-status/{id}',[AdminListingScheduleController::class,'changeStatus'])->name('listing.schedule.status');

    Route::get('listing-review',[ListingReviewController::class,'index'])->name('listing-review');
    Route::get('review-delete/{id}',[ListingReviewController::class,'destroy'])->name('review.delete');
    Route::get('review-status/{id}',[ListingReviewController::class,'changeStatus'])->name('review-status');


    Route::get('user',[UserController::class,'index'])->name('user');
    Route::get('user-show/{id}',[UserController::class,'show'])->name('user.show');
    Route::get('user-status/{id}',[UserController::class,'changeStatus'])->name('user.status');
    Route::get('user-delete/{id}',[UserController::class,'destroy'])->name('user.delete');

    Route::get('order',[AdminOrderController::class,'index'])->name('order');
    Route::get('order-show/{id}',[AdminOrderController::class,'show'])->name('order-show');
    Route::get('order-delete/{id}',[AdminOrderController::class,'destroy'])->name('order-delete');
    Route::get('pending-order',[AdminOrderController::class,'pendingOrder'])->name('pending-order');
    Route::get('pending-payment/{id}',[AdminOrderController::class,'pendingPayment'])->name('pending-payment');
    Route::get('payment-accept/{id}',[AdminOrderController::class,'paymentAccept'])->name('payment-accept');

    // manage seo
    Route::get('home-page-seo/{id}',[SeoTextController::class,'index'])->name('home-seo-setup');
    Route::get('listing-seo-setup/{id}',[SeoTextController::class,'index'])->name('listing-seo-setup');
    Route::get('about-us-seo-setup/{id}',[SeoTextController::class,'index'])->name('about-us-seo-setup');
    Route::get('pricing-seo-setup/{id}',[SeoTextController::class,'index'])->name('pricing-seo-setup');
    Route::get('listing-category-seo-setup/{id}',[SeoTextController::class,'index'])->name('listing-category-seo-setup');
    Route::get('blog-seo-setup/{id}',[SeoTextController::class,'index'])->name('blog-seo-setup');
    Route::get('contact-us-seo-setup/{id}',[SeoTextController::class,'index'])->name('contact-us-seo-setup');
    Route::post('update-seo/{id}',[SeoTextController::class,'update'])->name('update-seo');



    // manage mene section
    Route::get('menu-section',[MenuController::class,'index'])->name('menu-section');
    Route::post('menu-update',[MenuController::class,'update'])->name('menu-update');
    Route::get('menu-status/{id}',[MenuController::class,'changeStatus'])->name('menu-status');


     // manage banner image
    Route::get('banner-image',[BannerImageController::class,'bannerImage'])->name('banner.image');
    Route::post('update-image/{id}',[BannerImageController::class,'BannerUpdate'])->name('update-image');
    Route::get('login-image',[BannerImageController::class,'LoginImage'])->name('login.image');
    Route::post('update-login-image/{id}',[BannerImageController::class,'updateLogin'])->name('update-login-image');
    Route::get('profile-image',[BannerImageController::class,'profileImageIndex'])->name('profile.image');
    Route::post('update-profile-image/{id}',[BannerImageController::class,'updateProfileImage'])->name('update-profile-image');
    Route::get('bg-image',[BannerImageController::class,'bgIndex'])->name('bg.image');
    Route::post('update-bg-image/{id}',[BannerImageController::class,'updateBg'])->name('update-bg-image');

    Route::get('staff',[StaffController::class,'index'])->name('staff');
    Route::get('create-staff/',[StaffController::class,'create'])->name('create-staff');
    Route::post('store-staff/',[StaffController::class,'store'])->name('store-staff');
    Route::get('delete-staff/{id}',[StaffController::class,'destroy'])->name('delete-staff');
    Route::get('staff-status/{id}',[StaffController::class,'changeStatus'])->name('staff.status');


    // custome page
    Route::resource('custom-page',CustomPageController::class);
    Route::get('custom-page-status/{id}', [CustomPageController::class,'changeStatus'])->name('custom.page.status');

    // Error page
    Route::resource('error-page', ErrorPageController::class);


    Route::get('paginator',[PaginatorController::class,'index'])->name('paginator');
    Route::post('paginator-update',[PaginatorController::class,'update'])->name('paginator.update');

    Route::get('email-configuration',[EmailConfigurationController::class,'index'])->name('email-configuration');
    Route::post('update-email-configuraion',[EmailConfigurationController::class,'update'])->name('update-email-configuraion');


    Route::get('listing-claim',[ListingClaimeController::class,'index'])->name('listing-claim');
    Route::get('verfiy-listing/{id}',[ListingClaimeController::class,'verifyListing'])->name('verfiy-listing');
    Route::get('delete-claim/{id}',[ListingClaimeController::class,'deleteClaim'])->name('delete-claim');

});




//user profile section
Route::group(['as'=> 'staff.', 'prefix' => 'staff'],function (){
    // login route
    Route::get('/',[StaffLoginController::class,'staffLoginForm'])->name('login');
    Route::get('login',[StaffLoginController::class,'staffLoginForm'])->name('login');
    Route::post('login',[StaffLoginController::class,'storeLoginInfo'])->name('login');
    Route::post('register',[StaffLoginController::class,'register'])->name('register');
    Route::get('/logout',[StaffLoginController::class,'staffLogout'])->name('logout');
    Route::get('forget-password',[StaffForgotPasswordController::class,'forgetPassword'])->name('forget.password');
    Route::post('send-forget-password',[StaffForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}',[StaffForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('store-reset-password/{token}',[StaffForgotPasswordController::class,'storeResetData'])->name('store.reset.password');

    // manage admin profile
    Route::get('profile',[StaffProfileController::class,'profile'])->name('profile');
    Route::post('update-profile',[StaffProfileController::class,'updateProfile'])->name('update.profile');


    Route::get('dashboard',[StaffDashboardController::class,'dashboard'])->name('dashboard');

    Route::resource('listing',StaffListingController::class);
    Route::get('listing-status/{id}',[StaffListingController::class,'changeStatus'])->name('listing.status');
    Route::get('delete-file/{id}',[StaffListingController::class,'deleteFile'])->name('delete-file');

    Route::get('listing-image/{id}',[StaffListingImageController::class,'index'])->name('listing.image');
    Route::post('listing-new-image/',[StaffListingImageController::class,'newImage'])->name('listing.new.image');
    Route::get('delete-listing-image/{id}',[StaffListingImageController::class,'deleteImage'])->name('delete.listing.image');
    Route::post('listing-new-logo/',[StaffListingImageController::class,'newLogo'])->name('listing.new.logo');
    Route::post('listing-new-thumbnail/',[StaffListingImageController::class,'newThumbnail'])->name('listing.new.thumbnail');
    Route::post('listing-new-banner/',[StaffListingImageController::class,'newBanner'])->name('listing.new.banner');

    Route::get('listing-video/{id}',[StaffListingVideoController::class,'index'])->name('listing.video');
    Route::post('listing-new-video',[StaffListingVideoController::class,'newVideo'])->name('listing.new.video');
    Route::get('delete-listing-video/{id}',[StaffListingVideoController::class,'deleteVideo'])->name('delete.listing.video');

    Route::get('listing-schedule/{id}',[StaffListingScheduleController::class,'index'])->name('listing.schedule');
    Route::get('listing-new-schedule/{id}',[StaffListingScheduleController::class,'create'])->name('listing.new.schedule');
    Route::post('listing-schedule-store/{id}',[StaffListingScheduleController::class,'store'])->name('listing.schedule.store');
    Route::get('listing-schedule-edit/{id}',[StaffListingScheduleController::class,'edit'])->name('listing.schedule.edit');
    Route::post('listing-schedule-update/{id}',[StaffListingScheduleController::class,'update'])->name('listing.schedule.update');
    Route::get('listing-schedule-delete/{id}',[StaffListingScheduleController::class,'destroy'])->name('listing.schedule.delete');
    Route::get('listing-schedule-status/{id}',[StaffListingScheduleController::class,'changeStatus'])->name('listing.schedule.status');

});
