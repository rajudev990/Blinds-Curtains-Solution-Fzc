<?php

use App\Http\Controllers\Admin\AboutUsPageController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookTimeController;
use App\Http\Controllers\Admin\CacheManagementController;
use App\Http\Controllers\Admin\CatalougeController;
use App\Http\Controllers\Admin\CatalougeBookController;
use App\Http\Controllers\Admin\PageNumberController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChooseCurtainController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerSayController;
use App\Http\Controllers\Admin\DifferentFabricController;
use App\Http\Controllers\Admin\ElectricCurtainController;
use App\Http\Controllers\Admin\EstimateListController;
use App\Http\Controllers\Admin\FurtherGoController;
use App\Http\Controllers\Admin\GetEstimateTitleController;
use App\Http\Controllers\Admin\HappyclientController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\HelpTitleController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\HowItWorkController;
use App\Http\Controllers\Admin\LifeStyleController;
use App\Http\Controllers\Admin\LifeStyleTitleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\OurBlogController;
use App\Http\Controllers\Admin\OurTeamController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectHilightController;
use App\Http\Controllers\Admin\ProjectVideoController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SectionTitleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SmartCurtainPageController;
use App\Http\Controllers\Admin\SmartCurtainsMediaController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\UserMailController;

use App\Http\Controllers\Admin\FullNessController;
use App\Http\Controllers\Admin\InvoiceStatementController;
use App\Http\Controllers\Admin\PollingController;
use App\Http\Controllers\Admin\OpeningController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\LinningController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\WhyKurtainsController;
use Illuminate\Support\Facades\Route;

// Route::get('/login',function(){
//   return redirect()->route('admin.login');
// });
Route::get('/admin/login',function(){
   return redirect()->route('admin.login');
});
Route::get('/admin/production-login',function(){
   return view('admin.auth.production-login');
});

Route::get('/admin/installation-login',function(){
   return view('admin.auth.installation-login');
});

Route::get('/admin/marketing-login',function(){
   return view('admin.auth.marketing-login');
});

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['verified'])->name('dashboard');


    Route::resource('roles', RoleController::class)->middleware(['permission:Role access','permission:Role edit','permission:Role create','permission:Role delete']);
    Route::resource('permissions', PermissionController::class)->middleware(['permission:Permission access','permission:Permission edit','permission:Permission create','permission:Permission delete']);
    Route::resource('users', UserController::class)->middleware(['permission:User access','permission:User edit','permission:User create','permission:User delete']);


    Route::get('cache-management',[CacheManagementController::class,'index'])->name('cache')->middleware(['permission:Website access']);
    Route::get('cache-management-route-clear',[CacheManagementController::class,'clearRoute'])->name('cache.route_clear')->middleware(['permission:Website access']);
    Route::get('cache-management-view-clear',[CacheManagementController::class,'clearView'])->name('cache.view_clear')->middleware(['permission:Website access']);
    Route::get('cache-management-config-clear',[CacheManagementController::class,'clearConfig'])->name('cache.config_clear')->middleware(['permission:Website access']);
    Route::get('cache-management-cache-clear',[CacheManagementController::class,'clearCache'])->name('cache.cache_clear')->middleware(['permission:Website access']);
    Route::get('cache-management-optimize-clear',[CacheManagementController::class,'clearOptimize'])->name('cache.optimize_clear')->middleware(['permission:Website access']);
    Route::get('cache-management-storage-link',[CacheManagementController::class,'clearStorage'])->name('cache.storage_link')->middleware(['permission:Website access']);


    // Products
    Route::resource('categories',CategoryController::class)->middleware(['permission:Category access','permission:Category edit','permission:Category create','permission:Category delete']);

    Route::resource('product',ProductController::class)->middleware(['permission:Product access','permission:Product edit','permission:Product create','permission:Product delete']);
    Route::post('product/attribute/delete/{id}',[ProductController::class,'deleteAttr']);
    Route::post('product/image/delete/{id}',[ProductController::class,'deleteImage']);
    
    
    Route::get('/fetch-catalogue', [ProductController::class, 'fetchCatalogue'])->name('fetch.catalogue');
    Route::get('/fetch-catalogue-book-details', [ProductController::class, 'fetchCatalogueBookDetails'])->name('fetch.catalogue.book.details');
    Route::get('/fetch-catalogue-book-edit-details', [ProductController::class, 'fetchCatalogueEditBookDetails'])->name('fetch.catalogueEditBookDetails');



    Route::get('fetch/catalogueBooks', [ProductController::class, 'fetchCatalogueBooks'])->name('fetch.catalogueBooks');
    Route::get('fetch/pageNumbers', [ProductController::class, 'fetchPageNumbers'])->name('fetch.pageNumbers');
    Route::get('remove-order-items-image/{id}', [OrderController::class, 'removeImage'])->name('orderItems.removeImage');









    Route::resource('how-it-works',HowItWorkController::class)->middleware(['permission:Website access']);
    Route::resource('hero-section',HeroController::class)->middleware(['permission:Website access']);
    Route::resource('customer-say',CustomerSayController::class)->middleware(['permission:Website access']);
    Route::resource('banner',BannerController::class)->middleware(['permission:Website access']);
    Route::resource('happy-client',HappyclientController::class)->middleware(['permission:Website access']);
    Route::resource('services',ServiceController::class)->middleware(['permission:Website access']);
    Route::resource('estimate-list',EstimateListController::class)->middleware(['permission:Website access']);
    Route::resource('our-team',OurTeamController::class)->middleware(['permission:Website access']);
    Route::resource('social_link',SocialLinkController::class)->middleware(['permission:Website access']);
    Route::resource('choose-curtain',ChooseCurtainController::class)->middleware(['permission:Website access']);
    Route::resource('pages',PageController::class)->middleware(['permission:Website access']);
    Route::resource('curtains-styles',OurBlogController::class)->middleware(['permission:Website access']);
    Route::resource('why-kurtains',WhyKurtainsController::class)->middleware(['permission:Website access']);
    Route::resource('different-fabric',DifferentFabricController::class)->middleware(['permission:Website access']);
    Route::resource('help',HelpController::class)->middleware(['permission:Website access']);

    Route::resource('setting',SettingController::class)->middleware(['permission:Setting access']);
    Route::resource('aboutus',AboutUsPageController::class)->middleware(['permission:Setting access']);

    Route::resource('go-furthers',FurtherGoController::class)->middleware(['permission:Website access']);
    Route::resource('life-styles',LifeStyleController::class)->middleware(['permission:Website access']);
    Route::resource('smart-curtains-media',SmartCurtainsMediaController::class)->middleware(['permission:Website access']);
    Route::resource('electric-curtains',ElectricCurtainController::class)->middleware(['permission:Website access']);
    Route::resource('smart-curtains-pages',SmartCurtainPageController::class)->middleware(['permission:Website access']);



    Route::resource('contacts',ContactUsController::class)->middleware(['permission:Contact access','permission:Contact edit','permission:Contact create','permission:Contact delete']);
    Route::get('contacts-seen/{id}',[ContactUsController::class, 'status'])->name('contacts.status');
    
    Route::resource('subscribers',SubscriberController::class)->middleware(['permission:Subscriber access','permission:Subscriber edit','permission:Subscriber create','permission:Subscriber delete']);
    Route::post('/update-subscriber-status/{id}', [SubscriberController::class, 'status'])->name('subscriber.updateStatus');


    
    Route::resource('project-hilights',ProjectHilightController::class)->middleware(['permission:Website access']);
    Route::resource('project-videos',ProjectVideoController::class)->middleware(['permission:Website access']);
    
    Route::resource('life-style-title',LifeStyleTitleController::class)->middleware(['permission:Website access']);
    Route::resource('get-estimate-title',GetEstimateTitleController::class)->middleware(['permission:Website access']);

    Route::resource('section-title',SectionTitleController::class)->middleware(['permission:Website access']);

    Route::resource('help-title',HelpTitleController::class)->middleware(['permission:Website access']);

    // Route::get('report',[ReportController::class,'index'])->name('report')->middleware(['permission:Report access']);    
    Route::get('report',[ReportController::class,'index'])->name('report');    
    Route::get('/orders/filter', [ReportController::class, 'filterOrders'])->name('order.filter');

    Route::resource('statements',InvoiceStatementController::class);
    Route::get('statements-print/{code}',[InvoiceStatementController::class,'print'])->name('statements.print');
    
    // Books
    // Route::resource('books',BookController::class)->middleware(['permission:Book access','permission:Book edit','permission:Book create','permission:Book delete']);


    Route::resource('books',BookController::class);
    
    // Book Time
    Route::resource('book-times',BookTimeController::class)->middleware(['permission:BookTime access','permission:BookTime edit','permission:BookTime create','permission:BookTime delete']);


    // Anik Start
    Route::get('order/index/{id}', [OrderController::class, 'index'])->name('order.index')->middleware(['permission:Order access']);
    Route::get('order/create/{id}', [OrderController::class, 'create'])->name('order.create')->middleware(['permission:Order create']);
    Route::post('order/note/create{id}', [OrderController::class, 'noteCreate'])->name('order.note.create')->middleware(['permission:Order create']);
    Route::post('order/save', [OrderController::class, 'orderSave'])->name('order.save')->middleware(['permission:Order create']);
    Route::post('order/coupon/apply', [OrderController::class, 'couponApply'])->name('order.coupon.apply')->middleware(['permission:Order access']);
    Route::post('item/create/{id}', [OrderController::class, 'itemCreate'])->name('item.create')->middleware(['permission:Order create']);
    Route::get('item/copy/{id}', [OrderController::class, 'itemCopy'])->name('item.copy')->middleware(['permission:Order access']);
    Route::post('item/update/{id}', [OrderController::class, 'itemupdate'])->name('item.update')->middleware(['permission:Order edit']);
    Route::get('item/delete/{id}', [OrderController::class, 'itemDelete'])->name('item.delete')->middleware(['permission:Order delete']);

    Route::resource('coupon', CouponController::class)->middleware(['permission:Coupon access','permission:Coupon edit','permission:Coupon create','permission:Coupon delete']);
    // Anik End


    //Order status
    Route::get('book/send-discount/{code}', [BookController::class, 'sendDiscountAdmin'])->name('book.send-admin');

    Route::get('book/cancel/{id}', [BookController::class, 'cancel'])->name('books.cancel');
    

    Route::get('book/discount-list/', [BookController::class, 'discountList'])->name('book.discount-list');
    
    Route::get('order/payment-list/', [OrderController::class, 'paymentList'])->name('order.payment-list');
    Route::get('order-confirm/{id}', [OrderController::class, 'paymentConfirm'])->name('order.confirm');
    
    Route::get('order-half/{id}', [OrderController::class, 'paymentConfirmHalf'])->name('order.half');
    Route::get('order-full/{id}', [OrderController::class, 'paymentConfirmFull'])->name('order.full');
    Route::get('order-tabby/{id}', [OrderController::class, 'paymentConfirmFullTabby'])->name('order.tabby');
    
    
    Route::get('order-show/{id}', [OrderController::class, 'orderShow'])->name('order.view');
    Route::get('order-show-print/{id}', [OrderController::class, 'orderShowPrint'])->name('order.view.print');
    Route::get('order-production-print/{id}', [OrderController::class, 'orderProductionShowPrint'])->name('order.production.print');

    Route::get('order/remove/{id}', [OrderController::class, 'orderRemove'])->name('order.remove');

    
    Route::get('order/production-list/', [OrderController::class, 'productionList'])->name('order.production-list');
    Route::get('production-confirm/{id}', [OrderController::class, 'productionConfirm'])->name('production.confirm');
    Route::get('production-processing/{id}', [OrderController::class, 'productionProcessing'])->name('production.processing');

    Route::get('order/installation-list/', [OrderController::class, 'installationList'])->name('order.installation-list');
     Route::get('installation-processing/{id}', [OrderController::class, 'installationProcessing'])->name('installation.processing');


    // Dashbaord Role Team
    Route::get('order-marketing-list/', [BookController::class, 'index'])->name('role.book.marketing-list')->middleware(['permission:Marketing access','permission:Marketing edit','permission:Marketing create','permission:Marketing delete']);

    Route::get('order-production-list/', [OrderController::class, 'productionList'])->name('role.order.production-list')->middleware(['permission:Production access','permission:Production edit','permission:Production create','permission:Production delete']);

    Route::get('order-installation-list/', [OrderController::class, 'installationList'])->name('role.order.installation-list')->middleware(['permission:Installation access','permission:Installation edit','permission:Installation create','permission:Installation delete']);
    // Dashbaord Role Team

    Route::get('installation-confirm/{id}', [OrderController::class, 'installationConfirm'])->name('installation.confirm');
    
    Route::get('feedback-link-send/{id}', [OrderController::class, 'feedbackLinkConfirm'])->name('feedback-link');
    
    Route::get('installation-feedback/{code}', [OrderController::class, 'installationFeedback'])->name('installation.feedback');
    Route::post('feedback/store', [OrderController::class, 'feedbackStore'])->name('feedback.store');
    
    Route::get('order/feddback-list/', [OrderController::class, 'feedbackList'])->name('order.feedback-list');
    Route::get('feedback-confirm/{id}', [OrderController::class, 'feedbackConfirm'])->name('feedback.confirm');
    
    Route::get('order/complete-list/', [OrderController::class, 'completeList'])->name('order.complete-list');
    Route::get('order/cancel-list/', [OrderController::class, 'cancelList'])->name('order.cancel-list');
    
    
    Route::post('book/paymentSearch/', [BookController::class, 'paymentSearch'])->name('book.paymentSearch');
    Route::post('book/paymnetAction/', [BookController::class, 'paymnetAction'])->name('book.paymnetAction');


    Route::resource('catalogues', CatalougeController::class)->middleware(['permission:Catalouge access','permission:Catalouge edit','permission:Catalouge create','permission:Catalouge delete']);
    
    Route::resource('catalogue-books', CatalougeBookController::class)->middleware(['permission:Catalouge access','permission:Catalouge edit','permission:Catalouge create','permission:Catalouge delete']);
    
    Route::resource('page-numbers', PageNumberController::class)->middleware(['permission:Catalouge access','permission:Catalouge edit','permission:Catalouge create','permission:Catalouge delete']);
    
    Route::resource('fullness', FullNessController::class)->middleware(['permission:FullNess access','permission:FullNess edit','permission:FullNess create','permission:FullNess delete']);
    Route::resource('polling', PollingController::class)->middleware(['permission:Polling access','permission:Polling edit','permission:Polling create','permission:Polling delete']);
    Route::resource('opening', OpeningController::class)->middleware(['permission:Opening access','permission:Opening edit','permission:Opening create','permission:Opening delete']);
    Route::resource('location', LocationController::class)->middleware(['permission:Location access','permission:Location edit','permission:Location create','permission:Location delete']);
    Route::resource('linning', LinningController::class)->middleware(['permission:Linning access','permission:Linning edit','permission:Linning create','permission:Linning delete']);





    
 
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/change-password', [AdminProfileController::class, 'changePassword'])->name('profile.passedit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
    


    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::get('customer-book/{code}', [UserMailController::class, 'sendPaymentLink'])->name('admin.book.send-user');


// Route::get('order/checkout/{code}', [UserMailController::class, 'checkout'])->name('admin.order.checkout');
// Route::post('order/pay/{code}', [OrderController::class, 'userPayment'])->name('admin.order.pay');

// payment
Route::get('/order/checkout/{code}', [OrderController::class, 'showPaymentForm'])->name('admin.order.checkout');
Route::get('/order/invoice-payment/{code}', [OrderController::class, 'invoice'])->name('admin.order.invoice');
Route::post('/apply-coupon', [OrderController::class, 'applyCoupon'])->name('applyCoupon');


Route::post('/payment', [OrderController::class, 'createPaymentIntent'])->name('admin.order.pay');
Route::get('/payment/success', [OrderController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/success/payment/{id}', [OrderController::class, 'userSuccessOrder'])->name('order.user.success');
Route::get('/payment/cancel', [OrderController::class, 'paymentCancel'])->name('payment.cancel');



Route::get('order-time-setup-installation/{code}', [OrderController::class, 'installTime'])->name('admin.order.install-time');
Route::post('time-shedule-setup/{code}', [OrderController::class, 'timeShedule'])->name('order.send-install-time');


Route::get('order/get-install-times', [OrderController::class, 'getInstallTimes'])->name('order.get-install-times');



// Route to fetch events for FullCalendar
Route::get('/orders/get-installation-data', [OrderController::class, 'getInstallationData']);
Route::get('/orders/get-installation-data-abu-dhabi', [OrderController::class, 'getInstallationDataAbuDhabi']);
// Route to fetch a specific order's details for the modal
Route::get('/orders/{id}', [OrderController::class, 'getOrderDetails']);
Route::post('/orderitems/update-status', [OrderController::class, 'updateStatus'])->name('orderitems.updateStatus');



// calendar
Route::get('/getAllBookTimes', [BookController::class, 'getAllBookTimes'])->name('getAllBookTimes');
Route::get('/getAllBookTimesOne', [BookController::class, 'getAllBookTimesAnother'])->name('getAllBookTimesAnother');


Route::get('/bookings/{id}/delivered', [BookController::class, 'markDelivered'])->name('markDelivered');
// Route::get('/bookings/{id}/failed', [BookController::class, 'markFailed'])->name('markFailed');

// Define the route in web.php
Route::post('/mark-failed', [BookController::class, 'markFailed'])->name('markFailed');


Route::post('/bookings/add', [BookController::class, 'addBooking'])->name('addBooking');
Route::post('/bookings/block', [BookController::class, 'blockBooking'])->name('blockBooking');



Route::get('/review-customer-feedback/{code}',[OrderController::class,'customerReview'])->name('customer-feedback');
Route::post('/customer-feedback-store',[OrderController::class,'customerfeedBackStore'])->name('customer.feedback.store');








