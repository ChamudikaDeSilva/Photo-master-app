<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
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
Route::get('/', [FileController::class, 'index']);
Route::post('/upload-file', [FileController::class, 'imgToGreyscale'])->name('generateGrayscaleImg');

Route::get('/file-resize', [FileController::class, 'index1']);
Route::post('/resize-file', [FileController::class, 'resizeImage'])->name('resizeImage');
Route::get('/download/{filename}', [FileController::class,'download'])->name('download');

Route::get('/convert', [FileController::class, 'showForm'])->name('showConvertForm');
Route::post('/convert', [FileController::class, 'convert'])->name('convertImage');

Route::get('/index2', [FileController::class, 'index2'])->name('index');
Route::post('/adjust-contrast', [FileController::class, 'adjustContrast'])->name('adjustContrast');
