<?php

use App\Http\Controllers\Admin\CalculatorController;
use App\Http\Controllers\Client\Auth\AccountDeletionController;
use App\Http\Controllers\Client\Auth\PasswordController;
use App\Http\Controllers\Client\Auth\ProfileController;
use App\Http\Controllers\Marchant\MarchantDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DeliverychargeController as AdminDeliverychargeController;
use App\Http\Controllers\Admin\MarchantController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\Client\ViewController;
use App\Http\Controllers\Deliveryman\DeliveryManController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Marchant\AllConsignmentController;
use App\Http\Controllers\Marchant\FraudController as MarchantFraudController;
use App\Http\Controllers\Marchant\ProductController;
use App\Http\Controllers\Pickupman\PickupManController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


Route::controller(ViewController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('tracking', 'tracking')->name('tracking');
    Route::get('contact', 'contact')->name('contact');
    Route::get('service', 'service')->name('service');
    Route::get('about', 'about')->name('about');
    Route::get('/get-destinations', 'getDestinations');
    Route::get('/get-categories', 'getCategories');
    Route::get('/get-services', 'getServices');
});


Route::controller(AccountDeletionController::class)->group(function () {
    Route::get('account-delete', 'index')->name('account.delete');
    Route::post('account-delete', 'destroy');
});

Route::get('profile-update', [ProfileController::class, 'index'])->name('profile.update');
Route::get('password-change', [PasswordController::class, 'index'])->name('auth.password');


// ____Mrachant____
Route::resources([
    'deliverycharge' => CalculatorController::class,
    // 'delivery' => DeliveryController::class,
    'pickup' => PickupController::class,
    'product' => ProductController::class,
]);
Route::controller(MarchantDashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::get('merchant/coverage/area', 'coverageArea')->name('merchant.coverage.area');
    Route::get('merchant/pricing', 'pricing')->name('merchant.pricing');
    Route::post('marchant/delivery', 'deliveryConfirmation')->name('marchant.delivery_confirmation');
    Route::post('marchant/checkout', 'deliveryCheckout')->name('marchant.delivery_checkout');
    Route::post('marchant/cancel', 'cancelConfirmation')->name('marchant.cancel_confirmation');

    Route::get('merchant/product/store', 'productCreate')->name('merchant.product.create');
    Route::post('admin/product/store', 'productStore')->name('merchant.product.store');
});

Route::controller(MarchantFraudController::class)->group(function () {
    Route::get('/fraud_check', 'fraud_check')->name('fraud_check');
    Route::get('fraud/add_new', 'fraud_add_new')->name('fraud_add_new');
    Route::post('fraud/add_new', 'fraud_add_new_insert')->name('fraud_add_new_insert');
    Route::get('fraud/check', 'fraud_check_search')->name('fraud_check_search');
    Route::get('fraud/myentries', 'fraud_myentries')->name('fraud_myentries');
    Route::post('fraud/search', 'fraud_search')->name('fraud_search');
    Route::delete('/fraud/{id}', 'fraud_delete')->name('fraud_delete');
    Route::post('/delivery/search', 'search')->name('delivery');
    Route::post('/delivery/optionsearch', 'optionsearch')->name('optionsearch');
});


Route::controller(AdminController::class)->group(function () {
    Route::get('admin/dashboard', 'index')->name('admin.dashboard')->middleware('isLoggedIn');
    Route::get('admin/register', 'create')->name('admin.register');
    Route::post('admin/register', 'store')->name('admin.store');
    Route::get('admin/login', 'loginView')->name('admin.login')->middleware('alreadyLogin');
    Route::post('admin/login', 'loginCheck')->name('super.admin.login');
    Route::get('admin/table', 'table')->name('admin.table')->middleware('isLoggedIn');
    Route::post('admin/logout', 'logout')->name('admin.logout')->middleware('isLoggedIn');
    Route::get('admin/edit', 'adminEdit')->name('admin.edit')->middleware('isLoggedIn');
    Route::post('admin/update', 'adminUpdate')->name('admin.update')->middleware('isLoggedIn');
    Route::get('admin/change/password', 'changePassword')->name('admin.change.password')->middleware('isLoggedIn');
    Route::post('admin/update/password', 'updatePassword')->name('admin.update.password')->middleware('isLoggedIn');
    Route::get('admin/delete', 'adminDelete')->name('admin.delete')->middleware('isLoggedIn');
    Route::post('admin/delete', 'adminDeleteAccount')->name('admin.delete.account')->middleware('isLoggedIn');
    Route::post('admin/delivery/search', 'searchAdmin')->name('admin.search');
    Route::post('admin/delivery/calculatorSearch', 'calculatorSearch')->name('admin.calculatorSearch');
    Route::post('admin/delivery/searchDelivery', 'searchDeliveryman')->name('admin.searchDeliveryman');
    Route::post('admin/pickupman/search', 'searchPickup')->name('admin.searchPickup');
    Route::post('admin/merchant/search', 'searchMerchant')->name('admin.searchMerchant');
    Route::get('admin/destroy', 'adminDestroy')->name('admin.destroy')->middleware('isLoggedIn');
    Route::post('admin/admin/search', 'adminSearch')->name('admin.adminSearch');
    Route::get('admin/excel/export', 'adminExcelExport')->name('admin.excel.export')->middleware('isLoggedIn');
    Route::post('admin/excel/import', 'adminExcelImport')->name('admin.excel.import')->middleware('isLoggedIn');

    Route::get('admin/pickupman', 'pickupManTable')->name('admin.pickupman');
    Route::post('admin/pickupman/confirmation', 'pickupConfirmation')->name('admin.pickupman_confirmation')->middleware('isLoggedIn');
    Route::post('admin/pickupman/cancel/confirmation', 'pickupCancelConfirmation')->name('admin.pickupman_cancel_confirmation')->middleware('isLoggedIn');
    Route::get('admin/pickupman_destroy', 'pickupmanDestroy')->name('admin.pickupman_destroy')->middleware('isLoggedIn');
    Route::get('admin/pickupman/excel/export', 'pickupmanExcelExport')->name('admin.pickupman.excel.export')->middleware('isLoggedIn');
    Route::post('admin/pickupman/excel/import', 'pickupmanExcelImport')->name('admin.pickupman.excel.import')->middleware('isLoggedIn');

    Route::get('admin/deliveryman', 'deliveryManTable')->name('admin.deliveryman');
    Route::post('admin/deliveryman/confirmation', 'deliverymanConfirmation')->name('admin.deliveryman_confirmation')->middleware('isLoggedIn');
    Route::post('admin/deliveryman/cancel/confirmation', 'deliverymanCancelConfirmation')->name('admin.deliveryman_cancel_confirmation')->middleware('isLoggedIn');
    Route::get('admin/deliveryman_destroy', 'deliverymanDestroy')->name('admin.deliveryman_destroy');
    Route::get('admin/deliveryman/excel/export', 'deliverymanExcelExport')->name('admin.deliveryman.excel.export')->middleware('isLoggedIn');
    Route::post('admin/deliveryman/excel/import', 'deliverymanExcelImport')->name('admin.deliveryman.excel.import')->middleware('isLoggedIn');

    Route::get('admin/product/delivery', 'productTable')->name('admin.product.delivery')->middleware('isLoggedIn');
    Route::get('admin/product/delivery/edit', 'productEdit')->name('admin.product.delivery.edit')->middleware('isLoggedIn');
    Route::post('admin/product/delivery/edit', 'productUpdate')->name('admin.product.delivery.update')->middleware('isLoggedIn');
    Route::post('admin/product/delivery', 'productDeliveryConfirmation')->name('admin.product.delivery_confirmation')->middleware('isLoggedIn');
    Route::post('admin/product/checkout', 'productDeliveryCheckout')->name('admin.product.delivery_checkout')->middleware('isLoggedIn');
    Route::post('admin/product/delivered', 'productDeliveryDelivered')->name('admin.product.delivery_delivered')->middleware('isLoggedIn');
    Route::post('admin/product/cancel', 'productCancelConfirmation')->name('admin.product.cancel_confirmation')->middleware('isLoggedIn');
    Route::get('admin/product/delivery/delete', 'productDestroy')->name('admin.product.delivery.delete')->middleware('isLoggedIn');
    Route::post('admin/product/excel/import', 'productExcelImport')->name('admin.product.excel.import')->middleware('isLoggedIn');
    Route::get('admin/product/excel/export', 'productExcelExport')->name('admin.product.excel.export')->middleware('isLoggedIn');
});


Route::controller(MarchantController::class)->group(function () {
    Route::get('admin/merchant', 'index')->name('admin.merchant')->middleware('isLoggedIn');
    Route::get('admin/merchant/excel/export', 'merchantExcelExport')->name('admin.merchant.excel.export')->middleware('isLoggedIn');
    Route::get('/percel_delivery_charge', 'percel_delivery_charge')->name('percel_delivery_charge');
});

// Route::controller(AdminDeliveryController::class)->group(function(){
//     Route::get('admin/delivery', 'index')->name('admin.delivery')->middleware('isLoggedIn');
//     Route::get('admin/delivery/edit', 'edit')->name('admin.delivery.edit')->middleware('isLoggedIn');
//     Route::post('admin/delivery/edit', 'update')->name('admin.delivery.update')->middleware('isLoggedIn');
//     Route::post('admin/delivery', 'deliveryConfirmation')->name('admin.delivery_confirmation')->middleware('isLoggedIn');
//     Route::post('admin/checkout', 'deliveryCheckout')->name('admin.delivery_checkout')->middleware('isLoggedIn');
//     Route::post('admin/delivered', 'deliveryDelivered')->name('admin.delivery_delivered')->middleware('isLoggedIn');
//     Route::post('admin/cancel', 'cancelConfirmation')->name('admin.cancel_confirmation')->middleware('isLoggedIn');
//     Route::get('admin/delivery/delete', 'destroy')->name('admin.delivery.delete')->middleware('isLoggedIn');
// });

Route::controller(AdminDeliverychargeController::class)->group(function () {
    Route::get('admin/addDeliveryCharge', 'addDeliveryCharge')->name('addDeliveryCharge');
    Route::post('admin/addDeliveryCharge', 'storeDeliveryCharge')->name('storeDeliveryCharge');
    Route::post('/calculate_delivery_charge', 'calculate_delivery_charge')->name('calculate_delivery_charge');
    Route::post('/search-delivery', 'search')->name('search.delivery');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('merchant/delivery/search', 'search')->name('merchant.delivery.search');
    Route::get('admin/delivery/search', 'adminDeliverySearch')->name('admin.delivery.search');
});
Route::controller(AllConsignmentController::class)->group(function () {
    Route::get('merchant/all_consignment', 'all_consignment')->name('merchant.all_consignment');
    Route::get('merchant/list_byDate_all_consignment', 'list_byDate')->name('merchant.list_byDate');
    Route::get('merchant/pending_consignment', 'pending_consignment')->name('merchant.pending_consignment');
    Route::get('merchant/approval_pending_consignment', 'approval_pending_consignment')->name('merchant.approval_pending_consignment');
    Route::get('merchant/delivery_consignment', 'delivery_consignment')->name('merchant.delivery_consignment');
    Route::get('merchant/partly_delivery_consignment', 'partly_delivery_consignment')->name('merchant.partly_delivery_consignment');
    Route::get('merchant/cancel_consignment', 'cancel_consignment')->name('merchant.cancel_consignment');
    Route::get('merchant/inreview_consignment', 'inreview_consignment')->name('merchant.inreview_consignment');
    Route::get('merchant/latest_entries_consignment', 'latest_entries_consignment')->name('merchant.latest_entries_consignment');
    Route::get('merchant/pick_n_drop_consignment', 'pick_n_drop_consignment')->name('merchant.pick_n_drop_consignment');
});

Route::get('/chatbox', [BotManController::class, 'index']);
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);


Route::controller(DeliveryManController::class)->group(function () {
    Route::get('deliveryman/dashboard', 'index')->name('deliveryman.dashboard')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/register', 'create')->name('deliveryman.register')->middleware('deliverymanAlreadyLogin');
    Route::post('deliveryman/register', 'store')->name('deliveryman.store');
    Route::get('deliveryman/login', 'loginView')->name('deliveryman.login')->middleware('deliverymanAlreadyLogin');
    Route::post('deliveryman/login', 'loginCheck')->name('deliveryman.login.check');
    // Route::get('admin/table', 'table')->name('admin.table')->middleware('isLoggedIn');
    Route::post('deliveryman/logout', 'logout')->name('deliveryman.logout')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/edit', 'edit')->name('deliveryman.edit')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/update', 'deliverymanUpdate')->name('deliveryman.update')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/change/password', 'changePassword')->name('deliveryman.change.password')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/update/password', 'updatePassword')->name('deliveryman.update.password')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/delete', 'deliverymanDelete')->name('deliveryman.delete')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/delete', 'deliverymanDeleteAccount')->name('deliveryman.delete.account')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/product/table', 'productTable')->name('deliveryman.product.table')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/product/delivered', 'productDeliveryDelivered')->name('deliveryman.product.delivered')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/product/cancel', 'productDeliveryCancel')->name('deliveryman.product.cancel')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/product/return', 'productDeliveryReturn')->name('deliveryman.product.return')->middleware('deliverymanIsLoggedIn');
});


Route::controller(PickupManController::class)->group(function () {
    Route::get('pickupman/dashboard', 'index')->name('pickupman.dashboard')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/register', 'create')->name('pickupman.register')->middleware('pickupmanAlreadyLogin');
    Route::post('pickupman/register', 'store')->name('pickupman.store');
    Route::get('pickupman/login', 'loginView')->name('pickupman.login')->middleware('pickupmanAlreadyLogin');
    Route::post('pickupman/login', 'loginCheck')->name('pickupman.login.check');
    // Route::get('admin/table', 'table')->name('admin.table')->middleware('isLoggedIn');
    Route::post('pickupman/logout', 'logout')->name('pickupman.logout')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/edit', 'edit')->name('pickupman.edit')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/update', 'pickupmanUpdate')->name('pickupman.update')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/change/password', 'changePassword')->name('pickupman.change.password')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/update/password', 'updatePassword')->name('pickupman.update.password')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/delete', 'pickupmanDelete')->name('pickupman.delete')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/delete', 'pickupmanDeleteAccount')->name('pickupman.delete.account')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/product/table', 'productTable')->name('pickupman.product.table')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/product/delivery', 'productDeliveryConfirmation')->name('pickupman.product.delivery_confirmation')->middleware('pickupmanIsLoggedIn');
});



Route::get('lang', [LangController::class, 'lang']);
Route::get('lang/change', [LangController::class, 'lang_change'])->name('lang.change');


// require __DIR__ . '/admin.php';