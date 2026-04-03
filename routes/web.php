<?php

use App\Http\Controllers\web\{AuthController, BalansController, ChildController, ChildLeadController, ChildPaymentController, HomeController, EmploesController, EmploesLeadController, GroupController, KassaController};
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {
    // Login sahifasi (Faqat mehmonlar uchun ochiq)
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login_post')->middleware('guest');
    
    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::middleware(['role:superadmin,direktor,admin'])->prefix('admin')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            # Hodimlar
            Route::get('/empoes', [EmploesController::class, 'index'])->name('emploes_index');
            Route::get('/emploes/{id}', [EmploesController::class, 'show'])->name('emploes_show');
            Route::post('/emploes', [EmploesController::class, 'store'])->name('emploes_store');
            # Hodimlarga kelgan leadlar
            Route::get('/empoesLead', [EmploesLeadController::class, 'index'])->name('emploesLead_index');
            Route::get('/emploesLead/{id}', [EmploesLeadController::class, 'show'])->name('emploesLead_show');
            Route::post('/emploesLead', [EmploesLeadController::class, 'store'])->name('emploesLead_store');
            Route::post('/emploesLead/success', [EmploesLeadController::class, 'success'])->name('emploesLead_success');
            Route::post('/emploesLead/note', [EmploesLeadController::class, 'note'])->name('emploesLead_note');
            Route::post('/emploesLead/cancel', [EmploesLeadController::class, 'cancel'])->name('emploesLead_cancel');
            # Bolalar
            Route::get('/child', [ChildController::class, 'index'])->name('child_index');
            Route::get('/child/{id}', [ChildController::class, 'show'])->name('child_show');
            Route::post('/child/update', [ChildController::class, 'update'])->name('child_update');
            Route::post('/child/add_group', [ChildController::class, 'add_group'])->name('child_add_group');
            
            Route::post('/child/payment', [ChildPaymentController::class, 'payment'])->name('child_payment');
            Route::post('/child/descount', [ChildPaymentController::class, 'descount'])->name('child_descount');
            Route::post('/child/return', [ChildPaymentController::class, 'return'])->name('child_return');
            # Bolalardan kelgan leadlar
            Route::get('/childLead', [ChildLeadController::class, 'index'])->name('childLead_index');
            Route::get('/childLead/{id}', [ChildLeadController::class, 'show'])->name('childLead_show');
            Route::post('/childLead/store', [ChildLeadController::class, 'store'])->name('childLead_store');
            Route::post('/childLead/cancel', [ChildLeadController::class, 'cancel'])->name('childLead_cancel');
            Route::post('/childLead/note',[ChildLeadController::class, 'note'])->name('childLead_store_node');
            Route::post('/childLead/success',[ChildLeadController::class, 'success'])->name('childLead_success');
            # Guruhlar
            Route::get('/groups',[GroupController::class, 'index'])->name('groups_index');
            Route::get('/groups/{id}',[GroupController::class, 'show'])->name('groups_show');            
            Route::post('/groups/create',[GroupController::class, 'store'])->name('groups_store');
            Route::post('/groups/create/user',[GroupController::class, 'storeUser'])->name('groups_store_user');
            Route::post('/groups/delete/user',[GroupController::class, 'deleteUser'])->name('groups_delete_user');
            Route::post('/groups/update',[GroupController::class, 'updateUpdate'])->name('groups_update');
            Route::post('/groups/delete',[GroupController::class, 'deleteGroup'])->name('groups_delete');
            Route::post('/groups/delete/child',[GroupController::class, 'deleteChild'])->name('groups_delete_child');
            # Kassa
            Route::get('/kassa',[KassaController::class, 'index'])->name('kassa_index');
            Route::post('/kassa/out',[KassaController::class, 'kassaToBalans'])->name('kassa_out');
            Route::post('/kassa/cost',[KassaController::class, 'kassaToCost'])->name('kassa_cost');
            Route::post('/kassa/success',[KassaController::class, 'successKassa'])->name('kassa_success');
            Route::post('/kassa/cancel',[KassaController::class, 'cancelKassa'])->name('kassa_cancel');
            #Moliya
            Route::get('/moliya',[BalansController::class, 'index'])->name('moliya_index');
        });
        
    });
});