<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FtoorahController;
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

Route::get('callback',[FtoorahController::class,'callback']);
Route::get('error',[FtoorahController::class,'error']);