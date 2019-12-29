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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('test','test');

Route::prefix('admin')->middleware(['auth','password.confirm'])->group(function (){

    Route::view('/','Dashboard/admin');
    Route::Get('/welcome','WelcomeController@welcome');
    Route::resource('users','UserController');
    Route::resource('admins','AdminController');
    Route::resource('pages','PageController');
    Route::resource('posts','PostController');
    Route::resource('categories','CategoryController');
    Route::resource('roles','RoleController');
//Route::resource('tests','TestController');
    Route::post('upload', function (){
        $filename = sprintf('tiny%s.jpg',random_int(1,1000));
        if (request()->hasFile('file'))
            $filename = request()->file('file')->storeAs('tiny', $filename,'public');
        else
            $filename = null;
        if ($filename !== null) {
            return response()->json(['location' => url('storage/'.$filename)], 200);
        }
        else{
            return response()->json(['location' => 'file not uploaded'], 200);
        }
    });

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
