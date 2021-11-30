<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

## FASE 1 ""
Route::post('/story/store', 'StoryController@store')->name('story.store');
Route::post('/story/edit', 'StoryController@getByStoryId')->name('story.edit');
Route::get('/story/index', 'StoryController@index')->name('story.index');
Route::delete('/story/delete/{id}', 'StoryController@destroy')->name('story.delete');

## FASE 2 ##
Route::post('/midia/store', 'MidiaController@store')->name('midia.store');
Route::get('/midia/listByStory/{user_id}', 'MidiaController@getAllMidiasByStory')->name('midia.listByStory');
Route::delete('/midia/delete', 'MidiaController@destroyByUser')->name('midia.delete');

