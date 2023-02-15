<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\api\StudentDetailsController;
use App\Http\Resources\CourseWithStudentResource;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//jun kura lai after login matra dekhaune tarika
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('student', StudentController::class);
Route::post("/logout", [AuthController::class, 'logout']);

});


Route::apiResource('course', CourseController::class);
// Route::apiResource('student', StudentController::class);

//auth
Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);
Route::post("/forgot-password", [AuthController::class, 'forgotPassword']);


