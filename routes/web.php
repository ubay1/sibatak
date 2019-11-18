<?php

// Route::prefix('admin')->group(function(){
//     // user authentication
//     Route::get('/', 'UserController@index');
//     Route::get('login', 'Auth\LoginController@login');
//     Route::post('loginpost', 'Auth\LoginController@loginpost');
//     Route::get('logout', 'Auth\LoginController@logout');
//     //end user authentication

//     Route::resource('kelolaAbout', 'AboutController');
//     Route::resource('kelolaVisiMisi', 'VisiMisiController');
//     Route::resource('kelolaCase', 'CaseController');
//     Route::resource('kelolaCasePopuler', 'CasePopulerController');
//     Route::resource('kelolaBlog', 'BlogController');
//     Route::resource('kelolaBlogPopuler', 'BlogPopulerController');
// });
// Route::prefix('email')->group(function(){
//     Route::get('/success',function(){
//         return view('email_service/success');
//     });
// });

// Route::get('/{any}', 'SpaController@index')->where('any', '.*');
Route::get('/{any}', function () {
    return view('spa');
})->where('any', '.*');
