<?php

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('blog', [PostController::class, 'index']);
Route::get('blog/add', [PostController::class, 'add']);

Route::get('/message/chat', [MessagesController::class, 'index']);
Route::post('/message/chat', [MessagesController::class, 'chat']);
Route::get('/login/{id}', function ($id) {
    Session::put('id', $id);
    return back();
})->name('login');
