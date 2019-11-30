<?php

use Illuminate\Http\Request;

Route::prefix('user')->group(function(){
    Route::post('login_user', 'User\UserController@LoginUser');
    Route::post('register', 'User\UserController@RegisterUser');
    Route::post('refresh_token', 'User\UserController@refresh_token');

    Route::middleware(['auth:api'])->group(function(){
        Route::post('logout', 'User\UserController@logout');
        Route::get('getuser', 'User\UserController@getuser');
    });
});

Route::prefix('admin')->group(function(){
    Route::resource('kelolaAbout', 'AboutController');
    Route::post('updatedataAbout', 'AboutController@update');
    Route::get('hapusdataAbout/{id}', 'AboutController@destroy');

    Route::resource('kelolaVisiMisi', 'VisiMisiController');
    Route::post('updatedataVisiMisi', 'VisiMisiController@update');
    Route::get('hapusdataVisiMisi/{id}', 'VisiMisiController@destroy');

    Route::resource('kelolaCase', 'CaseController');
    Route::post('updatedataCase', 'CaseController@update');
    Route::get('hapusdataCase/{id}', 'CaseController@destroy');
    Route::get('getallcase', 'CaseController@getallcase'); // for admin

    Route::resource('kelolaCasePopuler', 'CasePopulerController');
    Route::post('updatedataCasePopuler', 'CasePopulerController@update');
    Route::get('hapusdataCasePopuler/{id}', 'CasePopulerController@destroy');
    Route::get('getallcasePopuler', 'CasePopulerController@getallcase'); // for admin

    Route::resource('kelolaBlog', 'BlogController');
    Route::post('updatedataBlog', 'BlogController@update');
    Route::get('hapusdataBlog/{id}', 'BlogController@destroy');
    Route::get('getallblog', 'BlogController@getallblogadmin'); // for admin

    Route::resource('kelolaBlogPopuler', 'BlogPopulerController');
    Route::post('updatedataBlogPopuler', 'BlogPopulerController@update');
    Route::get('hapusdataBlogPopuler/{id}', 'BlogPopulerController@destroy');
    Route::get('getallblogPopuler', 'BlogPopulerController@getallblogadmin'); // for admin
});

// Route::post('loginpost', 'Auth\LoginController@loginpost');
// Route::get('getAllData', 'Auth\LoginController@getAllData');

// api teknisi



