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


//auth
Route::get('admin', 'AuthController@getLogin');
Route::get('/', 'AuthController@getLogin');
Route::get('admin/login', 'AuthController@getLogin');
Route::post('admin/login', 'AuthController@postLogin');
Route::get('admin/logout', 'AuthController@getLogout');


Route::group(['prefix' => 'admin', 'middleware' => 'authentication_admin'], function () {
    Route::group(['prefix' => 'topic'], function () {

        Route::get('list-topic', 'TopicController@getList');
        Route::get('add-topic', 'TopicController@getAddTopic');
        Route::post('add-topic', 'TopicController@postAddTopic');

        Route::get('edit-topic/{id}', 'TopicController@getEditTopic');
        Route::post('edit-topic/{id}', 'TopicController@postEditTopic');
        Route::get('delete-topic/{id}', 'TopicController@getDelete');
    });

    Route::group(['prefix' => 'game'], function () {

        Route::get('list-game', 'GameController@getList');
        Route::get('add-game', 'GameController@getAddGame');
        Route::post('add-game', 'GameController@postAddGame');

        Route::get('edit-game/{id}', 'GameController@getEditGame');
        Route::post('edit-game/{id}', 'GameController@postEditGame');
        Route::get('delete-game/{id}', 'GameController@getDelete');
    });

    Route::group(['prefix' => 'activity'], function () {

        Route::get('list-activity', 'ActivityController@getList');
        Route::get('add-activity', 'ActivityController@getAddActivity');
        Route::post('add-activity', 'ActivityController@postAddActivity');

        Route::get('edit-activity/{id}', 'ActivityController@getEditActivity');
        Route::post('edit-activity/{id}', 'ActivityController@postEditActivity');
        Route::get('delete-activity/{id}', 'ActivityController@getDelete');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('list-user', 'UserController@getListUser');

    });

    Route::group(['prefix' => 'staff'], function () {
        Route::get('list-staff', 'UserController@getListStaff');

        Route::get('add-staff', 'UserController@getAddStaff');
        Route::post('add-staff', 'UserController@postAddStaff');

        Route::get('delete-staff/{id}', 'UserController@getDelete');

        Route::get('edit-staff/{id}', 'UserController@getEditStaff');
        Route::post('edit-staff/{id}', 'UserController@postEditStaff');

        Route::get('edit-profile/{id}', 'UserController@getEditProfile');
        Route::post('edit-profile/{id}', 'UserController@postEditProfile');

    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('report-total', 'DashboardController@reportTotal');
    });

});

