<?php
/**
 * Created by Decipher Lab.
 * User: Prabakar
 * Date: 19-Mar-18
 * Time: 8:49 PM
 */
//switch between language


Route::group(['middleware' => ['web']], function () {
    Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
    Route::get('translation','LanguageController@index');
    Route::get('translation/add','LanguageController@add');
    Route::post('translation/add','LanguageController@save');
    Route::post('translation/save','LanguageController@update');
    Route::get('translation/remove/{folder}','LanguageController@remove');
});