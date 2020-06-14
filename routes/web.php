<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;

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

// For testing access without roles
Route::middleware('auth:api')
    ->get('/user', function (Illuminate\Http\Request $request) {
        return $request->user();
    });

Route::prefix('/api/news/')
    ->group(function () {
        Route::get('/', 'NewsController@list');
        Route::post('/add', 'NewsController@add')
            ->middleware('auth:api', 'role:Admin');
    });
