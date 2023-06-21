<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


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

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/reload-captcha', [App\Http\Controllers\Auth\RegisterController::class, 'reloadCaptcha']);
Route::get('/reloadcaptcha', [App\Http\Controllers\Auth\LoginController::class, 'reloadCaptchas']);

/* Route Pegawai dan Sipil */
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');//->middleware('checkUserLevel');
Route::get('/konsultasi_pengaduan/konsultasi_online', [App\Http\Controllers\UserController::class, 'konsultasi'])->name('konsultasi');//->middleware('checkUserLevel');
Route::get('/konsultasi_pengaduan/konsultasi_online/konsultasi_baru', [App\Http\Controllers\UserController::class, 'konsultasiBaru'])->name('konsultasiBaru');
Route::get('/konsultasi_pengaduan/konsultasi_online/konsultasi_detail/{roomID}', [App\Http\Controllers\UserController::class, 'konsultasiDetail'])->name('konsultasiDetail');
Route::post('addConsult', [App\Http\Controllers\UserController::class, 'addConsult'])->name('addConsult');    

Route::get('/layanan_administrasi/surat_bebas_temuan_pemeriksaan', [App\Http\Controllers\UserController::class, 'sbt'])->name('sbt');//->middleware('checkUserLevel');
Route::get('/layanan_administrasi/surat_bebas_temuan_pemeriksaan/permohonan_baru/{id}', [App\Http\Controllers\UserController::class, 'addsbt'])->name('addsbt');//->middleware('checkUserLevel');
Route::post('add_sbt_request', [App\Http\Controllers\UserController::class, 'add_sbt_request'])->name('add_sbt_request');    
Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('store');    
Route::post('storeSKTP', [App\Http\Controllers\UserController::class, 'storeSKTP'])->name('storeSKTP');    
Route::post('is_upload/{id}', [App\Http\Controllers\UserController::class, 'is_upload'])->name('is_upload');    
Route::post('is_upload_sktp/{id}', [App\Http\Controllers\UserController::class, 'is_upload_sktp'])->name('is_upload_sktp    ');   
Route::get('/layanan_administrasi/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin', [App\Http\Controllers\UserController::class, 'sktp'])->name('sktp');//->middleware('checkUserLevel');
Route::get('/layanan_administrasi/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin/permohonan_baru/{id}', [App\Http\Controllers\UserController::class, 'addsktp'])->name('addsktp');//->middleware('checkUserLevel');
Route::post('add_sktp_request', [App\Http\Controllers\UserController::class, 'add_sktp_request'])->name('add_sktp_request');    
Route::get('/surat/{id}', [App\Http\Controllers\UserController::class, 'template_sbt'])->name('template_sbt');//->middleware('checkUserLevel');





/* Route SuperAdmin, Irban dan verfikator */
Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');
Route::get('admin/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('admin');

//Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->middleware('admin');
Route::get('admin/dataAdmin', [App\Http\Controllers\HomeController::class, 'dataAdmin'])->name('dataAdmin')->middleware('admin');
Route::post('addAdmin', [App\Http\Controllers\HomeController::class, 'addAdmin'])->name('addAdmin')->middleware('admin');    
Route::get('admin/dataAdmin/deleteAdmin/{id}', [App\Http\Controllers\HomeController::class, 'deleteAdmin'])->name('deleteAdmin')->middleware('admin');
Route::get('/konsultasi_online/daftar_konsultasi', [App\Http\Controllers\HomeController::class, 'konsultasi'])->name('konsultasi');//->middleware('checkUserLevel');
Route::get('/konsultasi_online/daftar_konsultasi/konsultasi_detail/{roomID}', [App\Http\Controllers\HomeController::class, 'konsultasiDetail'])->name('konsultasiDetail');
Route::post('updateStatus/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('updateStatus')->middleware('admin');
Route::put('updateMessage/{id}', [App\Http\Controllers\HomeController::class, 'updateMessage'])->name('updateMessage')->middleware('admin');    
Route::post('updateComment/{id}', [App\Http\Controllers\HomeController::class, 'updateComment'])->name('updateComment')->middleware('admin');    

Route::post('addMessage', [App\Http\Controllers\HomeController::class, 'addMessage'])->name('addMessage');    

Route::get('/surat_bebas_temuan_pemeriksaan', [App\Http\Controllers\HomeController::class, 'sbt'])->name('sbt');//->middleware('checkUserLevel');
Route::get('/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin', [App\Http\Controllers\HomeController::class, 'sktp'])->name('sktp');//->middleware('checkUserLevel');
Route::get('/surat_bebas_temuan_pemeriksaan/permohonan_baru/{id}', [App\Http\Controllers\HomeController::class, 'addsbt'])->name('addsbt');//->middleware('checkUserLevel');
Route::get('/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin/permohonan_baru/{id}', [App\Http\Controllers\HomeController::class, 'addsktp'])->name('addsktp');//->middleware('checkUserLevel');


Route::post('updateMessageSBT/{id}', [App\Http\Controllers\HomeController::class, 'updateMessageSBT'])->name('updateMessageSBT')->middleware('admin');    
Route::post('create_surat_sbt', [App\Http\Controllers\HomeController::class, 'create_surat_sbt'])->name('create_surat_sbt');    

Route::get('/surat_bebas_temuan_pemeriksaan/{id}', [App\Http\Controllers\HomeController::class, 'template_sbt'])->name('template_sbt');//->middleware('checkUserLevel');
Route::post('updateSbt/{id}', [App\Http\Controllers\HomeController::class, 'updateSbt'])->name('updateSbt')->middleware('admin');    
Route::post('updateSKTP/{id}', [App\Http\Controllers\HomeController::class, 'updateSKTP'])->name('updateSKTP')->middleware('admin');    

Route::post('updateMessageSKTP/{id}', [App\Http\Controllers\HomeController::class, 'updateMessageSKTP'])->name('updateMessageSKTP')->middleware('admin');    



