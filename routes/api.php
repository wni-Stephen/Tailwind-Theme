<?php

use App\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| Enjoy building your API!
|
*/

Route::post('contact/general', array( \App\Controllers\Api\ContactController::class, 'general'));