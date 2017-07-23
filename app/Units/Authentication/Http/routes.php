<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::get('/', function() {
    return ['name' => 'Jean Gomes Pereira', 'birth_date' => '1990/08/11', 'sexo' => 'M'];
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
