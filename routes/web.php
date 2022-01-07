<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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
use App\Http\Controllers\Resource_rackController;
use App\Http\Controllers\Resource_floorController;
use App\Http\Controllers\Resource_PublisherController;
use App\Http\Controllers\Survey_suggestion_Controller;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Member_categoryController;
use App\Http\Controllers\Library_titleController;
use App\Http\Controllers\Library_genderController;
use App\Http\Controllers\Staff_designetionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\Member_guarantorController;
use App\Http\Controllers\ReceiptController;




Auth::routes();

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');
Route::resource('lmslogin', LoginController::class);

  
Route::get('test', [UserController::class, 'index'])->name('users.index');
Route::get('test_dt', [UserController::class, 'index1'])->name('users.index1');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    // --------Home--------------------------------
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('latast_lending', [HomeController::class, 'latast_lending'])->name('latast_lending');
    Route::get('backup_db', [HomeController::class, 'backup_db'])->name('backup_db');
    // --------Roles--------------------------------
    Route::resource('roles', RoleController::class);
    Route::post('delete_roles', [RoleController::class, 'delete'])->name('delete_roles');
    
    // --------User--------------------------------
    Route::resource('users', UserController::class);
    Route::get('staff_users', [UserController::class, 'staff_users'])->name('staff_users');
    Route::get('edit_staff_users/{id}', [UserController::class, 'edit_staff_users'])->name('edit_staff_users');
    Route::get('show_staff_users/{id}', [UserController::class, 'show_staff_users'])->name('show_staff_users');
    Route::get('create_staff_users', [UserController::class, 'create_staff_users'])->name('create_staff_users');
    Route::post('store_staff_users', [UserController::class, 'store_staff_users'])->name('store_staff_users');
    Route::post('update_staff_users', [UserController::class, 'update_staff_users'])->name('update_staff_users');

    Route::get('member_users', [UserController::class, 'member_users'])->name('member_users');
    Route::get('edit_member_users/{id}', [UserController::class, 'edit_member_users'])->name('edit_member_users');
    Route::get('show_member_users/{id}', [UserController::class, 'show_member_users'])->name('show_member_users');
    Route::get('create_member_users', [UserController::class, 'create_member_users'])->name('create_member_users');
    Route::post('store_member_users', [UserController::class, 'store_member_users'])->name('store_member_users');
    Route::post('update_member_users', [UserController::class, 'update_member_users'])->name('update_member_users');

    Route::post('update_my_account', [UserController::class, 'update_my_account'])->name('update_my_account');

    Route::post('pw_reset', [UserController::class, 'pw_reset'])->name('pw_reset');
    Route::post('delete_users', [UserController::class, 'delete'])->name('delete_users');
    
    // --------Resource--------------------------------
    Route::resource('resource', ResourceController::class);
    
    Route::get('load_resource_category', [ResourceController::class, 'load_category'])->name('load_resource_category');
    Route::post('load_resource_type', [ResourceController::class, 'load_type'])->name('load_resource_type');

    Route::get('load_resource_rack', [ResourceController::class, 'load_rack'])->name('load_resource_rack');
    Route::post('load_resource_floor', [ResourceController::class, 'load_floor'])->name('load_resource_floor');

    Route::get('load_dd_class', [ResourceController::class, 'load_dd_class'])->name('load_dd_class');
    Route::post('load_dd_devision', [ResourceController::class, 'load_dd_devision'])->name('load_dd_devision');
    Route::post('load_dd_section', [ResourceController::class, 'load_dd_section'])->name('load_dd_section');
    Route::get('load_creator', [ResourceController::class, 'load_creator'])->name('load_creator');

    Route::get('filter_by_type/{id}', [ResourceController::class, 'filter_by_type'])->name('filter_by_type');
    Route::get('filter_by_category', [ResourceController::class, 'filter_by_category'])->name('filter_by_category');
    Route::post('import_resource', [ResourceController::class, 'import'])->name('import_resource');
    Route::get('create_resource', [ResourceController::class, 'create'])->name('create_resource');
    Route::get('edit_resource/{id}', [ResourceController::class, 'edit'])->name('edit_resource');
    Route::POST('update_resource', [ResourceController::class, 'update_resource'])->name('update_resource');
    Route::POST('delete_resource', [ResourceController::class, 'delete'])->name('delete_resource');
    Route::get('resource_catelog', [ResourceController::class, 'resource_catelog'])->name('resource_catelog');
    Route::get('catelog_quick_search', [ResourceController::class, 'catelog_quick_search'])->name('catelog_quick_search');
    Route::get('show_resource/{id}', [ResourceController::class, 'show'])->name('show_resource');

    // --------Resource support/category--------------------------------
    Route::resource('resource_catagory', Resource_categoryController::class);
    Route::post('update_resource_cat', [Resource_categoryController::class, 'update_detail'])->name('update_resource_cat');
    Route::post('delete_resource_cat', [Resource_categoryController::class, 'delete'])->name('delete_resource_cat');
    Route::post('import_resource_cat', [Resource_categoryController::class, 'import'])->name('import_resource_cat');
    
     // --------Resource support/rack--------------------------------
     Route::resource('resource_rack', Resource_rackController::class);
     Route::post('update_resource_rack', [Resource_rackController::class, 'update_detail'])->name('update_resource_rack');
     Route::post('delete_resource_rack', [Resource_rackController::class, 'delete'])->name('delete_resource_rack');
     Route::post('import_resource_rack', [Resource_rackController::class, 'import'])->name('import_resource_rack');

      // --------Resource support/floor--------------------------------
      Route::resource('resource_floor', Resource_floorController::class);
      Route::post('update_resource_floor', [Resource_floorController::class, 'update_detail'])->name('update_resource_floor');
      Route::post('show_resource_floor', [Resource_floorController::class, 'show_detail'])->name('show_resource_floor');
      Route::post('edit_resource_floor', [Resource_floorController::class, 'edit_detail'])->name('edit_resource_floor');
      Route::post('delete_resource_floor', [Resource_floorController::class, 'delete'])->name('delete_resource_floor');
      Route::post('import_resource_floor', [Resource_floorController::class, 'import'])->name('import_resource_floor');
      Route::get('load_resource_rack', [Resource_floorController::class, 'rack'])->name('load_resource_rack');

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
    Route::post('edit_resource_creator', [Resource_creatorController::class, 'edit_detail'])->name('edit_resource_creator');
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

    // --------Survey support/suggestion--------------------------------
    Route::resource('survey_suggestion', Survey_suggestion_Controller::class);
    Route::post('update_survey_suggestion', [Survey_suggestion_Controller::class, 'update_detail'])->name('update_survey_suggestion');
    Route::post('delete_survey_suggestion', [Survey_suggestion_Controller::class, 'delete'])->name('delete_survey_suggestion');
    Route::post('import_survey_suggestion', [Survey_suggestion_Controller::class, 'import'])->name('import_survey_suggestion');

    //----------------------Lending----------------------------------
    Route::resource('lending', LendingController::class);
    Route::get('lending_history', [LendingController::class, 'lending_history'])->name('lending_history');
    Route::get('lending_acconut', [LendingController::class, 'lending_acconut'])->name('lending_acconut');
    Route::POST('show_lending', [LendingController::class, 'show'])->name('show_lending');
    Route::POST('delete_lending', [LendingController::class, 'delete'])->name('delete_lending');
    Route::get('lending_remainder', [LendingController::class, 'lending_remainder'])->name('lending_remainder');

   // ----------------------Issue-------------------------------------
   Route::resource('issue', IssueController::class);
   Route::post('member_view', [IssueController::class, 'memberview'])->name('member_view');
   Route::post('resource_view', [IssueController::class, 'resourceview'])->name('resource_view');
   Route::post('select_resource_view', [IssueController::class, 'select_resource_view'])->name('select_resource_view');
   Route::post('store_issue', [IssueController::class, 'store_issue'])->name('store_issue');
   Route::get('issue_riceipt/{id}', [IssueController::class, 'issue_receipt'])->name('issue_riceipt');

   // ----------------------Return-------------------------------------
   Route::resource('return', ReturnController::class);
   Route::post('get_lending', [ReturnController::class, 'get_lending'])->name('get_lending');
   Route::post('extend_lending', [ReturnController::class, 'extend_lending'])->name('extend_lending');
   Route::post('store_return', [ReturnController::class, 'store_return'])->name('store_return');
   Route::post('settle_fine', [ReturnController::class, 'settle_fine'])->name('settle_fine');
   Route::post('fine_receipt', [ReturnController::class, 'fine_receipt'])->name('fine_receipt');
   Route::get('return_riceipt/{id}', [ReturnController::class, 'return_riceipt'])->name('return_riceipt');

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
    Route::post('import_member', [MemberController::class, 'import'])->name('import_member');
    Route::post('update_member', [MemberController::class, 'update_member'])->name('update_member');
    Route::get('edit_member/{id}', [MemberController::class, 'edit'])->name('edit_member');
    Route::POST('show_member', [MemberController::class, 'show'])->name('show_member');
    Route::POST('delete_member', [MemberController::class, 'delete'])->name('delete_member');

    //--------Staff----------------------------------
    Route::resource('staff', StaffController::class);
    Route::post('store_staff', [StaffController::class, 'store'])->name('store_staff');
    Route::get('create_staff', [StaffController::class, 'create'])->name('create_staff');
    Route::post('import_staff', [StaffController::class, 'import'])->name('import_staff');
    Route::post('update_staff', [StaffController::class, 'update_staff'])->name('update_staff');
    Route::get('edit_staff/{id}', [StaffController::class, 'edit'])->name('edit_staff');
    Route::POST('show_staff', [StaffController::class, 'show'])->name('show_staff');
    Route::POST('delete_staff', [StaffController::class, 'delete'])->name('delete_staff');

    //--------Center----------------------------------
    Route::resource('center', CenterController::class);
    Route::post('store_center', [CenterController::class, 'store'])->name('store_center');
    Route::get('create_center', [CenterController::class, 'create'])->name('create_center');
    Route::post('import_center', [CenterController::class, 'import'])->name('import_center');
    Route::post('update_center', [CenterController::class, 'update_center'])->name('update_center');
    Route::get('edit_center/{id}', [CenterController::class, 'edit'])->name('edit_center');
    Route::POST('show_center', [CenterController::class, 'show'])->name('show_center');
    Route::POST('delete_center', [CenterController::class, 'delete'])->name('delete_center');

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
    Route::post('same_reso_check', [SurveyController::class, 'same_reso_check'])->name('same_reso_check');
    Route::post('same_reso_uncheck', [SurveyController::class, 'same_reso_uncheck'])->name('same_reso_uncheck');

    // --------Member support/category--------------------------------
    Route::resource('member_catagory', Member_categoryController::class);
    Route::post('update_member_cat', [Member_categoryController::class, 'update_detail'])->name('update_member_cat');
    Route::post('delete_member_cat', [Member_categoryController::class, 'delete'])->name('delete_member_cat');
    Route::post('import_member_cat', [Member_categoryController::class, 'import'])->name('import_member_cat');

    // --------Member support/guarantor--------------------------------
    Route::resource('member_guarantor', Member_guarantorController::class);
    Route::post('edit_member_guarantor', [Member_guarantorController::class, 'edit_member_guarantor'])->name('edit_member_guarantor');
    Route::post('update_member_guarantor', [Member_guarantorController::class, 'update_detail'])->name('update_member_guarantor');
    Route::post('delete_member_guarantor', [Member_guarantorController::class, 'delete'])->name('delete_member_guarantor');
    Route::post('import_member_guarantor', [Member_guarantorController::class, 'import'])->name('import_member_guarantor');

    // --------Library support/titles--------------------------------
    Route::resource('titles', Library_titleController::class);
    Route::post('update_titles', [Library_titleController::class, 'update_detail'])->name('update_titles');
    Route::post('delete_titles', [Library_titleController::class, 'delete'])->name('delete_titles');
    Route::post('import_titles', [Library_titleController::class, 'import'])->name('import_titles');

    // --------Library support/genders--------------------------------
    Route::resource('genders', Library_genderController::class);
    Route::post('update_genders', [Library_genderController::class, 'update_detail'])->name('update_genders');
    Route::post('delete_genders', [Library_genderController::class, 'delete'])->name('delete_genders');
    Route::post('import_genders', [Library_genderController::class, 'import'])->name('import_genders');

     // --------Staff support/designation--------------------------------
     Route::resource('designation', Staff_designetionController::class);
     Route::post('update_designation', [Staff_designetionController::class, 'update_detail'])->name('update_designation');
     Route::post('delete_designation', [Staff_designetionController::class, 'delete'])->name('delete_designation');
     Route::post('import_designation', [Staff_designetionController::class, 'import'])->name('import_designation');

    // -------configer--------------------------------
    Route::resource('config', ConfigController::class);

    // -------Settings--------------------------
    Route::get('lms_setting', [SettingController::class, 'lms_setting'])->name('lms_setting');
    Route::get('basic_setting', [SettingController::class, 'basic_setting'])->name('basic_setting');
    Route::get('lending_setting', [SettingController::class, 'lending_setting'])->name('lending_setting');
    Route::get('notification_setting', [SettingController::class, 'notification_setting'])->name('notification_setting');
    Route::post('update_theme', [SettingController::class, 'update_theme'])->name('update_theme');
    Route::get('change_theme/{id}', [SettingController::class, 'change_theme'])->name('change_theme');
    Route::post('update_library', [SettingController::class, 'update_library'])->name('update_library');
    Route::post('update_db_locale', [SettingController::class, 'update_db_locale'])->name('update_db_locale');
    Route::post('update_locale', [SettingController::class, 'update_locale'])->name('update_locale');
    Route::post('update_sms_option', [SettingController::class, 'update_sms_option'])->name('update_sms_option');
    Route::post('update_email_option', [SettingController::class, 'update_email_option'])->name('update_email_option');
    Route::post('update_email_backup', [SettingController::class, 'update_email_backup'])->name('update_email_backup');
    Route::post('update_lending_config', [SettingController::class, 'update_lending_config'])->name('update_lending_config');
    Route::post('update_fine', [SettingController::class, 'update_fine'])->name('update_fine');
    Route::post('update_period', [SettingController::class, 'update_period'])->name('update_period');
    Route::post('update_limit', [SettingController::class, 'update_limit'])->name('update_limit');

     // -------Reports---------------------------------
    Route::get('rpt_resource_index', [ReportController::class, 'resource_index'])->name('rpt_resource_index');
    Route::get('rpt_member_index', [ReportController::class, 'member_index'])->name('rpt_member_index');
    Route::get('rpt_lending_index', [ReportController::class, 'lending_index'])->name('rpt_lending_index');
    Route::get('rpt_survey_index', [ReportController::class, 'survey_index'])->name('rpt_survey_index');
    Route::get('rpt_support_index', [ReportController::class, 'support_index'])->name('rpt_support_index');

    // -------Reports-PDF
    Route::POST('report_recource_indexing', [ReportController::class, 'report_recource_indexing'])->name('report_recource_indexing');
    Route::POST('report_recource_filter', [ReportController::class, 'report_recource_filter'])->name('report_recource_filter');
    Route::POST('report_recource_filter_all', [ReportController::class, 'report_recource_filter_all'])->name('report_recource_filter_all');
    Route::POST('recource_card_range', [ReportController::class, 'recource_card_range'])->name('recource_card_range');
    Route::POST('report_lending', [ReportController::class, 'report_lending'])->name('report_lending');
    Route::POST('report_lending_account', [ReportController::class, 'report_lending_account'])->name('report_lending_account');
    Route::POST('member_card', [ReportController::class, 'member_card'])->name('member_card');
    Route::POST('member_card_range', [ReportController::class, 'member_card_range'])->name('member_card_range');

     // -------Reports-Excel
     Route::POST('export_recource', [ReportController::class, 'export_recource'])->name('export_recource');
     Route::POST('export_recource_indexing', [ReportController::class, 'export_recource_indexing'])->name('export_recource_indexing');
     Route::POST('export_recource_filter', [ReportController::class, 'export_recource_filter'])->name('export_recource_filter');
     Route::POST('export_recource_filter_all', [ReportController::class, 'export_recource_filter_all'])->name('export_recource_filter_all');
     Route::POST('export_lending', [ReportController::class, 'export_lending'])->name('export_lending');
     Route::POST('export_lending_account', [ReportController::class, 'export_lending_account'])->name('export_lending_account');
     Route::POST('export_survey_temp', [ReportController::class, 'export_survey_temp'])->name('export_survey_temp');
     Route::POST('export_survey_history', [ReportController::class, 'export_survey_history'])->name('export_survey_history');

    //  ---------Email-------------
    Route::get('sendbasicemail', [MailController::class, 'basic_email'])->name('sendbasicemail');
    Route::get('sendhtmlemail', [MailController::class, 'html_email'])->name('sendhtmlemail');
    Route::get('sendattachmentemail', [MailController::class, 'attachment_email'])->name('sendattachmentemail');

    //--------Receipt----------------------------------
     Route::resource('receipt', ReceiptController::class);
     Route::POST('cancel_receipt', [ReceiptController::class, 'cancel'])->name('cancel_receipt');
});

Route::get('/sms', [SoapController::class, 'msg_test'])->name('msg_test');

// -----config---------------------------
Route::post('create_lib', [ConfigController::class, 'store_library'])->name('create_lib');
// Route::post('create_center', [ConfigController::class, 'store_center'])->name('create_center');
Route::post('create_staff', [ConfigController::class, 'store_staff'])->name('create_staff');
Route::post('create_user', [ConfigController::class, 'store_user'])->name('create_user');

