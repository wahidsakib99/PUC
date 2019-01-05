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
