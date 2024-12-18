<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// use Backpack\CRUD\app\Http\Controllers\CrudController;
// use App\Http\Controllers\Admin\BoulderingCrudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
//     Route::crud('bouldering', BoulderingCrudController::class);
// });
Route::get('/', function () {
    return Inertia::render('Home');
});
