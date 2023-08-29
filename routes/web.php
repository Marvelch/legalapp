<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LegalEntityController;
use App\Http\Controllers\LicensingController;
use App\Http\Controllers\MailServerController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UsersController;
use App\Models\LegalEntity;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/unauthorized', function() {
     return view('401');
})->name('home');

Route::group(['prefix' => 'user','middleware' => ['auth', 'user-access:admin']], function(){
    Route::get('/',[UsersController::class,'index'])->name('index_user');
    Route::get('/user-data',[UsersController::class,'userTable'])->name('table_user');
    Route::get('/create',[UsersController::class,'create'])->name('create_user');
    Route::get('/delete/{id}',[UsersController::class,'destroy'])->name('destroy_user');
    Route::get('/edit/{id}',[UsersController::class,'edit'])->name('edit_user');
    Route::post('/store',[UsersController::class,'store'])->name('store_user');
    Route::put('/update/{id}',[UsersController::class,'update'])->name('update_user');
});


Route::group(['prefix' => 'mail','middleware' => ['auth']], function(){
    Route::get('/',[MailServerController::class,'index'])->name('index_mail');
    Route::get('/tamplate',[MailServerController::class,'tamplate'])->name('index_tamplate');
    Route::get('/send-mail',[MailServerController::class,'sendMail'])->name('send_mail');
    Route::get('/delete/{id}',[LegalEntityController::class,'destroy'])->name('destroy_legal');
    Route::get('/create',[MailServerController::class,'create'])->name('create_mail');
    Route::get('/edit/{id}',[LegalEntityController::class,'edit'])->name('edit_legal');
    Route::get('/show/{id}',[MailServerController::class,'show'])->name('show_legal');
    Route::post('/store',[MailServerController::class,'store'])->name('store_mail');
    // Route::put('/update/{id}',[LegalEntityController::class,'update'])->name('update_legal');
    Route::get('/update-mail-default/{id}',[MailServerController::class,'updateMailDefault'])->name('update_mail_mail');
    Route::get('/mail-data',[MailServerController::class,'mailTable'])->name('table_mail');
});

Route::group(['prefix' => 'legal','middleware' => ['auth']], function(){
    Route::get('/',[LegalEntityController::class,'index'])->name('index_legal');
    Route::get('/legal-data',[LegalEntityController::class,'legalTable'])->name('table_legal');
    Route::get('/delete/{id}',[LegalEntityController::class,'destroy'])->name('destroy_legal');
    Route::get('/create',[LegalEntityController::class,'create'])->name('create_legal');
    Route::get('/edit/{id}',[LegalEntityController::class,'edit'])->name('edit_legal');
    Route::get('/show/{id}',[LegalEntityController::class,'show'])->name('show_legal');
    Route::post('/store',[LegalEntityController::class,'store'])->name('store_legal');
    Route::put('/update/{id}',[LegalEntityController::class,'update'])->name('update_legal');
});

Route::group(['prefix' => 'publisher','middleware' => ['auth']], function(){
    Route::get('/',[PublisherController::class,'index'])->name('index_publisher');
    Route::get('/create',[PublisherController::class,'create'])->name('create_publisher');
    Route::get('/edit/{id}',[PublisherController::class,'edit'])->name('edit_publisher');
    Route::post('/store',[PublisherController::class,'store'])->name('store_publisher');
    Route::put('/update/{id}',[PublisherController::class,'update'])->name('update_publisher');
    Route::get('/publisher-data',[PublisherController::class,'publisherTable'])->name('table_publisher');
    Route::get('/delete/{id}',[PublisherController::class,'destroy'])->name('destroy_publisher');
});

Route::group(['prefix' => 'company','middleware' => ['auth']], function(){
    Route::get('/',[CompanyController::class,'index'])->name('index_company');
    Route::get('/create',[CompanyController::class,'create'])->name('create_company');
    Route::get('/edit/{id}',[CompanyController::class,'edit'])->name('edit_company');
    Route::get('/show/{id}',[CompanyController::class,'show'])->name('show_company');
    Route::post('/store',[CompanyController::class,'store'])->name('store_company');
    Route::put('/update/{id}',[CompanyController::class,'update'])->name('update_company');
    Route::get('/company-data',[CompanyController::class,'companyTable'])->name('table_company');
    Route::get('/delete/{id}',[CompanyController::class,'destroy'])->name('destroy_company');
});

Route::group(['prefix' => 'licensing','middleware' => ['auth']], function(){
    Route::get('/',[LicensingController::class,'index'])->name('index_licensing');
    Route::get('/create',[LicensingController::class,'create'])->name('create_licensing');
    Route::get('/edit/{id}',[LicensingController::class,'edit'])->name('edit_licensing');
    Route::get('/show/{id}',[LicensingController::class,'show'])->name('show_licensing');
    Route::get('/download/{id}',[LicensingController::class,'download'])->name('download_licensing');
    Route::post('/store',[LicensingController::class,'store'])->name('store_licensing');
    Route::put('/update/{id}',[LicensingController::class,'update'])->name('update_licensing');
    Route::get('/licensing-data',[LicensingController::class,'licensingTable'])->name('table_licensing');
    Route::get('/delete/{id}',[LicensingController::class,'destroy'])->name('destroy_licensing');

    Route::get('/search',[LicensingController::class,'searching'])->name('searching_licensing');
    Route::get('/search-publisher',[LicensingController::class,'SearchingPublisher'])->name('searching_publisher_licensing');
});


Route::group(['prefix' => 'agreement','middleware' => ['auth']], function(){
    Route::get('/',[AgreementController::class,'index'])->name('index_agreement');
    Route::get('/create',[AgreementController::class,'create'])->name('create_agreement');
    Route::get('/edit/{id}',[AgreementController::class,'edit'])->name('edit_agreement');
    Route::get('/show/{id}',[AgreementController::class,'show'])->name('show_agreement');
    Route::get('/download/{id}',[AgreementController::class,'download'])->name('download_agreement');
    Route::post('/store',[AgreementController::class,'store'])->name('store_agreement');
    Route::put('/update/{id}',[AgreementController::class,'update'])->name('update_agreement');
    Route::get('/agreement-data',[AgreementController::class,'agreementTable'])->name('table_agreement');
    Route::get('/delete/{id}',[AgreementController::class,'destroy'])->name('destroy_agreement');

    Route::get('/search-company',[AgreementController::class,'searchingCompany'])->name('searching_company');
});
