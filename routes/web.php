<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\updateSiteDataImages;
use App\Http\Controllers\web\adminOrderController;
use App\Http\Controllers\web\estimationWork;
use App\Http\Controllers\web\OrderController;
use App\Http\Controllers\web\requisitionController;
use App\Http\Controllers\web\scrapController;
use App\Http\Controllers\web\siteDateCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Gd\Commands\RotateCommand;
use App\Http\Controllers\web\CsuAeroSpendController;
use App\Http\Controllers\web\CsuBudgetTNBController;
use App\Http\Controllers\web\RmuAeroSpendController;
use App\Http\Controllers\web\RmuBudgetTNBController;
use App\Http\Controllers\web\VcbAeroSpendController;
use App\Http\Controllers\web\VcbBudgetTNBController;
use App\Http\Controllers\web\RmuPaymentDetailController;
use App\Http\Controllers\web\VcbPaymentDetailController;
use App\Http\Controllers\web\CsuPaymentDetailController;
use App\Http\Controllers\web\PaymentSummaryController;
use App\Http\Controllers\web\FilterPaymentSummaryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;











/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-auth', [AuthenticatedSessionController::class, 'check']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


  

    Route::resource('site-data-collection', siteDateCollection::class);
    Route::resource('update-site-data-images', updateSiteDataImages::class);
    Route::resource('estimation-work', estimationWork::class);
    Route::post('update-site-data-images/{id}/edit/{status}', [updateSiteDataImages::class, 'edit']);

    Route::resource('requisition',requisitionController::class);
    Route::get('/get-type/{item}',[requisitionController::class,'getType']);

    Route::resource('order',OrderController::class);
    Route::get('admin-orders',[adminOrderController::class,'index'])->name('admin-order.index');
    Route::get('/order/{id}/{con}',[adminOrderController::class,'completeOrder']);
    Route::get('/complete-orders',[adminOrderController::class,'getCOmpleteOrders']);
    Route::get('/cancel-orders',[adminOrderController::class,'getCancelOrders']);

    Route::resource('scrap',scrapController::class);

    Route::resource('csu-payment-details', CsuPaymentDetailController::class);


    Route::resource('csu-aero-spend', CsuAeroSpendController::class,['except' => ['create','index']]);
    Route::get('csu-aero-spend/create/{id}/{pe_name}', [CsuAeroSpendController::class, 'create'])->name('csu-aero-spend.create');
    Route::get('csu-aero-spend/index/{id}', [CsuAeroSpendController::class, 'index'])->name('csu-aero-spend.index');


    Route::resource('csu-budget-tnb', CsuBudgetTNBController::class,['except' => ['index' , 'create']]);
    Route::get('csu-budget-tnb/index/{name}', [CsuBudgetTNBController::class, 'index'])->name('csu-budget-tnb.index');
    Route::get('csu-budget-tnb/create/{name}', [CsuBudgetTNBController::class, 'create'])->name('csu-budget-tnb.create');



    Route::resource('rmu-payment-details', RmuPaymentDetailController::class);

    Route::get('paymentviewdetail', [RmuPaymentDetailController::class, 'Paymentview'])->name('paymentviewdetail.Paymentview');
    Route::get('updatepayment/{id}/{rmu_id}/{pmt_type}', [RmuPaymentDetailController::class, 'UpdatePayment'])->name('paymentdetail.updatepayment');




    Route::resource('rmu-aero-spend', RmuAeroSpendController::class,['except' => ['create','index']]);
    Route::get('rmu-aero-spend/create/{id}/{pe_name}', [RmuAeroSpendController::class, 'create'])->name('rmu-aero-spend.create');
    Route::get('rmu-aero-spend/index/{id}', [RmuAeroSpendController::class, 'index'])->name('rmu-aero-spend.index');



    Route::get('/rmu-budget-tnb/budgets', [RmuBudgetTNBController::class, 'listBudgets'])->name('rmu-budget-tnb.budgets');
    
    Route::resource('rmu-budget-tnb', RmuBudgetTNBController::class,['except' => ['index' , 'create']]);

    Route::get('rmu-budget-tnb/index/{id}', [RmuBudgetTNBController::class, 'index'])->name('rmu-budget-tnb.index');
    Route::get('rmu-budget-tnb/create/{name}', [RmuBudgetTNBController::class, 'create'])->name('rmu-budget-tnb.create');


    Route::resource('vcb-payment-details', VcbPaymentDetailController::class);

    Route::resource('vcb-aero-spend', VcbAeroSpendController::class,['except' => ['create','index']]);
    Route::get('vcb-aero-spend/create/{id}/{pe_name}', [VcbAeroSpendController::class, 'create'])->name('vcb-aero-spend.create');
    Route::get('vcb-aero-spend/index/{id}', [VcbAeroSpendController::class, 'index'])->name('vcb-aero-spend.index');



    Route::resource('vcb-budget-tnb', VcbBudgetTNBController::class,['except' => ['create','index']]);

    Route::get('vcb-budget-tnb/index/{name}', [VcbBudgetTNBController::class, 'index'])->name('vcb-budget-tnb.index');
    Route::get('vcb-budget-tnb/create/{name}', [VcbBudgetTNBController::class, 'create'])->name('vcb-budget-tnb.create');

    Route::resource('payment-summary-details', PaymentSummaryController::class);
    Route::get('payment-summary-detail', [PaymentSummaryController::class, 'paymentSummary'])->name('payment-summary-detail');

    Route::post('payment-summary-search', [FilterPaymentSummaryController::class, 'paymentSummary'])->name('payment-summary-search');





});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {

    return Auth::user()->type  ? Redirect::route('site-data-collection.index'):Redirect::route('admin-order.index') ;

})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');