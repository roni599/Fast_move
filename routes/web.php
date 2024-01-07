<?php

use App\Http\Controllers\Admin\CalculatorController;
use App\Http\Controllers\Marchant\DeliveryController;
use App\Http\Controllers\Client\Auth\AccountDeletionController;
use App\Http\Controllers\Client\Auth\PasswordController;
use App\Http\Controllers\Client\Auth\ProfileController;
use App\Http\Controllers\Marchant\MarchantDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DeliverychargeController as AdminDeliverychargeController;
use App\Http\Controllers\Admin\DeliveryController as AdminDeliveryController;
use App\Http\Controllers\Admin\MarchantController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\Client\ViewController;
use App\Http\Controllers\Marchant\AllConsignmentController;
use App\Http\Controllers\Marchant\FraudController as MarchantFraudController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


Route::controller(ViewController::class)->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('tracking', 'tracking')->name('tracking');
    Route::get('contact', 'contact')->name('contact');
    Route::get('service', 'service')->name('service');
    Route::get('about', 'about')->name('about');
    Route::get('/get-destinations', 'getDestinations');
    Route::get('/get-categories', 'getCategories');
});


Route::controller(AccountDeletionController::class)->group(function(){
    Route::get('account-delete', 'index')->name('account.delete');
    Route::post('account-delete', 'destroy');
});

Route::get('profile-update', [ProfileController::class, 'index'])->name('profile.update');
Route::get('password-change', [PasswordController::class, 'index'])->name('auth.password');


// ____Mrachant____
Route::resources([
    'deliverycharge' => CalculatorController::class,
    'delivery' => DeliveryController::class,
    'pickup' => PickupController::class,
]);

Route::controller(MarchantDashboardController::class)->group(function(){
    Route::get('dashboard', 'index')->name('dashboard');
    Route::get('merchant/coverage/area', 'coverageArea')->name('merchant.coverage.area');
    Route::get('merchant/pricing', 'pricing')->name('merchant.pricing');
    Route::post('marchant/delivery', 'deliveryConfirmation')->name('marchant.delivery_confirmation');
    Route::post('marchant/checkout', 'deliveryCheckout')->name('marchant.delivery_checkout');
    Route::post('marchant/cancel', 'cancelConfirmation')->name('marchant.cancel_confirmation');
});

Route::controller(MarchantFraudController::class)->group(function(){
    Route::get('/fraud_check','fraud_check')->name('fraud_check');
    Route::get('fraud/add_new','fraud_add_new')->name('fraud_add_new');
    Route::post('fraud/add_new','fraud_add_new_insert')->name('fraud_add_new_insert');
    Route::get('fraud/check','fraud_check_search')->name('fraud_check_search');
    Route::get('fraud/myentries','fraud_myentries')->name('fraud_myentries');
    Route::post('fraud/search','fraud_search')->name('fraud_search');
    Route::delete('/fraud/{id}', 'fraud_delete')->name('fraud_delete');
    Route::post('/delivery/search', 'search')->name('delivery');
    Route::post('/delivery/optionsearch', 'optionsearch')->name('optionsearch');


});


Route::controller(AdminController::class)->group(function(){
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
    Route::post('admin/pickup/confirmation', 'pickupConfirmation')->name('admin.pickup_confirmation')->middleware('isLoggedIn');
    Route::post('admin/pickup/cancel/confirmation', 'pickupCancelConfirmation')->name('admin.pickup_cancel_confirmation')->middleware('isLoggedIn');
    Route::post('admin/delivery/search', 'searchAdmin')->name('admin.search');
    Route::post('admin/pickupman/search', 'searchPickup')->name('admin.searchPickup');
    Route::post('admin/merchant/search', 'searchMerchant')->name('admin.searchMerchant');
    Route::get('admin/destroy', 'destroy')->name('admin.destroy')->middleware('isLoggedIn');
    Route::post('admin/admin/search', 'adminSearch')->name('admin.adminSearch');
});

Route::controller(MarchantController::class)->group(function(){
    Route::get('admin/marchant', 'index')->name('admin.marchant')->middleware('isLoggedIn');
});

Route::controller(AdminDeliveryController::class)->group(function(){
    Route::get('admin/delivery', 'index')->name('admin.delivery')->middleware('isLoggedIn');
    Route::get('admin/delivery/edit', 'edit')->name('admin.delivery.edit')->middleware('isLoggedIn');
    Route::post('admin/delivery/edit', 'update')->name('admin.delivery.update')->middleware('isLoggedIn');
    Route::post('admin/delivery', 'deliveryConfirmation')->name('admin.delivery_confirmation')->middleware('isLoggedIn');
    Route::post('admin/checkout', 'deliveryCheckout')->name('admin.delivery_checkout')->middleware('isLoggedIn');
    Route::post('admin/delivered', 'deliveryDelivered')->name('admin.delivery_delivered')->middleware('isLoggedIn');
    Route::post('admin/cancel', 'cancelConfirmation')->name('admin.cancel_confirmation')->middleware('isLoggedIn');
    Route::get('admin/delivery/delete', 'destroy')->name('admin.delivery.delete')->middleware('isLoggedIn');
});
Route::controller(AdminDeliverychargeController::class)->group(function(){
    Route::get('admin/addDeliveryCharge','addDeliveryCharge')->name('addDeliveryCharge');
    Route::post('admin/addDeliveryCharge','storeDeliveryCharge')->name('storeDeliveryCharge');
    Route::post('/calculate_delivery_charge', 'calculate_delivery_charge')->name('calculate_delivery_charge');
    Route::post('/search-delivery','search')->name('search.delivery');

});

Route::controller(SearchController::class)->group(function(){
    Route::get('merchant/delivery/search','search')->name('merchant.delivery.search');
    Route::get('admin/delivery/search','adminDeliverySearch')->name('admin.delivery.search');

});
Route::controller(AllConsignmentController::class)->group(function(){
    Route::get('merchant/all_consignment','all_consignment')->name('merchant.all_consignment');
    Route::get('merchant/list_byDate_all_consignment','list_byDate')->name('merchant.list_byDate');
    Route::get('merchant/pending_consignment','pending_consignment')->name('merchant.pending_consignment');
    Route::get('merchant/approval_pending_consignment','approval_pending_consignment')->name('merchant.approval_pending_consignment');
    Route::get('merchant/delivery_consignment','delivery_consignment')->name('merchant.delivery_consignment');
    Route::get('merchant/partly_delivery_consignment','partly_delivery_consignment')->name('merchant.partly_delivery_consignment');
    Route::get('merchant/cancel_consignment','cancel_consignment')->name('merchant.cancel_consignment');
    Route::get('merchant/inreview_consignment','inreview_consignment')->name('merchant.inreview_consignment');
    Route::get('merchant/latest_entries_consignment','latest_entries_consignment')->name('merchant.latest_entries_consignment');
    Route::get('merchant/pick_n_drop_consignment','pick_n_drop_consignment')->name('merchant.pick_n_drop_consignment');

});

Route::get('/chatbox', [BotManController::class, 'index']);
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);






// require __DIR__ . '/admin.php';