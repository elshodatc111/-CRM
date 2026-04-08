<?php

use App\Http\Controllers\GroupDavomadController;
use App\Http\Controllers\SettingSalaryController;
use App\Http\Controllers\TKunController;
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
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/profile', [AuthController::class, 'passwordUpdate'])->name('password_update');
        Route::middleware(['role:superadmin,direktor,admin'])->prefix('admin')->group(function () {
            # Home
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::post('/davomad', [HomeController::class, 'hodimDavomad'])->name('hodim_davomad');
            Route::post('/hisobot', [HomeController::class, 'groupHisobot'])->name('hodim_hisobot');
            Route::post('/tadbirlar', [HomeController::class, 'groupTadbirlar'])->name('hodim_tadbirlar');
            Route::post('/shikoyat', [HomeController::class, 'groupShikoyat'])->name('hodim_shikoyat');
            # TKUN
            Route::get('/tkun', [TKunController::class, 'index'])->name('tkun');
            # Hodimlar
            Route::get('/empoes', [EmploesController::class, 'index'])->name('emploes_index');
            Route::get('/emploes/{id}', [EmploesController::class, 'show'])->name('emploes_show');
            Route::post('/emploes', [EmploesController::class, 'store'])->name('emploes_store');
            Route::post('/emploes/update', [EmploesController::class, 'update'])->name('emploes_update');
            Route::post('/emploes/update/password', [EmploesController::class, 'update_password'])->name('emploes_update_password');
            Route::post('/payments', [EmploesController::class, 'storePayments'])->name('user_store_payment');
            // Ish haqini hisoblash
            Route::post('/calc/emploes', [EmploesController::class, 'calcEmploesAndExport'])->name('user_emploes_calc');
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
            Route::post('/groups/davomad',[GroupController::class, 'groupdavomad'])->name('groups_davomadi');
            # Group Davomad
            Route::get('/davomad/groups',[GroupDavomadController::class, 'davomad'])->name('groups_davomad');
            Route::get('/davomad/groups/show/{id}',[GroupDavomadController::class, 'davomadShow'])->name('groups_davomad_show');
            Route::post('/davomad/groups/store',[GroupDavomadController::class, 'davomadStore'])->name('groups_davomad_store');
            # Kassa
            Route::get('/kassa',[KassaController::class, 'index'])->name('kassa_index');
            Route::post('/kassa/out',[KassaController::class, 'kassaToBalans'])->name('kassa_out');
            Route::post('/kassa/cost',[KassaController::class, 'kassaToCost'])->name('kassa_cost');
            Route::post('/kassa/success',[KassaController::class, 'successKassa'])->name('kassa_success');
            Route::post('/kassa/cancel',[KassaController::class, 'cancelKassa'])->name('kassa_cancel');
            #Moliya
            Route::get('/moliya',[BalansController::class, 'index'])->name('moliya_index');
            Route::post('/moliya/sunsedya',[BalansController::class, 'subsedyaToBalans'])->name('moliya_sunsedya');
            Route::post('/moliya/balansToKassa',[BalansController::class, 'balansToKassa'])->name('moliya_balans_to_kassa');
            Route::post('/moliya/balansDaromad',[BalansController::class, 'daromad'])->name('moliya_balans_daromad');
            Route::post('/moliya/balansXarajat',[BalansController::class, 'xarajat'])->name('moliya_balans_xarajat');
            # SETTING
            Route::get('/setting/salary',[SettingSalaryController::class, 'salary'])->name('setting_salary');
            Route::post('/setting/salary/tarbiyachi',[SettingSalaryController::class, 'tarbiyachi'])->name('setting_salary_terbiyachi');
            Route::post('/setting/salary/kichiktarbiyachi',[SettingSalaryController::class, 'kichik_tarbiyachi'])->name('setting_salary_terbiyachikichik');
            Route::post('/setting/salary/yordamchi',[SettingSalaryController::class, 'yordamchi'])->name('setting_salary_yordamchi');
            Route::post('/setting/salary/yordamchi/kichik',[SettingSalaryController::class, 'kichik_yordamchi'])->name('setting_salary_yordamchi_kichik');
            Route::post('/setting/salary/oshpaz',[SettingSalaryController::class, 'oshpaz'])->name('setting_salary_oshpaz');
            Route::post('/setting/salary/admin',[SettingSalaryController::class, 'admin'])->name('setting_salary_admin');

        });
        
    });
});