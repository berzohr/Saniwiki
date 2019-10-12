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

use Illuminate\Http\Request;

Auth::routes();

Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

//          NOME ROUTE      NOMECONTROLLER @ FUNZIONE
Route::post('addCategory', 'FormController@store');
Route::post('editCategory', 'FormController@edit');
Route::post('addPost/{categoryId}', 'PostController@store');
Route::post('/addUser', 'UserController@store');

//id viene inviato al controller grazie 'uses', dove bisognerà inserirlo nella testata del metodo show($id){....}
Route::get('/pages/{categoryId}', 'PostController@index');
//visualizzazione singola pagina
Route::get('/post/{id}', 'PostController@show');
Route::get('/postEdit/{id}', 'PostController@edit');
Route::post('/postEdit', 'PostController@save');
Route::resource('category', 'CategoryController');
Route::resource('post', 'PostController');
Route::resource('user', 'UserController');
Route::get('/api/sections/{categoryId}', 'SectionController@show');
Route::get('/users', 'UserController@index')->name('users');
Route::get('/changePassword/{id}', 'UserController@show');
Route::patch('/changePassword/{id}',[
    'as' => 'user.password.update',
    'uses' => 'UserController@changePassword'
]);
Route::get('search', 'SearchController@search');

//altri vecchi....

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/wiki', function () {
    $sections = \App\Section::all();
    return view('wiki', ['sections' => $sections]);
});



