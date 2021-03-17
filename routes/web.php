<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Resource_categoryController;
use App\Http\Controllers\Resource_typeController;
use App\Http\Controllers\Resource_creatorController;
use App\Http\Controllers\Resource_dd_classController;
use App\Http\Controllers\Resource_dd_devisionController;
use App\Http\Controllers\Resource_dd_sectionController;
use App\Http\Controllers\Resource_donateController;
use App\Http\Controllers\Resource_langController;
use App\Http\Controllers\Resource_PublisherController;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ThemeController;

use App\Http\Controllers\BookController;



Auth::routes();

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('lmslogin', LoginController::class);

  
Route::get('test', [UserController::class, 'index'])->name('users.index');
Route::get('test_dt', [UserController::class, 'index1'])->name('users.index1');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    
    // --------Resource--------------------------------
    Route::resource('resource', ResourceController::class);
    Route::get('load_resource_dd_class', [Resource_dd_devisionController::class, 'ddclass'])->name('load_resource_dd_class');
    Route::post('load_resource_dd_devision', [Resource_dd_sectionController::class, 'dddevision'])->name('load_resource_dd_devision');
    Route::post('load_resource_type', [ResourceController::class, 'load_type'])->name('load_resource_type');
    Route::get('filter_by_type/{id}', [ResourceController::class, 'filter_by_type'])->name('filter_by_type');
    Route::get('filter_by_category', [ResourceController::class, 'filter_by_category'])->name('filter_by_category');
    Route::post('import_resource', [ResourceController::class, 'import'])->name('import_resource');
    Route::get('create_resource', [ResourceController::class, 'create'])->name('create_resource');
    Route::get('update_resource/{id}', [ResourceController::class, 'edit'])->name('update_resource');
    Route::get('show_resource/{id}', [ResourceController::class, 'show'])->name('show_resource');

    // --------Resource support/category--------------------------------
    Route::resource('resource_catagory', Resource_categoryController::class);
    Route::post('update_resource_cat', [Resource_categoryController::class, 'update_detail'])->name('update_resource_cat');
    Route::post('delete_resource_cat', [Resource_categoryController::class, 'delete'])->name('delete_resource_cat');
    Route::post('import_resource_cat', [Resource_categoryController::class, 'import'])->name('import_resource_cat');
    

     // --------Resource support/type--------------------------------
     Route::resource('resource_type', Resource_typeController::class);
     Route::post('show_resource_type', [Resource_typeController::class, 'show_detail'])->name('show_resource_type');
     Route::post('update_resource_type', [Resource_typeController::class, 'update_detail'])->name('update_resource_type');
     Route::post('edit_resource_type', [Resource_typeController::class, 'edit_detail'])->name('edit_resource_type');
     Route::post('delete_resource_type', [Resource_typeController::class, 'delete'])->name('delete_resource_type');
     Route::post('import_resource_type', [Resource_typeController::class, 'import'])->name('import_resource_type');
     Route::get('load_resource_category', [Resource_typeController::class, 'category'])->name('load_resource_category');

      // --------Resource support/dd_class--------------------------------
    Route::resource('resource_dd_class', Resource_dd_classController::class);
    Route::post('update_resource_dd_class', [Resource_dd_classController::class, 'update_detail'])->name('update_resource_dd_class');
    Route::post('delete_resource_dd_class', [Resource_dd_classController::class, 'delete'])->name('delete_resource_dd_class');
    Route::post('import_resource_dd_class', [Resource_dd_classController::class, 'import'])->name('import_resource_dd_class');

    // --------Resource support/dd_devision--------------------------------
    Route::resource('resource_dd_devision', Resource_dd_devisionController::class);
    Route::post('show_resource_dd_devision', [Resource_dd_devisionController::class, 'show_detail'])->name('show_resource_dd_devision');
    Route::post('update_resource_dd_devision', [Resource_dd_devisionController::class, 'update_detail'])->name('update_resource_dd_devision');
    Route::post('edit_resource_dd_devision', [Resource_dd_devisionController::class, 'edit_detail'])->name('edit_resource_dd_devision');
    Route::post('delete_resource_dd_devision', [Resource_dd_devisionController::class, 'delete'])->name('delete_resource_dd_devision');
    Route::post('import_resource_dd_devision', [Resource_dd_devisionController::class, 'import'])->name('import_resource_dd_devision');
    

     // --------Resource support/dd_section--------------------------------
     Route::resource('resource_dd_section', Resource_dd_sectionController::class);
     Route::post('show_resource_dd_section', [Resource_dd_sectionController::class, 'show_detail'])->name('show_resource_dd_section');
     Route::post('update_resource_dd_section', [Resource_dd_sectionController::class, 'update_detail'])->name('update_resource_dd_section');
     Route::post('edit_resource_dd_section', [Resource_dd_sectionController::class, 'edit_detail'])->name('edit_resource_dd_section');
     Route::post('delete_resource_dd_section', [Resource_dd_sectionController::class, 'delete'])->name('delete_resource_dd_section');
     Route::post('import_resource_dd_section', [Resource_dd_sectionController::class, 'import'])->name('import_resource_dd_section');
    
     // --------Resource support/creator--------------------------------
    Route::resource('resource_creator', Resource_creatorController::class);
    Route::post('update_resource_creator', [Resource_creatorController::class, 'update_detail'])->name('update_resource_creator');
    Route::post('delete_resource_creator', [Resource_creatorController::class, 'delete'])->name('delete_resource_creator');
    Route::post('import_resource_creator', [Resource_creatorController::class, 'import'])->name('import_resource_creator');

    // --------Resource support/publisher--------------------------------
    Route::resource('resource_publisher', Resource_PublisherController::class);
    Route::post('update_resource_publisher', [Resource_PublisherController::class, 'update_detail'])->name('update_resource_publisher');
    Route::post('delete_resource_publisher', [Resource_PublisherController::class, 'delete'])->name('delete_resource_publisher');
    Route::post('import_resource_publisher', [Resource_PublisherController::class, 'import'])->name('import_resource_publisher');

    // --------Resource support/language--------------------------------
    Route::resource('resource_language', Resource_langController::class);
    Route::post('update_resource_language', [Resource_langController::class, 'update_detail'])->name('update_resource_language');
    Route::post('delete_resource_language', [Resource_langController::class, 'delete'])->name('delete_resource_language');
    Route::post('import_resource_language', [Resource_langController::class, 'import'])->name('import_resource_language');

    // --------Resource support/Donate--------------------------------
    Route::resource('resource_dd_donate', Resource_donateController::class);

   // ----------------------Issue-------------------------------------
   Route::resource('issue', IssueController::class);
   Route::post('member_view', [IssueController::class, 'memberview'])->name('member_view');
   Route::post('resource_view', [IssueController::class, 'resourceview'])->name('resource_view');
   Route::post('store_issue', [IssueController::class, 'store_issue'])->name('store_issue');
   Route::get('/issue_riceipt/{id}', [IssueController::class, 'issue_receipt'])->name('issue_riceipt');

   // ----------------------Return-------------------------------------
   Route::resource('return', ReturnController::class);
   Route::post('get_lending', [ReturnController::class, 'get_lending'])->name('get_lending');
   Route::post('extend_lending', [ReturnController::class, 'extend_lending'])->name('extend_lending');
   Route::post('store_return', [ReturnController::class, 'store_return'])->name('store_return');
   Route::post('settle_fine', [ReturnController::class, 'settle_fine'])->name('settle_fine');
   Route::post('fine_receipt', [ReturnController::class, 'fine_receipt'])->name('fine_receipt');
   Route::get('/return_riceipt/{id}', [ReturnController::class, 'return_riceipt'])->name('return_riceipt');



    // --------Book--------------------------------
    Route::resource('books', BookController::class);
    Route::get('update_book_view/{id}', [BookController::class, 'edit'])->name('update_book_view');
    Route::post('delete_book', [BookController::class, 'delete'])->name('delete_book');
    // --------Code--------------------------------
    Route::resource('codes', CodeController::class);
    Route::get('importExportView', [CodeController::class, 'importExportView']);
    Route::get('export', [CodeController::class, 'export'])->name('export');
    Route::post('import', [CodeController::class, 'import'])->name('import');
    Route::get('barcodeview', [CodeController::class, 'barcodeview'])->name('barcodeview');
    Route::get('Barcoderange', [CodeController::class, 'barcoderange'])->name('Barcoderange');
    Route::post('generate-Codepdf', [CodeController::class, 'generateCodePDF'])->name('generateCodePDF');
    Route::post('CodeRangepdf', [CodeController::class, 'CodeRangepdf'])->name('CodeRangepdf');
    Route::get('generate_pdf', [CodeController::class, 'generate_pdf'])->name('generate_pdf');

    //--------Member----------------------------------
    Route::resource('members', MemberController::class);
    Route::post('store_member', [MemberController::class, 'store'])->name('store_member');
    Route::get('create_member', [MemberController::class, 'create'])->name('create_member');

    //--------Survey----------------------------------
    Route::resource('survey', SurveyController::class);
    Route::post('store_survey', [SurveyController::class, 'store'])->name('store_survey');
    Route::post('create_survey', [SurveyController::class, 'create'])->name('create_survey');
    Route::post('check_survey', [SurveyController::class, 'check_survey'])->name('check_survey');
    Route::post('uncheck_survey', [SurveyController::class, 'uncheck_survey'])->name('uncheck_survey');
    Route::post('finalize_survey', [SurveyController::class, 'finalize_survey'])->name('finalize_survey');
    Route::get('view_survey/{id}', [SurveyController::class, 'view_survey'])->name('view_survey');
    Route::get('survey_history/{id}', [SurveyController::class, 'survey_history'])->name('survey_history');
    Route::post('delete_survey', [SurveyController::class, 'delete'])->name('delete_survey');

    // -------configer--------------------------------
    Route::resource('config', ConfigController::class);

    // -------Setting- Theme--------------------------
    Route::resource('theme', ThemeController::class);
    Route::post('update_theme', [ThemeController::class, 'update_theme'])->name('update_theme');
    Route::get('change_theme/{id}', [ThemeController::class, 'change_theme'])->name('change_theme');

});

Route::get('/sms', [SoapController::class, 'msg_test'])->name('msg_test');

// -----config---------------------------
Route::post('create_lib', [ConfigController::class, 'store_library'])->name('create_lib');
// Route::post('create_center', [ConfigController::class, 'store_center'])->name('create_center');
Route::post('create_staff', [ConfigController::class, 'store_staff'])->name('create_staff');
Route::post('create_user', [ConfigController::class, 'store_user'])->name('create_user');

