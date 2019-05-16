<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


// //////////////////////////////////////////////////////////////////////////////
// Frontend routes
// //////////////////////////////////////////////////////////////////////////////

////
//Route::get('/{slug}', 'ShopingCartController@index')->name('shoping-cart.view');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

//Site Subscription
Route::post('/site/subscription', 'HomeController@siteSubscription')->name('site.subscription');
Route::post('/site/contact-us', 'HomeController@siteContactUs')->name('site.contactus');


//File download
Route::get('/funnel/bonus/download/{token}', 'ShopingCartController@downloadFunnelBonus')->name('shopping.download.bonus');


//Chat Messenger
Route::resource('/messenger', 'ChatMessengerController');
Route::get('/messenger/message/{id}/unread/', 'ChatMessengerController@getUnreadMessage')->name('messenger.message.unread');
Route::post('/messenger/message/{id}/mark/read', 'ChatMessengerController@updateMessageStatus')->name('messenger.message.mark.read');



Route::get('blogs', 'BlogController@index')->name('blogs.index');
Route::get('blog/details/{id}', 'BlogController@show')->name('blogs.show');
Route::post('blog/comment', 'BlogCommentsController@store')->name('blog.comment');
Route::post('pages/save-thumbnails', 'PagesController@saveThumbnail')->name('save-page-thumbnail');
Route::get('faqs', 'FaqController@index')->name('faqs.index');
Route::get('about-us', 'CMSController@aboutUs')->name('about-us');
//Route::get('contact-us', 'CMSController@contactUs')->name('contact-us');
Route::get('how-it-works', 'CMSController@howItWorks')->name('how-it-works');
Route::get('testimonial', 'CMSController@testimonial')->name('testimonial');
Route::get('terms-and-conditions', 'CMSController@termsAndConditions')->name('terms-and-conditions');
//CMS pages ends

//Subscribe Newsletters start
Route::post('newsletters/subscriptions', 'NewsletterSubscriptionsController@store')->name('newsletters-subscriptions.store');
Route::get('newsletters/subscriptions/confirmattion/email', 'NewsletterSubscriptionsController@confirmationEmail')->name('newsletters-subscriptions.confirmation.email');

//Subscription
//Route::get('/subscription', 'SubscriptionController@index')->name('subscriptions.show');
//Route::resource('/subscription', 'SubscriptionController');
Route::resource('/subscription', 'SubscriptionController');





//Shoping cart
Route::get('funnel/{slug}', 'ShopingCartController@index')->name('funnel.view');
Route::post('funnel/{id}/step/{step_id}/product', 'ShopingCartController@storeStepProduct')->name('funnel.step.product.add');
Route::post('product/varient-image', 'ShopingCartController@getImageVarient')->name('product.varient.image');
//Route::post('product/varient-image', 'ProductController@getImageVarient')->name('product.varient.image');
Route::get('page/{slug}', 'ShopingCartController@showPage')->name('page.view');
//Route::get('page/{slug}', 'PagesController@showPage')->name('page.view');
Route::post('optin/save', 'ShopingCartController@optinSave')->name('optin.save');
Route::post('integration/process', 'ShopingCartController@processIntegrationData')->name('integration.process');
Route::post('product/checkout', 'ShopingCartController@productCheckout')->name('products.checkout');
//Route::post('product/checkout', 'ProductController@productCheckout')->name('products.checkout');
//Route::post('order', 'ShopingCartController@makeOrder')->name('order.download');
Route::post('product/cart/{id}', 'ShopingCartController@getProductCartInfo');
//Route::post('product/cart/{id}', 'ProductController@getProductCartInfo');
Route::get('order/get-order-session', 'ShopingCartController@getOrderSession');
//Route::get('order/get-order-session', 'OrderController@getOrderSession');
Route::get('page/{id}/screenshoot/show', 'ShopingCartController@getScreenshoot')->name('page.screenshoot');
Route::get('page/{id}/screenshoot/thumb', 'ShopingCartController@getScreenshootThumb')->name('page.screenshoot.show');
//Route::get('page/screenshoot/{id}', 'OtherController@getScreenshoot')->name('page.screenshoot');
Route::post('page/{id}/next-step', 'ShopingCartController@gotoNextStep')->name('page.gonext');
//Route::post('page/{id}/next-step', 'PagesController@getNextStep')->name('page.next_step');
Route::post('/shopify/image-additional/{product_id}', 'ShopingCartController@getImageAdditional')->name('shopify.image.additional');
//Route::post('/shopify/image-additional/{product_id}', 'ShopifyController@getImageAdditional')->name('shopify.image.additional');
Route::post('/cart/update', 'ShopingCartController@updateProductAdd')->name('cart.update.add');
Route::post('/product/get-shipping-methods', 'ShopingCartController@getShippingMethods')->name('product.shipping.method');
Route::post('/product/shipping/update-cart', 'ShopingCartController@updateCartWithShipping')->name('product.cart.shipping.update');
Route::post('/coupon/apply-coupon', 'ShopingCartController@applyCoupon')->name('product.apply');
Route::post('/page/visitor', 'ShopingCartController@addPageVisitor')->name('page.visitor'); //visitor
Route::get('/paypal/save', 'ShopingCartController@savePaypalDetails')->name('paypal.save.info');
Route::post('/paypal/save', 'ShopingCartController@savePaypalDetails')->name('paypal.save.info');


//Order
Route::get('order/download-csv', 'OrderController@downloadCSV')->name('order.download');
Route::get('order/recent', 'OrderController@getRecentOrders');
//Route::get('order/get-order-session', 'OrderController@getOrderSession');
Route::post('order/latest-order-toast', 'OrderController@getLatestOrderToast')->name('order.latest.toast');
Route::resource('order', 'ShopingCartController');

//Route::post('product/cart/{id}', 'ProductController@getProductCartInfo');





Route::group(['middleware' => ['validity']], function () {
    //Funnel   


    //archive
    Route::resource('funnel/{funnel_id}/archive', 'FunnelArchiveController');
    Route::post('funnel/{funnel_id}/archive/remove', 'FunnelArchiveController@removeArchive')->name('funnel.archive.remove');

    
    Route::get('funnels/{funnel_id}/load-products', 'ProductsController@loadProducts')->name('funnel.load.product');
    Route::post('funnels/{funnel_id}/product/{product_id}/variants', 'ProductsController@getProductVariants')->name('funnel.load.product.varients');
    Route::post('product/{id}/variant/details', 'ProductsController@getVariantDetails')->name('product.varient.details');


    //Feature Upgrade
    Route::resource('/feature-upgrade', 'FeatureUpgradeController');
    Route::post('/feature-upgrade/update/status', 'FeatureUpgradeController@updateStatus')->name('feature-upgrade.update.status');
    Route::post('/feature-upgrade/cancel', 'FeatureUpgradeController@cancelUpgrade')->name('feature-upgrade.cancel');


    //Step Download
    Route::resource('funnels/{id}/upload', 'FunnelUploadController', ['as' => 'funnels']);
    Route::post('funnels/{id}/upload/remove', 'FunnelUploadController@deleteUpload')->name('funnels.upload.remove');



    //Step email
    Route::resource('funnels/{id}/steps/email', 'FunnelEmailController', ['as' => 'funnel.step']);

    Route::post('page/screenshoot/save', 'PagesController@saveScreenShoot')->name('page.screenshoot.save');
    Route::post('order/{id}/tracking/add', 'OrderController@addTracking')->name('order.tracking.add');


    Route::post('funnels/{id}/steps/{step_id}/clone', 'FunnelStepsController@cloneStep')->name('funnel.step.clone');
    Route::post('funnels/{id}/steps/{step_id}/remove-template', 'FunnelStepsController@removeTemplate')->name('funnel.step.template.remove');

    Route::get('funnels/{id}/steps/{step_id}/integration/show', 'FunnelStepsController@showStepIntegrationPage')->name('funnel.step.integration.show');
    Route::post('funnels/{id}/steps/{step_id}/integration/save', 'FunnelStepsController@saveStepIntegration')->name('funnel.step.integration.save');
    Route::post('funnels/{id}/steps/{step_id}/integration/remove', 'FunnelStepsController@removeStepIntegration')->name('funnel.step.integration.remove');

    Route::resource('funnels/{id}/steps', 'FunnelStepsController');

    Route::resource('funnels/{id}/stats', 'FunnelStatsController');
    Route::resource('funnels/{id}/contacts', 'FunnelContactsController');
    Route::get('funnels/{id}/sales', 'FunnelSalesController@index')->name("funnel.sales.index");

    //clone funnel
    Route::post('funnels/{id}/clone', 'FunnelController@cloneFunnel')->name("funnel.clone");



    Route::post('step/product/details', 'ProductsController@getStepProductDetails')->name('step.product.details');

    Route::resource('funnels/{id}/steps/{step_id}/product', 'ProductsController');
    Route::get('funnels/{id}/steps/{step_id}/products/list', 'ProductsController@ajaxGetProductList')->name('products.list');
    Route::post('funnels/{id}/change-order', 'FunnelController@changeStep')->name('funnel.step.change');
    Route::resource('funnels/{slug}/page', 'FunnelPageController@index');
    //Route::get('funnels/{slug}', 'FunnelController@index')->name('funnel');
    //Route::get('funnel/{slug}', 'FunnelController@getFunnelPage')->name('funnel.view');
    //Route::post('funnels/store', 'FunnelController@store')->name('funnel.store');
    //Route::get('funnels/{id}/edit', 'FunnelController@edit')->name('funnel.edit');
    Route::get('funnels/{id}/steps/{step_id}/automation', 'FunnelStepsController@getFunnelAutomation')->name('funnel.automation');
    Route::post('funnels/{id}/steps/{step_id}/automation-save', 'FunnelStepsController@saveFunnelAutomation')->name('funnel.automation.save');
    Route::post('funnels/{id}/steps/{step_id}/automation-remove', 'FunnelStepsController@removeFunnelAutomation')->name('funnel.automation.remove');

    Route::post('funnel/step/email/update', 'FunnelStepsController@updateEmailSettings')->name('step.email.settings.update');

    Route::post('funnel/step/{id}/email/remove', 'FunnelStepsController@removeEmailSettings')->name('step.email.settings.remove');

    Route::post('funnels/search', 'FunnelController@searchFunnel')->name('funnels.search');

    Route::resource('funnels', 'FunnelController');


    //Page
    //Route::post('page/{id}/next-step', 'PagesController@getNextStep')->name('page.next_step');
    Route::get('pages/{id}/edit', 'PagesController@edit')->name('pages.edit');
    Route::get('template/update-template/{id}', 'PagesController@updateTemplate')->name('pages.update.template');
    Route::get('pages/add-template/{step_id}', 'PagesController@addTemplate')->name('pages.template.add');
    Route::get('pages/remove-template/{step_id}', 'PagesController@removeTemplate');
    Route::post('pages/get-template-image', 'PagesController@getTemplateImage');
    //Route::post('pages/get-screenshoot/{page_id}', 'PagesController@getScreenshoot');
    //Route::get('page/screenshoot/{id}', 'OtherController@getScreenshoot')->name('page.screenshoot');
    Route::post('pages/upload-image', 'PagesController@ajax_uploadImage')->name('ajax.pages.upload-image');
    //Route::get('page/{slug}', 'PagesController@showPage')->name('page.view');
    Route::get('pages/{id}', 'PagesController@show')->name('pages.show');
    Route::resource('/pages', 'PagesController');


    //Other
    Route::get('/page/view/{id}', 'OtherController@showPage')->name('page.scereenshoot.view');
    Route::post('page/screenshoot/editor', 'OtherController@getScreenshoot')->name('page.screenshoot.editor');



    //Widgets
    Route::post('widget/element/screenshoot', 'WidgetController@getscreenshoot');
    Route::get('widget/element/{id}', 'WidgetController@getElement');
    Route::get('widget/settings/{id}', 'ElementSettingsController@getElementSettings');
    Route::post('widget/settings/{id}', 'ElementSettingsController@getElementSettings');
    Route::resource('widget', 'WidgetController');


    //Product
    //Route::post('product/varient-image', 'ProductController@getImageVarient')->name('product.varient.image');
    //Route::post('product/checkout', 'ProductController@productCheckout')->name('products.checkout');
    Route::post('products/imgeupload', 'ProductController@productImageUpload')->name('products.imgeupload');
    Route::post('products/varient/imgeupload', 'ProductController@productVarientImageUpload')->name('products.varient.imgeupload');
    Route::get('product/editor-product-list', 'ProductController@editorGetProductList');
    Route::delete('products/remove-varient/{id}', 'ProductController@removeProductVarient');
    Route::get('products/shopify', 'ProductsController@getShopifyProductList')->name('products.shopify');
    Route::post('product/replace/editor', 'FunnelStepsController@replaceEditorContent')->name('editor.replace.product');

    Route::resource('products', 'ProductController');


    //Page templates
    //Route::get('page-templates/{id}', 'PageTemplatesController@show')->name('page_templates.show');
    //Route::get('page-templates/{id}', 'PageTemplatesController@show')->name('page_templates.show');


    //Image
    Route::get('ajaxImageUpload', ['uses'=>'WidgetController@ajaxImageUpload']);
    Route::post('ajaxImageUpload', 'WidgetController@ajaxImageUploadPost')->name('ajaxImageUpload');
    Route::get('/gallery-images', 'WidgetController@getGalleryImages')->name('gallery.images.list');
    Route::post('/gallery-images/remove', 'WidgetController@removeGalleryImages')->name('gallery.image.remove');



    //Profile
    Route::resource('/profile', 'ProfileController');


    //Account Billing
    Route::resource('/account-billing', 'AccountBillingController');
    


    //Smtp
    Route::resource('/smtp', 'SmtpSettingsController');


    //Payment gateway
    //Route::post('/gateway/remove', 'PaymentGatewayController@removeGateway')->name('payment.gateway.removes');
    Route::resource('/payment-gateway', 'PaymentGatewayController');    

    //Integration
    Route::post('/integration/get-details', 'IntegrationController@getIntegrationDetails')->name('integration.get_details');
    Route::post('/integration/update-details', 'IntegrationController@updateIntegrationDetails')->name('integration.update_details');
    Route::post('/integration/remove-details', 'IntegrationController@removeIntegrationDetails')->name('integration.remove');
    Route::resource('/integration', 'IntegrationController');

    Route::post('/integration/fetch-list', 'IntegrationController@fetchList')->name('integration.fetch.list');



    //MANAGE
    //Route::post('/shopify/image-additional/{product_id}', 'ShopifyController@getImageAdditional')->name('shopify.image.additional');
    Route::get('/shopify/show-shop', 'ShopifyController@showShop')->name('shopify.shop.show');
    Route::post('/shopify/save-shop', 'ShopifyController@saveShopDetails')->name('shopify.shop.save');
    Route::get('/shopify/product-list/{step_id}', 'ShopifyController@getProductList')->name('shopify.product.list');
    Route::get('/product-list/{step_id}', 'ProductsController@getProductList')->name('manual.product.list');
    Route::get('/bump-product-list/{step_id}', 'ProductsController@getBumpProductList')->name('bump.product.list');
    Route::resource('/shopify', 'ShopifyController');



    //SALES
    Route::resource('/sales', 'SalesController');


    //Others
    Route::post('settings/buttonurl/{type}', 'ElementSettingsController@getButtonUrl')->name('settings.buttonurl');
    Route::get('my-account', 'FrontEndController@getProfile')->name('user-profile');
    Route::post('my-account', 'FrontEndController@postProfile')->name('user-profile');
    Route::post('change-funnel-step-type', 'FunnelStepsController@changeType')->name('change-funnel-step-type');
    Route::resource('orders', 'OrderController');


    //COUPON
    Route::resource('/coupon', 'CouponController');


    //Route::resource('/dashboard', 'DashboardController');
    Route::resource('/dashboard', 'DashboardController');
});



Route::get('/', 'HomeController@index')->name('index');







// --------------------------------------------------- Admin -------------------------------------------------------
Route::prefix('admin')->group(function() {

    Route::get('/login', 'Admin\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');


    //USER
    //Route::get('/user/{id}/upgrade', 'Admin\UserController@');
    Route::post('/user/list', 'Admin\UserController@getUserList')->name('admin.user.list');
    Route::resource('/user', 'Admin\UserController', ['as' => 'admin']);


    //Chat Messenger
    Route::resource('/messenger', 'Admin\ChatMessengerController', ['as' => 'admin']);
    Route::post('/user/{id}/messages/{message_id}', 'Admin\ChatMessengerController@getUserMessages')->name('admin.user.messages');
    Route::get('/messenger/messages/{id}/unread/', 'Admin\ChatMessengerController@getUnreadMessage')->name('admin.messenger.message.unread');
    Route::post('/messenger/messages/{id}/mark/read', 'Admin\ChatMessengerController@updateMessageStatus')->name('admin.messenger.message.mark.read');


    //FEATURE UPGRADE
    Route::resource('/feature-upgrade/{id}/users', 'Admin\UserUpgradeController', ['as' => 'admin.upgrade']);
    Route::resource('/feature-upgrade', 'Admin\FeatureUpgradeController', ['as' => 'admin']);


    //USER MARKETPLACE
    Route::resource('/user-marketplace', 'Admin\UserMarketPlaceController', ['as' => 'admin']);



    //PAYMENT GATEWAY
    Route::resource('/payment-gateway', 'Admin\PaymentController', ['as' => 'admin']);


    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
    
    Route::get('/', 'Admin\AdminLoginController@index')->name('admin.index');
});

