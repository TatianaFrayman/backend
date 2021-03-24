<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get("posts", [PostController::class, "index"])
    -> name("posts.index");

Route::get("posts/{post}", [PostController::class, "show"])
    -> name("posts.show");

Route::post("posts", [PostController::class, "store"])
    -> name("posts.store");

Route::put("posts/{post}", [PostController::class, "update"])
    -> name("posts.update");

Route::delete("posts/{post}", [PostController::class, "destroy"])
    -> name("posts.destroy");
