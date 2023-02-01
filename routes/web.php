<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/localization/{lang}', function ($lang) {
	App::setlocale($lang);
    return view('localization');
});
Route::group(['middleware' => 'role:developer'], function() {

    Route::get('/admin', function() {
 
       return 'Welcome Admin';
       
    });
 
 });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Manage Roles
Route::post('/roles/store', 'PermissionController@store')->name('store_role');
Route::get('/permission', 'PermissionController@index')->name('permission');
Route::post('/permission/store','PermissionController@store')->name('store_per');

Route::get('/assign_role', 'PermissionController@index')->name('assign_role'); //assign_role_per
Route::post('/assign_per','PermissionController@store')->name('assign_per'); //store role_per
Route::get('/getdata','PermissionController@getdata')->name('getdata');  //view assign role data
Route::post('/delete_role','PermissionController@destroy')->name('delete_role');
// deletedata_assign_role
Route::post('/deletedata_assign_role','PermissionController@destroy_assignrole')->name('deletedata_assign_role');


//Manage State
Route::get('/state','StateController@index')->name('state');
Route::get('/getstate','StateController@getdata')->name('getstate');
Route::get('/getdatabyyid_state','StateController@getdatabyid')->name('getdatabyid_state');
Route::post('/store_state','StateController@store')->name('store_state');
Route::post('/edit_state','StateController@edit')->name('edit_state');
Route::post('/deletedata_state','StateController@deletedata')->name('deletedata_state');

//Manage District
Route::get('/district','DistrictController@index')->name('district');
Route::get('/getdistrict','DistrictController@show')->name('getdistrict');
Route::get('/getstatedata','DistrictController@getstatedata')->name('getstatedata');
Route::get('/getdatabyyid_district','DistrictController@edit')->name('getdatabyid_district');
Route::post('/store_district','DistrictController@store')->name('store_district');
Route::post('/edit_district','DistrictController@update')->name('edit_district');
Route::post('/deletedata_district','DistrictController@destroy')->name('deletedata_district');

//Manage Taluka
Route::get('/taluka','TalukaController@index')->name('taluka');
Route::get('/gettaluka','TalukaController@show')->name('gettaluka');
Route::get('/getdatabyyid_taluka','TalukaController@edit')->name('getdatabyid_taluka');
Route::post('/store_taluka','TalukaController@store')->name('store_taluka');
Route::post('/edit_taluka','TalukaController@update')->name('edit_taluka');
Route::post('/deletedata_taluka','TalukaController@destroy')->name('deletedata_taluka');

//Manage Village
Route::get('/village','VillageController@index')->name('village');
Route::get('/getvillage','VillageController@show')->name('getvillage');
Route::get('/getdatabyyid_village','VillageController@edit')->name('getdatabyid_village');
Route::post('/store_village','VillageController@store')->name('store_village');
Route::post('/edit_village','VillageController@update')->name('edit_village');
Route::post('/deletedata_village','VillageController@destroy')->name('deletedata_village');


//location drop down list
Route::get('distdata/getdistrict/{id}','DistrictController@getDistrict');
Route::get('talukadata/gettaluka/{id}','TalukaController@getTaluka');
Route::get('villagedata/getvillage/{id}','VillageController@getVillage');


//Manage Employee

Route::get('/emp','EmployeeController@index')->name('emp');

Route::get('/addemp','EmployeeController@create')->name('addemp');
Route::post('/store_emp','EmployeeController@store')->name('store_emp');
Route::get('/editemp/{id}','EmployeeController@edit')->name('editemp');
Route::get('/showemp/{id}','EmployeeController@show')->name('showemp');
Route::post('/updateemp','EmployeeController@update')->name('updateemp');
Route::post('empdelete','EmployeeController@destroy')->name('deleteemp');


//Location route for edit employee
Route::get('editemp/distdata/getdistrict/{id}','DistrictController@getDistrict');
Route::get('editemp/talukadata/gettaluka/{id}','TalukaController@getTaluka');
Route::get('editemp/villagedata/getvillage/{id}','VillageController@getVillage');



//Manage User Profile
Route::get('/profile','HomeController@profile')->name('profile');
Route::post('/update_profile','HomeController@update_profile')->name('update_profile');

//Manage Department
Route::get('/department','Department@index')->name('dept');
Route::get('/getdept','Department@show')->name('getdept');
Route::get('/getdatabyyid_dept','Department@edit')->name('getdatabyid_dept');
Route::post('/store_dept','Department@store')->name('store_dept');
Route::post('/edit_dept','Department@update')->name('edit_dept');
Route::post('/deletedata_dept','Department@destroy')->name('deletedata_dept');

//Manage Division
Route::get('/division','DivisionController@index')->name('division');
Route::get('/getdivi','DivisionController@show')->name('getdivi');
Route::get('/getdatabyyid_divi','DivisionController@edit')->name('getdatabyid_divi');
Route::post('/store_divi','DivisionController@store')->name('store_divi');
Route::post('/edit_divi','DivisionController@update')->name('edit_divi');
Route::post('/deletedata_divi','DivisionController@destroy')->name('deletedata_divi');

//Manage Designation
Route::get('/designation','DivisionController@index')->name('designation');
Route::get('/getdes','DivisionController@show')->name('getdes');
Route::get('/getdatabyyid_des','DivisionController@edit')->name('getdatabyid_des');
Route::post('/store_des','DivisionController@store')->name('store_des');
Route::post('/edit_des','DivisionController@update')->name('edit_des');
Route::post('/deletedata_des','DivisionController@destroy')->name('deletedata_des');

//Manage Salary
Route::get('/salary','SalaryController@index')->name('salary');
Route::get('/getsalary','SalaryController@show')->name('getsalary');
Route::get('/getdatabyyid_salary','SalaryController@edit')->name('getdatabyid_salary');
Route::post('/store_salary','SalaryController@store')->name('store_salary');
Route::post('/edit_salary','SalaryController@update')->name('edit_salary');
Route::post('/deletedata_salary','SalaryController@destroy')->name('deletedata_salary');

Route::get('managesalary','ManagesalaryController@index')->name('managesalary');
Route::post('managesalary/detail/','ManagesalaryController@show')->name('show');
Route::get('managesalary/salarylist','ManagesalaryController@salarylist')->name('salarylist');
Route::get('managesalary/salarylistfun','ManagesalaryController@salarylistfun')->name('salarylistfun');

// Route::get('managesalary/generate_slip','ManagesalaryController@generate_slip')->name('generate_slip');
Route::get('managesalary/generate_slip/{id}','ManagesalaryController@generate_slip')->name('generate_slip');

Route::post('managesalary/store','ManagesalaryController@store')->name('managesalary.store');

//Advance Payment
Route::get('managesalary/Advancepayment','AdvancepaymentController@index')->name('Advancepayment');
Route::post('managesalary/make-advance','AdvancepaymentController@store')->name('makeAdvance');
Route::get('/getadvancepayment','AdvancepaymentController@show')->name('getadvancepayment');
Route::get('/getdatabyid_advancepayment','AdvancepaymentController@edit')->name('getdatabyid_advancepayment');
Route::post('/edit_advancepayment','AdvancepaymentController@update')->name('edit_advancepayment');
Route::post('/deletedata_advancepayment','AdvancepaymentController@destroy')->name('deletedata_advancepayment');

//Send Email
Route::get('/sendemail', 'SendEmailController@index')->name('sendemail');
Route::post('/sendemail/send', 'SendEmailController@send');


//Manage Leave Type

Route::get('/leavetype','leavetypeController@index')->name('leavetype');
Route::get('/getleave','leavetypeController@show')->name('getleave');
Route::get('/getdatabyyid_leave','leavetypeController@edit')->name('getdatabyid_leave');
Route::post('/store_leavetype','leavetypeController@store')->name('store_leavetype');
Route::post('/edit_leavetype','leavetypeController@update')->name('edit_leavetype');
Route::post('/deletedata_leavetype','leavetypeController@destroy')->name('deletedata_leavetype');


//Emp Leaves

Route::get('/allLeaves','EmpleaveController@index')->name('allLeaves');
Route::get('/PendingLeaves','EmpleaveController@Pending_leaves')->name('PendingLeaves');
Route::get('/ApprovedLeaves','EmpleaveController@Approved_leaves')->name('ApprovedLeaves');

Route::get('/Leave_detail/{id}','EmpleaveController@getdatabyid')->name('Leave_detail');
Route::get('/leavechange_status','EmpleaveController@change_status')->name('leavechange_status');

Route::post('/update_status','EmpleaveController@update_status')->name('update_status');

Route::post('/deleteemp_leave','EmpleaveController@destroy')->name('deleteemp_leave');

//Apply For Leave
Route::get('/leave','EmpleaveController@create')->name('leave');
Route::post('/leave_apply','EmpleaveController@store')->name('leave_store');


//Manage Projects

Route::get('/project','ProjectController@index')->name('project');
Route::get('/getproject','ProjectController@show')->name('getproject');
Route::get('/getdeptdata','ProjectController@getdeptdata')->name('getdeptdata');
Route::get('/getdatabyyid_project','ProjectController@edit')->name('getdatabyid_project');
Route::post('/store_project','ProjectController@store')->name('store_project');
Route::post('/edit_project','ProjectController@update')->name('edit_project');
Route::post('/deletedata_project','ProjectController@destroy')->name('deletedata_project');


//Assign Project
Route::get('/projects','ProjectAssignController@index')->name('project_assign');
Route::post('/assign_project','ProjectAssignController@store')->name('create');
Route::get('/getprojects','ProjectAssignController@show')->name('getprojects');
// deletedata_project_assign
Route::post('/deletedata_projects','ProjectAssignController@destroy')->name('deletedata_project_assign');


//
Route::get('projectdata/getproject/{id}','ProjectController@getProject');
Route::get('empdata/getemp/{id}','EmployeeController@getemp');

