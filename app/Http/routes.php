<?php
Route::get('/', 'HomeController@index');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('dashboard', ['middleware' => 'auth', function() {
	$text = "Lorem ipsum dolor sit amet";

	$arr = preg_split("/[\s,.;:\/*\-\+1-9]+/", $text);
	$res = [];

	array_walk($arr, function(&$value, $key) use (&$res) {
		$res['words'][$key]['form'] = $value;
		$res['words'][$key]['properties'] = [];
	});

	$res['owner'] = 1;

	// dd($res);

	/*for ($i=0; $i < 10000; $i++) { 
		App\Test::create($res);
	}*/
	

	// return App\Test::where('words', 'elemMatch', ['form' => ['$eq' => 'finibus']])->count();
	// return App\Test::find('55ab99180b6ff6fc76393f31');
}]);