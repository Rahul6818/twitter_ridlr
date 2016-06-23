<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/



namespace App\Http\Controllers;
use App\Tweet;
use Illuminate\Http\Request;


$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('encode', function (\Illuminate\Http\Request $request) {

    return response()->json([

        'result' => base64_encode($request->input('value')),

    ]);

});



$app->get('decode', function (\Illuminate\Http\Request $request) {

    return response()->json([

        'result' => base64_decode($request->input('value')),

    ]);

});



$app->group(['prefix' => 'api/v1','namespace'=> 'App/Http/Controllers'],function($app){
	$app->group(['prefix'=>'tweet'],function($app){
		$app->get('/','App\Http\Controllers\TweetController@index');
		$app->get('{id}','App\Http\Controllers\TweetController@read');
		$app->post('/','App\Http\Controllers\TweetController@create');
		$app->put('{id}','App\Http\Controllers\TweetController@update');
		$app->delete('{id}','App\Http\Controllers\TweetController@delete');
	});
});

?>
