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
Auth::routes();

Route::get('/', 'HomeController@index');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/registration', function(){
    return view('auth.register');
});

Route::post('/registration', '\App\Http\Controllers\Auth\RegisterController@RegistrationUser')->name('registration');
Auth::routes();


Route::get('/message', function(){  return view('message');
    if(Session::has('message')){
    return view('message');
    } else {
     return   redirect()->back();
    }
});

//Route::get('/test','\App\Http\Controllers\Auth\RegisterController@UserActivationMail');
Route::get('/user/activation/{id}/{activation_code}','\App\Http\Controllers\UserController@getActivate')->name('activation_code');
//Route::get('/user/password/reset','Auth\ResetPasswordController@ResetPassworsView');
//Route::get('/user/reset/paswword','Auth\ResetPasswordController@ResetPassworsEmailGo');
//Route::get('/user/password/resetemail',function(){return view('auth.passwords.reset');});
Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@authorization');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/user', 'UserController@cabinet');
  Route::get('/logout','UserController@logout');

  Route::get('/ad/add','\App\Http\Controllers\AdController@ViewAdAdd')->middleware('auth');
  Route::post('/ad/add','\App\Http\Controllers\AdController@AdAdd');
  Route::post('/ad/fails','\App\Http\Controllers\AdController@addImg');
});

Route::get('/data/regions', '\App\Http\Controllers\SelectController@RegionsJson');
Route::get('/data/categoreys', '\App\Http\Controllers\SelectController@CategoreyJson');
Route::get('/data/city/{id_region}', '\App\Http\Controllers\SelectController@DataDelectCitys');
Route::get('/data/breeds/{id_categorys}','\App\Http\Controllers\SelectController@DataSelectBreed');
Route::get('/data/tip/{id_categorys}','\App\Http\Controllers\SelectController@CategoreyType');
Route::get('/data/categoreys/addition/{id_categorys}','\App\Http\Controllers\SelectController@CategoreyVozrastPol');
Route::get('/data/pol','\App\Http\Controllers\SelectController@PolAll');
Route::get('/data/vozrast','\App\Http\Controllers\SelectController@VozrastAll');

Route::group(['prefix'=>'fuhrer','middleware'=>'role:admin'], function(){
    Route::get('/','\App\Http\Controllers\Admin\AdminController@index');
    Route::get('/select','\App\Http\Controllers\Admin\AdminController@selects');

});

Route::get('/roles', '\App\Http\Controllers\Test@roleTest');
Route::get('/test', function(){
    $ad = App\Ad::find(2);
  dd($ad->CategoryGet());
});
Route::get('/citys/database/get','\App\Http\Controllers\SelectController@FailGet');
