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

Route::get('/', function () {
    return view('index');
});


Route::get('/home', 'HomeController@index')->name('home');
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

Route::get('/test','\App\Http\Controllers\Auth\RegisterController@UserActivationMail');
Route::get('/user/activation/{id}/{activation_code}','\App\Http\Controllers\UserController@getActivate')->name('activation_code');
//Route::get('/user/password/reset','Auth\ResetPasswordController@ResetPassworsView');
//Route::get('/user/reset/paswword','Auth\ResetPasswordController@ResetPassworsEmailGo');
//Route::get('/user/password/resetemail',function(){return view('auth.passwords.reset');});
Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@authorization');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/user', 'UserController@cabinet');
  Route::get('/logout','UserController@logout');
});

Route::get('/data/regions', '\App\Http\Controllers\SelectController@DataSelectRegions');
Route::get('/data/categoreys', '\App\Http\Controllers\SelectController@DataSelectCategorey');
Route::get('/data/city/{id_region}', '\App\Http\Controllers\SelectController@DataDelectCitys');
//Route::get('/data/type/{id_categorys}','App\Http\Controllers\SelectController@DataDelectCitys')

Route::get('/json/breeds', function(){
//  $fail = file_get_contents('json/citys.json', true);
//  $arrayJson = json_decode($fail);
$poroda_sobak = DB::table('poroda_sobak')->get();
//  dd($porada_koshek);
  $trans = array("а" => "a", "б" => "b", "в" => "v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"e", "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"y", "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"shch", "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu", "я"=>"ya"," "=>"-");
    //  strtr(mb_strtolower($str), $trans);
      foreach ($poroda_sobak as $key => $value) {
    //   DB::insert('insert into breeds (name, id_categorys, url) values (?, ?, ?)', [$value->name, 3, strtr(mb_strtolower($value->name), $trans)]);
       }
       dd('Гут');});
//Route::get('/test','\App\Http\Controllers\SelectController@CategoreyType');
