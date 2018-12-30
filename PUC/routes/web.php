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
//SESSION ENDS
