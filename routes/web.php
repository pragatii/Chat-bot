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
    return view('welcome');
});

Route::any('/chatbot-message' , function () {
    \App\Services\SimplifiiDatabaseService::locationsMarkedOnSingleDAy("2017-09-27");
  /* $wit_service = new \App\Services\WitService();
   $query = "My all locations marked today";
   $wit_service->getEntities($query);*/
});

Route::any('/ask', 'ChatController@ask' );
