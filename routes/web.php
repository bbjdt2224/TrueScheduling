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
    return redirect( route('login') );
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/editClasses', 'HomeController@editClasses')->name('editClasses');

Route::get('/editwork', 'HomeController@editWork')->name('editWork');

Route::get('/editclubs', 'HomeController@editClubs')->name('editClubs');

Route::post('/classes', 'HomeController@changeClasses')->name('classes');

Route::post('/work', 'HomeController@changeWork')->name('work');

Route::post('/clubs', 'HomeController@changeClubs')->name('clubs');

Route::get('/group/join', 'GroupsController@joinGroup')->name('join');

Route::post('group/join', 'GroupsController@join')->name('join');

Route::get('group/start', 'GroupsController@startGroup')->name('start');

Route::post('group/start', 'GroupsController@create')->name('start');

Route::get('/groupHome/{id}/{page}', 'GroupsController@showHome')->name('groupHome');

Route::post('/groupHome/{id}/{page}', 'GroupsController@changeDay')->name('groupHome');

Route::get('/addEvent/{id}', 'EventsController@addEvent')->name('addEvent');

Route::post('addEvent', 'EventsController@add')->name('add');

Route::get('/addFutureEvent{id}', 'FutureEventsController@addEvent')->name('addFutureEvent');

Route::post('/addFutureEvent', 'FutureEventsController@add')->name('addFuture');

Route::get('/openEvent/{id}', 'FutureEventsController@openEvent')->name('openEvent');

Route::get('/editEvent/{id}', 'FutureEventsController@editEvent')->name('editEvent');

Route::get('/viewResults/{id}', 'FutureEventsController@viewResults')->name('viewResults');

Route::post('/save', 'FutureEventsController@save')->name('save');

Route::post('/edit', 'FutureEventsController@edit')->name('edit');

Route::get('/addVoulenteer/{id}', 'VoulenteerController@addEvent')->name('addVoulenteer');

Route::post('/addVoulenteer', 'VoulenteerController@add')->name('addVoulenteerEvent');

Route::get('/openVoulenteer/{id}', 'VoulenteerController@open')->name('openVoulenteer');

Route::post('/addVoulenteers', 'VoulenteerController@addVoulenteer')->name('addVoulenteers');

Route::post('/changeSemester', 'HomeController@changeSemester')->name('changeSemester');

Route::post('/addMessage', 'MessagesController@post')->name('addMessage');

Route::get('/editUser', 'HomeController@editUser')->name('editUser');

Route::post('/editUser', 'HomeController@edit')->name('userEdit');

Route::get('/editGroup/{id}', 'GroupsController@editGroup')->name('editGroup');

Route::post('/editGroup', 'GroupsController@edit')->name('groupEdit');

Route::get('/deleteGroup/{id}', 'GroupsController@delete')->name('deleteGroup');

Route::get('/deletedGroups', 'GroupsController@viewDeleted')->name('deletedGroups');

Route::get('/reviveGroup/{id}', 'GroupsController@revive')->name('revive');
