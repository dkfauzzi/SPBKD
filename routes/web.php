<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
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
Route::get('/dekan-login', [AuthController::class, 'LoginDekan'])->middleware('guest');
Route::post('/post-login-dekan', [AuthController::class, 'PostLoginDekan']);

//Login Sekretariat
Route::get('/sekretariat-login', [AuthController::class, 'LoginSekretariat'])->middleware('guest');
Route::post('/post-login-sekretariat', [AuthController::class, 'PostLoginSekretariat']);

//Login Sekretariat2
Route::get('/sekretariat2-login', [AuthController::class, 'LoginSekretariat2'])->middleware('guest');
Route::post('/post-login-sekretariat2', [AuthController::class, 'PostLoginSekretariat2']);


//Login Dosen
Route::get('/dosen-login', [AuthController::class, 'LoginDosen'])->middleware('guest');
Route::post('/post-login-dosen', [AuthController::class, 'PostLoginDosen']);

//LOGOUT
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'rolecek:dekan']], function () {
    Route::get('dekan-dashboard', [DekanController::class, 'index']);


});

Route::group(['middleware' => ['auth', 'rolecek:sekretariat']], function () {
    
    Route::get('sekretariat-dashboard', [SekretariatController::class, 'index']); //tampil dashboard
    Route::get('sekretariat-tambah-sk', [SekretariatController::class, 'create']); // tambah data sk dosen
    Route::post('sekretariat-dashboard', [SekretariatController::class, 'store']); // simpan data sk dosen

});

Route::group(['middleware' => ['auth', 'rolecek:sekretariat2']], function () {
    
    Route::get('sekretariat2-dashboard', [SekretariatController2::class, 'index']); //tampil dashboard
    Route::get('sekretariat2-tambah-sk', [SekretariatController2::class, 'create']); // tambah data sk dosen
    Route::post('sekretariat2-dashboard', [SekretariatController2::class, 'store']); // simpan data sk dosen
    // Route::get('generate-pdf/{NIP}', 'YourController@generatePDF');


    Route::get('sekretariat2-search', [DataDosenController::class, 'index']); //tampil search
    Route::get('sekretariat2-dosen-details/{NIP}', [DataDosenController::class, 'detailDosen'])->name('sekretariat2-dosen-details');
    Route::get('sekretariat2-tambah-sk/{NIP}', [DataDosenController::class, 'create'])->name('sekretariat2-tambah-sk');
    Route::post('sekretariat2-dosen-details/{NIP}', [DataDosenController::class, 'store'])->name('store-more-data');
    Route::delete('sekretariat2-dosen-details/{NIP}', [DataDosenController::class, 'delete'])->name('sekretariat2-dosen-details-delete');
    Route::get('sekretariat2-search', [DataDosenController::class, 'index'])->name('sekretariat2-search'); //kembali ke halaman search
    Route::get('sekretariat2-dosen-edit/{NIP}', [DataDosenController::class, 'edit'])->name('sekretariat2-dosen-edit'); 
    Route::post('sekretariat2-dosen-edit/{NIP}', [DataDosenController::class, 'update'])->name('sekretariat2-dosen-update');
    Route::get('print/{NIP}', [DataDosenController::class, 'pdf'])->name('print');


    Route::get('sekretariat2-charts', [ChartController::class, 'index']);
    Route::get('/chart/data-sk', [ChartController::class, 'getDataSK']);
    Route::get('/chart/data-sks', [ChartController::class, 'getDataSKS']);
    Route::get('/chart/data-sk-semester', [ChartController::class, 'getDataSKSemester']);

    // Route::get('print-report', [ChartController::class, 'report'])->name('report');

    Route::get('print-report', [ChartController::class, 'index'])->name('report.index');
    Route::get('print-report/{year}', [ChartController::class, 'report'])->name('report.generate');
    


    // Route::get('/chart/bar-data', [ChartController::class, 'getData']);
    // Route::get('/chart/line-data', [ChartController::class, 'getData']);
    // Route::get('/chart/prodi-data', [ChartController::class, 'getData']);


    // Route::get('/user/create', [RegisterController::class, 'create'])->name('user.create');
    // Route::post('/user', [RegisterController::class, 'store'])->name('user.store');
    Route::get('sekretariat2-register', [RegisterController::class, 'create']); // Display the registration form
    Route::post('sekretariat2-search', [RegisterController::class, 'store'])->name('sekretariat2-search'); // Handle the form submission and create the user

    Route::get('card', [CardController::class, 'index']);
    // Route::get('sekretariat2/{NIP}', [CardController::class, 'show'])->name('sekretariat2.show');
});

Route::group(['middleware' => ['auth', 'rolecek:dosen']], function () {
    
    Route::get('dosen-dashboard', [QuarterDateController::class, 'index']);
    // Route::resource('dosen-dashboard', 'QuarterDateController');
    // Route::resource('dosen-dashboard', [QuarterDateController::class]);
    Route::get('dosen-tambah-sk', [QuarterDateController::class, 'create']); // tambah data sk dosen
    Route::post('dosen-dashboard', [QuarterDateController::class, 'store']); // simpan data sk dosen

});






