<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\SekretariatController2;
use App\Http\Controllers\QuarterDateController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\RegisterController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dekan-dashboard', function () {
//     return view('dekan.dekan-dashboard');
// });

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/dekan-login', function () {
//     return view('dekan.dekan-login');
// });

// Route::get('/dekan-register', function () {
//     return view('dekan.dekan-register');
// });


// Route::get('/login-mahasiswa', [AuthController::class, 'LoginMahasiswa'])->middleware('guest');
// Route::post('/post-login-mahasiswa', [AuthController::class, 'PostLoginMahasiswa']);

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware(['auth'])->group(function () {
});

Route::get('/dekan-register', function () {
    return view('dekan.dekan-register');
});

//Login Dekan
Route::get('/dekan-login', [AuthController::class, 'LoginDekan'])->middleware('guest')->name('dekan-login');
Route::post('/post-login-dekan', [AuthController::class, 'PostLoginDekan']);

//Login Sekretariat
Route::get('/sekretariat-login', [AuthController::class, 'LoginSekretariat'])->middleware('guest');
Route::post('/post-login-sekretariat', [AuthController::class, 'PostLoginSekretariat']);

//Login Sekretariat2
Route::get('/sekretariat2-login', [AuthController::class, 'LoginSekretariat2'])->middleware('guest')->name('sekretariat2-login');
Route::post('/post-login-sekretariat2', [AuthController::class, 'PostLoginSekretariat2']);

//Login Prodi
Route::get('/prodi-login', [AuthController::class, 'LoginProdi'])->middleware('guest')->name('prodi-login');
Route::post('/post-login-prodi', [AuthController::class, 'PostLoginProdi']);

//Login Prodi
Route::get('/kk-login', [AuthController::class, 'LoginKK'])->middleware('guest')->name('kk-login');
Route::post('/post-login-kk', [AuthController::class, 'PostLoginKK']);

//Login Dosen
Route::get('/dosen-login', [AuthController::class, 'LoginDosen'])->middleware('guest')->name('dosen-login');
Route::post('/post-login-dosen', [AuthController::class, 'PostLoginDosen']);

//LOGOUT
Route::get('/logout', [AuthController::class, 'logout']);


//DEKAN
Route::group(['middleware' => ['auth', 'rolecek:dekan,kaprodi,ketuaKK']], function () {

    // Search Dashboard (after login)
    Route::get('dekan-search', [DekanController::class, 'index']);

    // Detail Dosen
    Route::get('dekan-dosen-details/{NIP}', [DekanController::class, 'detailDosen'])->name('dekan-dosen-details');
    Route::get('dekan-tambah-sk/{NIP}', [DekanController::class, 'create'])->name('dekan-tambah-sk');
    Route::post('dekan-dosen-details/{NIP}', [DekanController::class, 'store'])->name('dekan-store-more-data');
    Route::delete('dekan-dosen-details/{NIP}', [DekanController::class, 'delete'])->name('dekan-dosen-details-delete');
    Route::get('dekan-search', [DekanController::class, 'index'])->name('dekan-search'); //kembali ke halaman search

    // Charts and Prints
    Route::get('dekan-charts', [DekanController::class, 'indexChart']);
    Route::get('/d-chart/data-sk', [DekanController::class, 'data_SK']);
    Route::get('/d-chart/data-sks', [DekanController::class, 'data_SKS']);

    // Prints routes
    Route::get('dekan-print-report', [DekanController::class, 'index'])->name('report.index');
    Route::get('dekan-print-report/{year}', [DekanController::class, 'report'])->name('report.generate');

    // Profile
    Route::get('profile', [DekanController::class, 'indexProfile'])->name('profile');
    Route::post('profile-update', [DekanController::class, 'updateProfile'])->name('profile-update');


});

// Sekretariat (Main Admin)
Route::group(['middleware' => ['auth', 'rolecek:sekretariat2']], function () {
    

    // Search Dashboard (after login)
    Route::get('sekretariat2-search', [DataDosenController::class, 'index']); //tampil search
    Route::get('sekretariat2-tambah-sk', [SekretariatController2::class, 'create'])->name('tambah-sk');
    Route::get('/getNama/{nip}', [SekretariatController2::class, 'getNama'])->name('getNama');
    Route::post('sekretariat2-store', [SekretariatController2::class, 'store'])->name('sekretariat2-store');

    // Undangan/Rekognisi
    Route::get('sekretariat2-tambah-undangan', [SekretariatController2::class, 'createUndangan'])->name('tambah-undangan');
    Route::get('/getNamaUdangan/{nip}', [SekretariatController2::class, 'getNamaUdangan'])->name('getNamaUdanga');
    Route::post('sekretariat2-store-undangan', [SekretariatController2::class, 'storeUndangan'])->name('sekretariat2-store-undangan');

    // Detail Dosen
    Route::get('sekretariat2-dosen-details/{NIP}', [DataDosenController::class, 'detailDosen'])->name('sekretariat2-dosen-details');
    Route::get('sekretariat2-tambah-sk/{NIP}', [DataDosenController::class, 'create'])->name('sekretariat2-tambah-sk');
    Route::post('sekretariat2-dosen-details/{NIP}', [DataDosenController::class, 'store'])->name('store-more-data');
    // Route::post('sekretariat2-dosen-details/{NIP}/store', [DataDosenController::class, 'store'])->name('store-more-data');
    Route::delete('sekretariat2-dosen-details/{NIP}', [DataDosenController::class, 'delete'])->name('sekretariat2-dosen-details-delete');
    Route::get('sekretariat2-search', [DataDosenController::class, 'index'])->name('sekretariat2-search'); //kembali ke halaman search
    Route::get('sekretariat2-dosen-edit/{NIP}', [DataDosenController::class, 'edit'])->name('sekretariat2-dosen-edit'); 
    Route::post('sekretariat2-dosen-edit/{NIP}', [DataDosenController::class, 'update'])->name('sekretariat2-dosen-update');
    Route::get('print/{NIP}', [DataDosenController::class, 'pdf'])->name('print');

    // Charts and Prints
    Route::get('sekretariat2-charts', [ChartController::class, 'index']);
    Route::get('/chart/data-sk', [ChartController::class, 'data_SK']);
    Route::get('/chart/data-sks', [ChartController::class, 'data_SKS']);
    Route::get('/chart/data-sk-prodi-semester', [ChartController::class, 'SK_Prodi_Semester']); 
    Route::get('/chart/data-sk-kk-semester', [ChartController::class, 'SK_KK_Semester']);
    Route::get('/chart/data-sks-Prodi-semester', [ChartController::class, 'SKS_Prodi_Semester']); 
    Route::get('/chart/data-sks-kk-semester', [ChartController::class, 'SKS_KK_Semester']); 
    
    // Prints routes
    Route::get('print-report', [ChartController::class, 'index'])->name('report.index');
    Route::get('print-report/{year}', [ChartController::class, 'report'])->name('report.generate');
    
    // Register
    Route::get('sekretariat2-register', [RegisterController::class, 'create']); // Display the registration form
    Route::post('sekretariat2-search', [RegisterController::class, 'store'])->name('register.store');
    
    Route::get('card', [CardController::class, 'index']);
});


//DOSEN
Route::group(['middleware' => ['auth', 'rolecek:dosen']], function () {
    Route::get('dosen-dashboard', [DosenController::class, 'index'])->name('dosen-dashboard');
    Route::post('dosen-update', [DosenController::class, 'update'])->name('dosen-update');
});

// //PRODI
// Route::group(['middleware' => ['auth', 'rolecek:kaprodi']], function () {
//     Route::get('prodi-dashboard', [ProdiController::class, 'index'])->name('prodi-dashboard');
//     Route::post('prodi-update', [ProdiController::class, 'update'])->name('prodi-update');
// });

// //KK
// Route::group(['middleware' => ['auth', 'rolecek:ketuaKK']], function () {
//     Route::get('kk-dashboard', [KKController::class, 'index'])->name('kk-dashboard');
//     Route::post('kk-update', [KKController::class, 'update'])->name('kk-update');
// });

//OLD SEKRETARIAT
Route::group(['middleware' => ['auth', 'rolecek:sekretariat']], function () {
    
    Route::get('sekretariat-dashboard', [SekretariatController::class, 'index']); //tampil dashboard
    Route::get('sekretariat-tambah-sk', [SekretariatController::class, 'create']); // tambah data sk dosen
    Route::post('sekretariat-dashboard', [SekretariatController::class, 'store']); // simpan data sk dosen

});










