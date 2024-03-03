<?php

use App\Http\Controllers\ExploreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;


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
    return view('pages.index');
});
// Routes untuk autentikasi dan manajemen pengguna
// Route untuk menampilkan form sign-in
Route::get('/sign_in', [GalleryController::class, 'sign_in'])->name('login');

// Route untuk memproses pengiriman form sign-in
Route::post('/cek_akun', [GalleryController::class, 'cek_akun']);

// Route untuk menampilkan form sign-up
Route::get('/sign_up', [GalleryController::class, 'sign_up']);

// Route untuk memproses pengiriman form sign-up
Route::post('/buat_akun', [GalleryController::class, 'buat_akun']);

// Routes yang dilindungi oleh middleware autentikasi



Route::middleware(['auth'])->group(function () {
    //hapus foto
    Route::delete('/foto/{id}', [GalleryController::class, 'destroy'])->name('foto.destroy');
    // Route untuk menampilkan halaman jelajahi
    Route::get('/explore', [GalleryController::class, 'explore']);

    // Route untuk mengambil data untuk halaman jelajahi
    Route::get('/getDataExplore', [ExploreController::class, 'getData']);

    // Route untuk menyukai foto
    Route::post('/likefotos', [ExploreController::class, 'likefotos']);

    // Route untuk menampilkan form unggah foto
    Route::get('/upload_foto', [GalleryController::class, 'upload_foto']);

    // Route untuk memproses unggah foto
    Route::post('/unggah_foto', [GalleryController::class, 'unggah_foto']);

    // Route untuk menambahkan album baru
    Route::post('/tambah_album', [GalleryController::class, 'tambah_album']);

    // Route untuk menampilkan komentar
    Route::get('/komen', [GalleryController::class, 'komen']);

    // Route untuk mengirimkan komentar
    Route::post('/tulis_komentar', [GalleryController::class, 'tulis_komentar']);

    // Route untuk menampilkan profil pengguna
    Route::get('/profil', [GalleryController::class, 'profile']);

    // Route untuk memperbarui informasi profil pengguna
    Route::post('/update_profile', [GalleryController::class, 'update_profile']);
   

    // Route untuk memperbarui kata sandi pengguna
    Route::post('/update_password', [GalleryController::class, 'update_password']);

    // Route untuk logout pengguna
    Route::get('/logout', [GalleryController::class, 'logout']);

    // Route untuk menampilkan detail foto pada halaman jelajahi
    Route::get('/explore-detail/{id}', [GalleryController::class, 'explore_detail']);

    // Route untuk mengambil data detail foto
    Route::get('/explore-detail/{id}/getdatadetail', [ExploreController::class, 'getdatadetail']);
    

    // Route untuk mengambil komentar untuk sebuah foto
    Route::get('/explore-detail/getComment/{id}', [ExploreController::class, 'ambildatakomentar']);
     // Route untuk mengambil komentar untuk sebuah foto
     Route::post('/explore-detail/kirimkomentar', [ExploreController::class, 'kirimkomentar']);
     Route::get('/album/{id}', [GalleryController::class, 'show'])->name('album.show');
     Route::get('/profil_user/{id}', [GalleryController::class, 'profil_other']);
     Route::get('/profil_user/getDataProfil/{id}', [GalleryController::class, 'getData']);
     Route::get('/getfotouser', [GalleryController::class, 'getdataa']);

});































// Route::get('/sign_in', [GalleryController::class, 'sign_in'])->name('login');
// Route::post('/cek_akun', [GalleryController::class, 'cek_akun']);
// Route::get('/sign_up', [GalleryController::class, 'sign_up']);
// Route::post('/buat_akun', [GalleryController::class, 'buat_akun']);

// Route::middleware(['auth'])->group(function () {
//     Route::get('/explore', [GalleryController::class, 'explore']);
//     Route::get('/getDataExplore', [ExploreController::class, 'getData']);
//     Route::post('/likefotos', [ExploreController::class, 'likefotos']);
//     Route::get('/upload_foto', [GalleryController::class, 'upload_foto']);
//     Route::post('/unggah_foto', [GalleryController::class, 'unggah_foto']);
//     Route::post('/tambah_album', [GalleryController::class, 'tambah_album']);
//     Route::get('/komen', [GalleryController::class, 'komen']);
//     Route::post('/tulis_komentar', [GalleryController::class, 'tulis_komentar']);
//     Route::get('/profile', [GalleryController::class, 'profile']);
//     Route::post('/update_profile', [GalleryController::class, 'update_profile']);
//     Route::post('/update_password', [GalleryController::class, 'update_password']);
//     Route::get('/logout', [GalleryController::class, 'logout']);
//     Route::get('/explore-detail/{id}', [GalleryController::class, 'explore_detail']);
//     Route::get('/explore-detail/{id}/getdatadetail', [ExploreController::class, 'getdatadetail']);
//     Route::get('/explore-detail/getComment/{id}', [GalleryController::class, 'ambildatakomentar']);
    
// });
