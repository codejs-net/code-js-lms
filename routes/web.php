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


use App\Http\Controllers\BookController;
use App\Http\Controllers\Book_DDController;
use App\Http\Controllers\Book_langController;
use App\Http\Controllers\Book_MediumController;
use App\Http\Controllers\Book_PublisherController;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConfigController;



Auth::routes();

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/lms', [LoginController::class, 'index'])->name('lms');

  
Route::get('test', [UserController::class, 'index'])->name('users.index');
Route::get('test_dt', [UserController::class, 'index1'])->name('users.index1');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    
    // --------Resource--------------------------------
    Route::resource('resources', ResourceController::class);

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
    
    Route::resource('resource_creator', Resource_creatorController::class);
    Route::resource('resource_dd_class', Resource_dd_classController::class);
    Route::resource('resource_dd_devision', Resource_dd_devisionController::class);
    Route::resource('resource_dd_section', Resource_dd_sectionController::class);
    Route::resource('resource_dd_donate', Resource_donateController::class);
    Route::resource('resource_lang', Resource_langController::class);
    Route::resource('resource_publisher', Resource_PublisherController::class);



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

    // --------Book_details--------------------------------
    // Route::resource('books_category', Book_CatController::class);
    // Route::resource('books_dd', Book_DDController::class);
    // Route::resource('books_language', Book_langController::class);
    // Route::resource('books_medium', Book_MediumController::class);
    // Route::resource('books_publisher', Book_PublisherController::class);

    // Route::post('update_book_cat', [Book_CatController::class, 'update_detail'])->name('update_book_cat');
    // Route::post('delete_book_cat', [Book_CatController::class, 'delete'])->name('delete_book_cat');

    // Route::post('update_book_dd', [Book_DDController::class, 'update_detail'])->name('update_book_dd');
    // Route::post('delete_book_dd', [Book_DDController::class, 'delete'])->name('delete_book_dd');

    // Route::post('update_book_medium', [Book_MediumController::class, 'update_detail'])->name('update_book_medium');
    // Route::post('delete_book_medium', [Book_MediumController::class, 'delete'])->name('delete_book_medium');

    // Route::post('update_book_publisher', [Book_PublisherController::class, 'update_detail'])->name('update_book_publisher');
    // Route::post('delete_book_publisher', [Book_PublisherController::class, 'delete'])->name('delete_book_publisher');

    // Route::post('update_book_lang', [Book_langController::class, 'update_detail'])->name('update_book_lang');
    // Route::post('delete_book_lang', [Book_langController::class, 'delete'])->name('update_book_lang');

    //--------Member----------------------------------
    Route::resource('members', MemberController::class);
    Route::post('store_member', [MemberController::class, 'store'])->name('store_member');

    // -------configer--------------------------------
    Route::resource('config', ConfigController::class);

});

Route::get('/sms', [SoapController::class, 'msg_test'])->name('msg_test');

// -----comfig---------------------------
Route::post('create_lib', [ConfigController::class, 'store_library'])->name('create_lib');
// Route::post('create_center', [ConfigController::class, 'store_center'])->name('create_center');
Route::post('create_staff', [ConfigController::class, 'store_staff'])->name('create_staff');
Route::post('create_user', [ConfigController::class, 'store_user'])->name('create_user');

