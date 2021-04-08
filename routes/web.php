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

/*Route::get('/', function () {
    return view('quiz');
});*/

//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/addbasic', 'HomeController@store')->name('home');
Route::post('/editbasic/{id}', 'HomeController@update')->name('home');
Route::post('/storeQuiz', 'HomeController@storeQuiz')->name('home');
Route::post('/editQuiz', 'HomeController@editQuiz');
Route::post('/publishQuiz', 'HomeController@publishQuiz');
Route::delete('/deleteQuiz/{id}', 'HomeController@destroy')->name('home');
Route::get('/matrix/{quizId}', 'HomeController@matrixData')->name('home');
Route::post('/matrixFilter/{quizId}', 'HomeController@matrixFilterData')->name('home');
Route::post('/getResponse', 'HomeController@getResponse')->name('home');


Route::get('/quiz/{id}', 'SelectController@index');
Route::post('/addData', 'SelectController@store');
Route::post('/editData/{id}', 'SelectController@update')->name('home');
Route::post('/deleteData/{id}', 'SelectController@destroy');
Route::post('/check_frame', 'SelectController@check_frame');
Route::post('/change_info/{id}', 'SelectController@change_info');
Route::post('/sortingFrame', 'SelectController@sortingFrame');
Route::post('/framePrev', 'SelectController@framePrev');

Route::get('/publish/{id}', 'PublishController@index')->name('home');
Route::post('/addDataLink', 'PublishController@store')->name('home');
Route::post('/editDataLink/{id}', 'PublishController@update')->name('home');

Route::post('/appendFrame', 'SelectController@addFrame')->name('home');

Route::get('/color', 'ColorController@index')->name('home');
Route::post('/addcolor', 'ColorController@store');
Route::post('/editColData/{id}', 'ColorController@update')->name('home');
Route::post('/deleteColData/{id}/{frameid}', 'ColorController@destroy');
Route::post('/selectedCol', 'ColorController@selectData');
Route::post('/check_Color', 'ColorController@check_Color');
Route::post('/sortingColor', 'ColorController@sortingColor');
Route::post('/change_info_col/{id}', 'ColorController@change_info_col');


Route::get('/mmquiz/{id}', 'QuizController@index')->name('home');
Route::get('/mmquiz/next/{id}', 'QuizController@frameSelect')->name('home');
Route::get('/quizs_color/{id}/{qid}', 'QuizController@frameColor')->name('home');
Route::get('/quizsFcolor/{cid}/{qid}/{allframe}', 'QuizController@SelframeColor')->name('home');
Route::get('/404', 'QuizController@quizNotFound')->name('home');
Route::post('/finish_Quiz/{quizId}/{type}', 'QuizController@finish_Quiz')->name('home');


Route::post('/frame_col_add', 'Frame_colController@store');
Route::post('/frame_col_edit/{id}', 'Frame_colController@update')->name('home');
Route::post('/deleteFColData/{id}/{frameid}', 'Frame_colController@destroy');
Route::post('/sortingFrameColor', 'Frame_colController@sortingFrameColor');
Route::post('/selectedFrameCol', 'Frame_colController@selectedFrameCol');
Route::post('/check_FColor', 'Frame_colController@check_FColor');








