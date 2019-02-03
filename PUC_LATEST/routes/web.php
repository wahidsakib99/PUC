<?php

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
    return view('login');
});
Route::get('login','logincontroller@login');
Route::get('logout','logincontroller@logout');
//COURSE
Route::resource('course','admincoursecontroller');
Route::get('showsemesters','admincoursecontroller@showsemesters_ajax');
Route::get('showsubjects/{id}','admincoursecontroller@showsubjects_ajax');
Route::get('updatesubject/{id}','admincoursecontroller@updatesubject_ajax');
Route::post('saveupdatesubject/{id}','admincoursecontroller@saveupdatesubject_ajax');
Route::get('showdeletesubject/{id}','admincoursecontroller@showdeletesubject_ajax');
Route::post('deletesubject/{id}','admincoursecontroller@deletesubject_ajax');
Route::post('savesubject','admincoursecontroller@savesubject_ajax');
//COURSE ENDS
//SESSION
Route::resource('session','adminsessioncontroller');
Route::get('overview','adminsessioncontroller@overview_ajax');
Route::post('blockunblock/{id}/{todo}','adminsessioncontroller@blockunblock_ajax');
Route::get('deletemodal/{id}','adminsessioncontroller@deletemodal_ajax');
Route::post('deletesession/{id}','adminsessioncontroller@deletesession_ajax');
Route::get('showsemestersandteachers','adminsessioncontroller@showsemestersandteachers_ajax');
Route::post('save_section','adminsessioncontroller@save_section_ajax');
Route::get('viewsessionsection','adminsessioncontroller@viewsessionsection_ajax');
Route::post('saveselectedsection','adminsessioncontroller@saveselectedsection_ajax');
Route::get('/assignteacher','adminsessioncontroller@assignteacher_ajax');
Route::post('saveassignedteacher','adminsessioncontroller@saveassignedteacher_ajax');
Route::get('/showassignedteacher','adminsessioncontroller@showassignedteacher_ajax');
Route::post('deleteassignedteacher/{id}','adminsessioncontroller@deleteassignedteacher_ajax');
Route::post('/updateselectedteacher','adminsessioncontroller@updateselectedteacher_ajax');
Route::get('updatedadvisor','adminsessioncontroller@updatedadvisor_ajax');
Route::post('deleteassignedadvisor/{id}','adminsessioncontroller@deleteassignedadvisor_ajax');
Route::post('enablesectiondadvisor/{id}','adminsessioncontroller@enablesectiondadvisor_ajax');
Route::post('updateselectedadvisor','adminsessioncontroller@updateselectedadvisor_ajax');
//SESSION ENDS
//Result
Route::resource('result','adminresultcontroller');
Route::get('sectionlist','adminresultcontroller@sectionlist_ajax');
Route::get('showstudents/{id}','adminresultcontroller@showstudents_ajax');
Route::get('getstudentresult/{id}/{semester}','adminresultcontroller@getstudentresult_ajax');
Route::get('showretake/{id}','adminresultcontroller@showretake_ajax');
//RESULT ENDS
//STUDENT ENROLLMENT
Route::resource('enrollment','studentenrollmentcontroller');
Route::get('studentshowsubjects/{id}','studentenrollmentcontroller@showsubjects_ajax');
Route::get('studentshowpending','studentenrollmentcontroller@studentshowpending_ajax');
Route::get('showapproved','studentenrollmentcontroller@showapproved_ajax');
Route::post('deletepending/{id}','studentenrollmentcontroller@deletepending_ajax');
Route::post('postenroll','studentenrollmentcontroller@postenroll_ajax');
//STUDENT ENROLLMENT ENDS
//ADVISOR 
Route::resource('advising','advisorcontroller');
Route::get('showstudentlistforadvisor/{id}','advisorcontroller@showstudentlistforadvisor_ajax');
Route::get('getsectionlist','advisorcontroller@getsectionlist_ajax');
Route::get('showapprovedadvisor/{id}','advisorcontroller@showapprovedadvisor_ajax');
Route::post('acceptpending/{id}','advisorcontroller@acceptpending_ajax');
Route::post('deletepending/{id}','advisorcontroller@deletepending_ajax');
Route::post('makepending/{id}','advisorcontroller@makepending_ajax');
//ADVISOR ENDS
//TEACHER STUDENT
Route::resource('/teacher/students','teacherstudentcontroller');
Route::get('/teacher/getsubjects','teacherstudentcontroller@getsubjects_ajax');
Route::get('/teacher/getstudentsregular','teacherstudentcontroller@getstudentsregular_ajax');
Route::get('teacher/getstudentsretake','teacherstudentcontroller@getstudentsretake_ajax');
Route::get('/teacher/getstudentsrecourse','teacherstudentcontroller@getstudentsrecourse_ajax');
Route::post('/teacher/deletesubject','teacherstudentcontroller@deletesubject_ajax');
//TEACHER STUDENT ENDS
//TEACHER UPLOAD RESULT
Route::resource('teacher/upload','teacheruploadresultcontroller');
//Route::get('/teacher/getsubjects','teacherstudentcontroller@getsubjects_ajax'); /* THIS ROUTE USED PREVIOUSLY */ 
Route::get('/teacher/getstudents','teacheruploadresultcontroller@getstudents_ajax');
Route::post('/teacher/postresultregular','teacheruploadresultcontroller@postresultregular_ajax');
Route::get('/teacher/getretakestudentresult','teacheruploadresultcontroller@getretakestudentresult_ajax');
Route::post('teacher/postresultretake','teacheruploadresultcontroller@postresultretake_ajax');
Route::get('teacher/getupdatestudent','teacheruploadresultcontroller@getupdatestudent_ajax');
Route::post('teacher/restore_regrec/{id}','teacheruploadresultcontroller@restore_regrec_ajax');
Route::post('teacher/restore_ret/{id}','teacheruploadresultcontroller@restore_ret_ajax');
//TEACHER UPLOAD RESULT ENDS
//STUDENT RESULT
Route::resource('student/result','studentresultcontroller');
Route::get('student/studentinfo','studentresultcontroller@studentinfo_ajax');
Route::get('student/getresult/{semester}','studentresultcontroller@getresult_ajax');
Route::get('student/studentretake','studentresultcontroller@studentretake_ajax');
Route::get('student/showincomplete','studentresultcontroller@showincomplete_ajax');
//STUDENT RESULT ENDS
//PROFILE
Route::get('student/profile','profilecontroller@studentProfile');
Route::get('teacher/profile','profilecontroller@teacherProfile');
Route::get('admin/profile','profilecontroller@adminProfile');
Route::get('/student/profile/edit','profilecontroller@editprofile');
Route::post('student/saveprofile/{profileid}/','profilecontroller@saveprofile');
//PROFILE ENDS
//STUDENT PAYMENT CHECKOUT
 Route::resource('student/reciept','studentpaymentcontroller');
 Route::get('student/payment/{total}','studentpaymentcontroller@paymentpage');
 Route::post('/student/payment/post/{total}','studentpaymentcontroller@paymentpost');
 Route::get('student/makepdf','studentpaymentcontroller@makepdf');
//STUDENT PAYMENT CHECKOUT ENDS
//ADMIN SEMESTER
Route::resource('semester','adminsemestercontroller');
Route::get('getsemester','adminsemestercontroller@getsemester_ajax');
Route::post('enabledisable/{id}/{active}','adminsemestercontroller@enabledisable_ajax');
Route::get('showmodaldata/{id}','adminsemestercontroller@showmodaldata_ajax');
Route::post('deletesemester/{id}','adminsemestercontroller@deletesemester_ajax');
Route::post('addsemester','adminsemestercontroller@addsemester');
//ADMIN SEMESTER ENDS
//ADMIN DASHBOARD
Route::resource('dashboard','admindashboardcontroller');
Route::get('getfirstrow','admindashboardcontroller@getfirstrow_ajax');
Route::get('getsecondrow','admindashboardcontroller@getsecondrow_ajax');
Route::get('getprereq/{id}','admindashboardcontroller@getprereq_ajax');
Route::get('show_update_max/{id}','admindashboardcontroller@show_update_max_ajax');
Route::post('set_update_max','admindashboardcontroller@set_update_max_ajax');
Route::get('showpervalues/{id}','admindashboardcontroller@showpervalues_ajax');
Route::post('setupdatepercredit','admindashboardcontroller@setupdatepercredit_ajax');
Route::get('getprereqsub','admindashboardcontroller@getprereqsub_ajax');
Route::post('postupdateprereq','admindashboardcontroller@postupdateprereq_ajax');
Route::post('deleteprereq/{id}','admindashboardcontroller@deleteprereq_ajax');
//ADMIN DASHBOARD ENDS
//STUDENT DASHBOARD
Route::get('student/dashboard','admindashboardcontroller@s_dashboard');
//STUDENT DASHBOARD ENDS
//TEACHER DASHBOARD
Route::get('teacher/dashboard','admindashboardcontroller@t_dashboard');
//TEACHER DASHBOARD ENDS

