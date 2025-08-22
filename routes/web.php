<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/',[AdminController::class , 'index' ]  )->name('index');

Route::get('/dashboard',[userController::class , 'check']
 )->middleware(['auth', 'verified'])->name('dashboard');


 Route::get('/MyOrders',[userController::class , 'MyOrders2']
 )->middleware(['auth', 'verified'])->name('MyOrders');



Route::controller(userController::class)->middleware(['auth', 'verified'])->group(function(){

    Route::get('stripe/{price}', 'stripe')->name('stripe');
    Route::get('stripe/{price}', 'stripe2')->name('stripe2');
    Route::post('stripe', 'stripePost')->name('stripe.post');

});




Route::get('/Card/{id}',[userController::class , 'addCard']
 )->middleware(['auth', 'verified'])->name('addCard');

//  Route::post('/confirmOrder',[userController::class , 'confirmOrder']
//  )->middleware(['auth', 'verified'])->name('confirmOrder');


  Route::post('/confirmOrders',[userController::class , 'confirmOrderAll'])->name('confirmOrder');




 Route::get('allProduct2',[AdminController::class , 'allProduct'] )->name('allPrd');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('admin')->group(function(){
    Route::get('test.admin', [AdminController::class , 'test_admin'])->name('test.admin');
});
Route::middleware(['auth','admin'])->group(function(){
Route::get('/Add_Category',[AdminController::class , 'AddCtg'])->name('admin.addCategory');
Route::post('store_Ctg',[AdminController::class , 'store_category'])->name('admin.StoreCAtegory');
Route::get('/View_Category',[AdminController::class , 'view_ctg'])->name('admin.viewCategory');
Route::get('/delete_Category/{id}',[AdminController::class , 'destroy_ctg'])->name('admin.deleteCtg');
Route::get('/updateCtg/{id}',[AdminController::class , 'update_category'])->name('admin.updateCtg');
Route::post('admin.storeUpdate',[AdminController::class , 'storeUpdate'])->name('admin.storeUpdate');

// product
Route::get('/Add_product',[AdminController::class , 'AddPrd'])->name('admin.addProduct');
Route::post('StoreProduct',[AdminController::class , 'store_product'])->name('admin.StoreProduct');
Route::get('/view_product',[AdminController::class , 'ViewPrd'])->name('admin.view_product');
Route::get('/deletePrd/{id}',[AdminController::class , 'DeletePrd'])->name('admin.deletePrd');
Route::get('/updatePrd/{id}',[AdminController::class , 'updatePrd'])->name('admin.updatePrd');
Route::post('StoreUpdateProduct/{id}',[AdminController::class , 'StoreUpdateProduct'])->name('admin.StoreUpdateProduct');
Route::any('search_Prd',[AdminController::class , 'search_Prd'])->name('search_Prd');
Route::get('/AllOrders',[AdminController::class , 'AllOrders'])->name('AllOrders');
Route::get('/RejectOrder/{id}',[AdminController::class , 'deleteOrder'])->name('admin.deleteOrder');
Route::get('/admin.acceptOrder/{id}',[AdminController::class , 'acceptOrder'])->name('admin.acceptOrder');

Route::get('/downloadPdf/{id}',[AdminController::class , 'downloadPdf'])->name('downloadPdf');



});
Route::get('/details/{id}',[AdminController::class , 'details'])->name('details');
Route::get('/showCatrs',[userController::class , 'showCatrs'])->name('showCatrs');
Route::get('/User.deleteOrder/{id}',[userController::class , 'deleteOrder'])->name('User.deleteOrder');

require __DIR__.'/auth.php';

