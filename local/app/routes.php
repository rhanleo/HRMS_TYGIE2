<?php
/*
 * SnapHRM
 * Name:Ajay Kumar choudhary
 * Email:ajay@froiden.com
 */

#API FUNCTIONS
Route::group(['prefix' => 'api'], function(){
    Route::post('get_appraisal_form', 'ApiController@get_appraisal_form');
    Route::post('get_payroll_dac_form', 'ApiController@get_payroll_dac_form');
    Route::post('submit_appraisal/{employeeID}/{quarter}', 'ApiController@submit_appraisal');
    Route::post('delete/{table}/{id}', 'ApiController@delete_record');
    // Route::get('cpf_calculator/{birth_date}/{salary}/{allowance?}', 'ApiController@cpf_calculator');


    Route::get('/', function(){
        return Redirect::to('/');
    });
});


# Employee Login
    Route::get('/',['as'=>'login','uses'=>'LoginController@index']);
    Route::post('/login',['as'=>'login','uses'=>'LoginController@ajaxLogin']);
    Route::get('logout', ['as'=>'front.logout','uses'=>'LoginController@logout']);

# Employee Panel After Login
Route::group(array('before' => 'auth.employees'), function()
{
    Route::post('/change_password_modal',['as'=>'front.change_password_modal','uses'=>'DashboardController@changePasswordModal']);
    Route::post('/change_password',['as'=>'front.change_password','uses'=>'DashboardController@change_password']);
    Route::get('ajaxApplications/{id}',['as'=>'front.leave_applications','uses'=> 'DashboardController@ajaxApplications']);
    Route::get('ajaxOvertime/{id}',['as'=>'front.overtime_applications','uses'=> 'DashboardController@ajaxOvertime']);
	Route::get('salary_slip/{id}',['as'=>'front.salary_slip','uses'=>'DashboardController@salary_show']);
	Route::get('downloadpdf/{id}',['as'=>'front.payrolls.downloadpdf','uses'=> 'DashboardController@downloadPdf']);
    Route::get('leave',['as'=>'front.leave','uses'=>'DashboardController@leave']);
    Route::get('overtime/edit/{id}',['as'=>'front.overtime_edit','uses'=>'DashboardController@ot_edit']);
    Route::get('overtime/show/{id}',['as'=>'front.overtime_show','uses'=>'DashboardController@ot_show']);
    Route::post('dashboard/update_overtime/{id}',['as'=>'front.overtime_update','uses'=>'DashboardController@updateOvertime']);
    
    Route::get('overtime',['as'=>'front.overtime','uses'=>'DashboardController@overtime']);
    Route::get('overtime/{id}/edit',['as'=>'front.overtime.edit','uses'=>'DashboardController@overtimeEdit']);
    Route::post('overtime/{id}',['as'=>'front.overtime.update','uses'=>'DashboardController@overtimeUpdate']);

    Route::get('salary',['as'=>'front.salary','uses'=>'DashboardController@salary']);
    Route::get('ajax_payrolls',['as'=>'front.ajax_payrolls','uses'=>'DashboardController@ajax_payrolls']);
    Route::get('timein/{id}',['as'=>'front.timein','uses'=>'DashboardController@timein']);
    Route::get('timeout/{id}',['as'=>'front.timeout','uses'=>'DashboardController@timeout']);
    Route::post('dashboard/notice/{id}',['as'=>'front.notice_ajax','uses'=>'DashboardController@notice_ajax']);
    Route::get('appraisal',['as'=>'front.appraisal','uses'=>'DashboardController@appraisal']);
    Route::match( [ 'get', 'post' ], 'appraisal/store', 'DashboardController@store_appraisal' );
    Route::get('appraisal/get_form/{id}', 'DashboardController@get_form' );

    Route::post('leave_store',['as'=>'front.leave_store','uses'=>'DashboardController@leave_store']);
    Route::post('overtime_store',['as'=>'front.overtime_store','uses'=>'DashboardController@overtime_store']);

    Route::resource('jobs','JobFrontController');
    Route::resource('dashboard','DashboardController');

	Route::get('ajax_expenses/',['as'=>'front.ajax_expenses','uses'=> 'ExpenseFrontsController@ajax_expenses']);
	Route::resource('expenses', 'ExpenseFrontsController',['as' => 'front']);
});


# Admin Login
Route::group(array('prefix' => 'admin'), function()
{

	Route::get('/',['as'=>'admin.getlogin','uses'=>'AdminLoginController@index']);
	Route::get('logout',['as'=>'admin.logout','uses'=> 'AdminLoginController@logout']);

    Route::post('login',['as'=>'admin.login','uses'=> 'AdminLoginController@ajaxAdminLogin']);

});


// Admin Panel After Login
Route::group(array('prefix' => 'admin','before' => 'auth.admin|lock'), function()
{

    //	Dashboard Routing

    Route::resource('dashboard', 'AdminDashboardController',['as' => 'admin']);

    //    Employees Routing
	Route::get('employees/export',['as'=>'admin.employees.export','uses'=>'EmployeesController@export']);
    Route::get('employees/employeeLogin/{id}',['as'=>'admin.employees.employeeLogin','uses'=>'EmployeesController@employeesLogin']);
    Route::resource('employees', 'EmployeesController',['except' => ['show'],'as' => 'admin']);
	Route::post('employees/{id}/update',['uses'=>'EmployeesController@update']);
    Route::get('employees/destroy/{id}',['as'=>'admin.employees.destroy','uses'=>'EmployeesController@destroy']);
    
    //  Excel add_user Routing
    Route::get('employees/excelview',['as'=>'admin.employees.excelview', 'uses'=>'EmployeesController@excelview']);
    Route::post('employees/excelupload',['as'=>'admin.employees.excelupload','uses'=>'EmployeesController@excelupload']);
    
      //  WrokingHistory Routing
    Route::get('employees/workinghistory',['as'=>'admin.employees.workinghistory','uses'=>'WorkingHistoryController@index']);
    Route::get('employees/workinghistory/{id}',['as'=>'admin.employee.workinghistory','uses'=>'WorkingHistoryController@view']);

    //Internal Departments employees
    Route::get('employees/operations/{id}',['as'=>'admin.employee.operations','uses'=>'EmployeesController@operations']);
    Route::get('employees/finance/{id}',['as'=>'admin.employee.finance','uses'=>'EmployeesController@finance']);
    Route::get('employees/admin/{id}',['as'=>'admin.employee.admin','uses'=>'EmployeesController@admin']);

    //  Awards Routing
    Route::get('ajax_awards/',['as'=>'admin.ajax_awards','uses'=> 'AwardsController@ajax_awards']);
    Route::resource('awards', 'AwardsController',['except'=>['show'],'as' => 'admin']);

    // Appraisal Routing
    Route::resource('appraisal', 'AppraisalController',['except'=>['show'],'as' => 'admin']);

    //  Department Routing
    Route::get('departments/ajax_designation/',['as'=>'admin.departments.ajax_designation','uses'=> 'DepartmentsController@ajax_designation']);
    Route::resource('departments', 'DepartmentsController',['except' => ['show','create'],'as' => 'admin']);
    Route::get('departments/sub/',['as'=>'admin.departments.sub','uses'=> 'DepartmentsController@sub']);
    Route::post('departments/sub/',['as'=>'admin.departments.save','uses'=> 'DepartmentsController@save']);
    Route::post('departments/sub/{id}',['as'=>'admin.departments.edit','uses'=> 'DepartmentsController@edit']);
    //    Expense Routing
	Route::post('expense_change_status/',['as'=>'admin.expense.change_status','uses'=> 'ExpensesController@change_status']);
    Route::get('ajax_expenses/',['as'=>'admin.ajax_expenses','uses'=> 'ExpensesController@ajax_expenses']);
    Route::resource('expenses', 'ExpensesController',['except' => ['show'],'as' => 'admin']);

    //    Holiday Routing
    Route::get('holidays/mark_friday', 'HolidaysController@Friday');
    Route::get('holidays/mark_saturday', 'HolidaysController@Saturday');
    Route::get('holidays/mark_sunday', 'HolidaysController@Sunday');
    Route::resource('holidays', 'HolidaysController',['as' => 'admin']);

    //  Routing for the attendance
    Route::get('attendances/report/{attendances}', ['as'=>'admin.attendance.report','uses'=>'AttendancesController@report']);
    Route::resource('attendances', 'AttendancesController',['as' => 'admin']);
    Route::get('attendances/timesheet/{id}/{month}/{year}',['as'=>'admin.attendance.timesheet','uses'=>'AttendancesController@gentimesheet']);
    //    Routing or the leavetypes
    Route::resource('leavetypes', 'LeavetypesController',['except'=>['show'],'as' => 'admin']);

    //    Leave Applications routing
    Route::get('leave_applications/ajaxApplications',['as'=>'admin.leave_applications','uses'=> 'LeaveApplicationsController@ajaxApplications']);
    Route::resource('leave_applications', 'LeaveApplicationsController',['except'=>['create','store','edit'],'as' => 'admin']);
    Route::match( [ 'get', 'post' ], 'leave-applications/store', 'LeaveApplicationsController@store' );
    
    //    Overtime Applications routing
    Route::get('overtime_applications/ajaxApplications',['as'=>'admin.overtime_applications','uses'=> 'OvertimeApplications@ajaxApplications']);
    Route::get('overtime_applications/filter/{year}/{month}/{period}/{id}',['uses'=> 'OvertimeApplications@overtimeFilter']);
    Route::resource('overtime_applications', 'OvertimeApplications',['except'=>['create','store','edit']]);
    Route::match( [ 'get', 'post' ], 'overtime-applications/store', 'OvertimeApplications@store' );

    //    Overtime Applications routing
    Route::resource( 'overtime', 'OvertimeController' );

    //   Routing for setting
	Route::get('change_language/', ['as'=>'admin.change_language','uses'=>'SettingsController@change_language']);
	Route::get('theme/',['as'=>'admin.settings.theme','uses'=> 'SettingsController@theme']);
    Route::resource('settings', 'SettingsController',['only'=>['edit','update'],'as' => 'admin']);

    //    Salary Routing
    Route::resource('salary','SalaryController',['only'=>['destroy','update','store'],'as' => 'admin']);

    //    Profile Setting
    Route::resource('profile_settings', 'ProfileSettingsController',['only'=>['edit','update'],'as' => 'admin']);

    //   Notification Setting
	Route::post('ajax_update_notification',['as'=>'admin.ajax_update_notification','uses'=> 'NotificationSettingsController@ajax_update_notification']);
    Route::resource('notificationSettings', 'NotificationSettingsController',['only'=>['edit','update'],'as' => 'admin']);

    //  Notice Board
    Route::get('ajax_notices/',['as'=>'admin.ajax_notices','uses'=> 'NoticeboardsController@ajax_notices']);
    Route::resource('noticeboards', 'NoticeboardsController',['except'=>['show'],'as' => 'admin']);

    //  CPF Settings
    // Route::resource('cpf_settings', 'CpfSettingsController');


	// Payroll
    Route::get('payrolls/export',['as'=>'admin.payrolls.export','uses'=>'PayrollsController@export']);// 
    Route::post('payrolls/create_bulk_payroll',['as'=>'admin.payrolls.create_bulk_payroll','uses'=>'PayrollsController@create_bulk_payroll']);
	Route::get('payrolls/downloadpdf/{id}',['as'=>'admin.payrolls.downloadpdf','uses'=> 'PayrollsController@downloadPdf']);
    Route::post('payrolls/check/',['as'=>'admin.payrolls.check','uses'=> 'PayrollsController@check']);
    Route::get('ajax_payrolls/',['as'=>'admin.ajax_payrolls','uses'=> 'PayrollsController@ajax_payrolls']);
	Route::resource('payrolls', 'PayrollsController',['as' => 'admin']);
    
	Route::get('ajax_admin_users/',['as'=>'admin.ajax_admin_users','uses'=> 'AdminUsersController@ajax_admin_users']);
	Route::resource('admin_users', 'AdminUsersController',['as' => 'admin']);
    Route::resource( 'sss_settings', 'SSSController' );
    Route::resource( 'philhealth', 'PhilHealthController' );
	Route::get('employees/upload',['as'=>'admin.employees.upload','uses'=>'EmployeesController@upload']);
	Route::post('employees/import',['as'=>'admin.employees.import','uses'=>'EmployeesController@import']);
	//  Job Posted
	Route::get('ajax_jobs/',['as'=>'admin.ajax_jobs','uses'=> 'JobsController@ajax_jobs']);
	Route::resource('jobs', 'JobsController',['as' => 'admin']);

	// Job Applications
	Route::get('job_application/get_download/{resume}',['as'=>'admin.job_applications.get_download','uses'=> 'JobApplicationsController@getDownload']);
	Route::post('job_application_change_status/',['as'=>'admin.job_applications.change_status','uses'=> 'JobApplicationsController@change_status']);
	Route::get('ajax_jobs_applications/',['as'=>'admin.ajax_jobs_applications','uses'=> 'JobApplicationsController@ajax_jobs_applications']);
	Route::resource('job_applications', 'JobApplicationsController',['as' => 'admin']);

});

// Lock Screen Routing
Route::get('screenlock', 'AdminDashboardController@screenlock');

//Event for updating the last login of user
Event::listen('auth.login', function($user)
{
    $user->last_login = new DateTime;
    $user->save();
});

