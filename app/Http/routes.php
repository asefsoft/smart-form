<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * index
 */


/**
 * login controller
 */
get('login', 'AuthController@login');


get('/',['as'=>'index_forms','uses'=>'FormController@index']); // list of forms
get('create',['as'=>'create_form','uses'=>'FormController@create']); // create new form
post('create','FormController@store');      //save form on db (new form)
get('edit/{id}',['as'=>'edit_form','uses'=>'FormController@edit']);     // show edit form
post('edit/{id}','FormController@store');   // save form on db (edit form)
get('delete/{id}',['as'=>'delete_form','uses'=>'FormController@delete']);     // delete form


get('fill/{id}',['as'=>'show_fill','uses'=>'FormController@show_fill']); // show fill form
post('fill/{id}','FormController@store_fill'); // save filled form
get('filled/show/{id}',['as'=>'show_filled_form','uses'=>'FormController@show_filled_form']); // show filled form
get('filled/delete{id}',['as'=>'delete_filled_form','uses'=>'FormController@delete_filled_form']);   // delete filled form

get('filled/{id}',['as'=>'show_filled_forms','uses'=>'FormController@show_filled_forms']);   // show filled forms of this form


// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);




