<?php


/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () 
{
	Route::get('/home', array('as' => 'home', 'uses' => 'HomeController@index'));
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

	Route::get('/registreer', array('as' => 'registreer', 'uses' => 'RegistreerController@getRegistreer'));
	Route::post('/registreer', array('uses' => 'RegistreerController@postRegistreer'));

/* Authenticated users */

	Route::get('/login', array('as' => 'login', 'uses' => 'LoginController@getLogin' ));
	Route::post('login', array('uses' => 'LoginController@postLogin'));
	Route::get('/logout', array('as' => 'logout', 'uses' => 'LoginController@getLogout'));

	Route::get('/dashboard', array('as' => 'home', 'uses' => 'DashboardController@index'));

	Route::get('/todos', array('as' => 'todos', 'uses' => 'ToDoController@getTodos'));
	Route::post('/todos', array('uses' => 'TodoController@postIndex'));

	Route::get('/todos/new', array('as' => 'new', 'uses' => 'TodoController@getNew'));
	Route::post('/todos/new', array('uses' => 'TodoController@postNew'));

	Route::get('/todos/delete/{task}', array('as' => 'delete', 'uses' => 'TodoController@getDelete'));

	Route::bind('task', function($value, $route)
	{
		return App\Todo::where('id', $value)->first();
	});



	




});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

