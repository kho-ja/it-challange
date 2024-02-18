<?php

use App\Http\Controllers\YouTubeCommentController;
use App\Models\YouTubeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("sentiment", [YouTubeCommentController::class, "sentimentAnalysis"]);
Route::get("search", [YouTubeCommentController::class, "searchComments"]);
Route::get("getCommentLineChart", [YouTubeCommentController::class, "getCommentLineChart"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
