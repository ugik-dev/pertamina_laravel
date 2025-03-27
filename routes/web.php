<?php

use App\Events\RequestCallEvent;
use App\Http\Controllers\api\RequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\FaskesController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\LiveLocationController;
use App\Http\Controllers\MCUController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\RujukanController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SebuseController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutController;
use GuzzleHttp\Psr7\Request;

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



Route::get('/', [PortalController::class, 'index'])->name('portal');
Route::get('/home', [PortalController::class, 'home'])->name('home');
Route::get('/scan-fitality', [PortalController::class, 'scan_fit'])->name('portal.scan-fit');
Route::get('/scan-sebuse', [PortalController::class, 'scan_sebuse'])->name('portal.scan-sebuse');
Route::get('/scan-workout', [PortalController::class, 'scan_workout'])->name('portal.scan-workout');
Route::get('/info/content', [PortalController::class, 'content']);
Route::get('bank-data', [PortalController::class, 'bank_data'])->name('bank_data');
Route::get('get-mcu/{code}', [PortalController::class, 'get_mcu'])->name('get-mcu');
Route::get('mcu', [PortalController::class, 'mcu'])->name('mcu');
Route::get('content/show/{slug}', [ContentController::class, 'show'])->name('content.show');

Route::get('/login', [LoginBasic::class, 'index'])->name('login');
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');
Route::get('scanner/checker/{code}', [ScreeningController::class, 'scanner_process'])->name('scanner.check');
Route::get('scanner/checker-sebuse/{code}', [SebuseController::class, 'scanner_process'])->name('scanner.check-sebuse');
Route::post('scanner/sebuse/post', [SebuseController::class, 'store'])->name('sebuse-post');
Route::get('scanner/checker-workout/{code}', [WorkoutController::class, 'scanner_process'])->name('scanner.check-workout');
Route::post('scanner/workout/post', [WorkoutController::class, 'store'])->name('workout-post');

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
// Route::get('/login', [LoginBasic::class, 'index'])->name('login');
Route::get('/logout', [LoginBasic::class, 'logout'])->name('logout');
Route::post('/auth/login-process', [LoginBasic::class, 'login'])->name('auth-login-process');
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

Route::get('get-emergency', [EmergencyController::class, 'getData'])->name('get-emergency');
Route::get('emergency/{id}', [EmergencyController::class, 'detail'])->name('detail-emergency');


Route::get('read-doc/reff/{code}', [RujukanController::class, 'get_qr']);

Route::middleware(['auth'])->group(function () {
    Route::get('test-call', [RequestController::class, 'test_call'])->name('test_call');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::get('change-password', [ProfileController::class, 'change_password'])->name('change-password');
        Route::post('change-password', [ProfileController::class, 'change_password_process'])->name('change-password-process');
    });
    Route::get('screening', [ScreeningController::class, 'index'])->name('screening');
    Route::get('screening/scan/{code}', [ScreeningController::class, 'scan_process'])->name('scan_get');

    Route::get('scanner', [ScreeningController::class, 'scanner'])->name('scanner');

    Route::prefix('screening')->name('screening.')->middleware('can:is_doctor')->group(function () {
        Route::get('', [ScreeningController::class, 'index'])->name('index');
        Route::get('export', [ScreeningController::class, 'export'])->name('export');
        Route::get('rekap', [ScreeningController::class, 'rekap'])->name('rekap');
        Route::get('rekap/export', [ScreeningController::class, 'export'])->name('rekap.export');
        Route::get('get', [ScreeningController::class, 'get'])->name('get');
        Route::get('scan/{code}', [ScreeningController::class, 'scan_process'])->name('scan_get');
        Route::post('', [ScreeningController::class, 'create'])->name('create');
        Route::put('', [ScreeningController::class, 'update'])->name('update');
    });

    Route::prefix('security')->name('security-app.')->middleware('can:is_security')->group(function () {
        Route::get('', [SecurityController::class, 'index'])->name('index');
        Route::get('checkin/{code}', [SecurityController::class, 'checkin'])->name('checkin');
        Route::get('checkout/{code}', [SecurityController::class, 'checkout'])->name('checkout');
        // Route::put('', [SecurityController::class, 'update'])->name('update');
    });

    Route::prefix('sebuse')->name('sebuse.')->group(function () {
        // Route::get('', [SebuseController::class, 'index'])->name('index');
        Route::get('export', [SebuseController::class, 'export'])->name('export');
        Route::get('rekap', [SebuseController::class, 'rekap'])->name('rekap');
        Route::get('rekap/export', [SebuseController::class, 'export'])->name('rekap.export');
        // Route::get('get', [SebuseController::class, 'get'])->name('get');
        // Route::get('scan/{code}', [SebuseController::class, 'scan_process'])->name('scan_get');
        // Route::post('', [SebuseController::class, 'create'])->name('create');
        Route::put('verif', [SebuseController::class, 'verif'])->name('verif');
    });


    Route::prefix('workout')->name('workout.')->group(function () {
        Route::get('export', [WorkoutController::class, 'export'])->name('export');
        Route::get('rekap', [WorkoutController::class, 'rekap'])->name('rekap');
        Route::get('rekap/export', [WorkoutController::class, 'export'])->name('rekap.export');
        Route::put('verif', [WorkoutController::class, 'verif'])->name('verif');
    });

    Route::prefix('select2')->name('select2.')->group(function () {
        Route::get('user', [UserController::class, 'select2'])->name('user');
        Route::get('guarantor/{user_id}', [UserController::class, 'select2_guarantor'])->name('guarantor');
        Route::get('drug', [DrugController::class, 'select2'])->name('drug');
    });

    Route::prefix('rujukan')->name('rujukan.')->group(function () {
        Route::get('', [RujukanController::class, 'index'])->name('index');
        Route::get('form', [RujukanController::class, 'form_fresh'])->name('form');
        Route::get('form/{id}', [RujukanController::class, 'form_edit'])->name('edit');
        Route::get('upload/{id}', [RujukanController::class, 'upload'])->name('upload');
        Route::get('approve/{id}', [RujukanController::class, 'approve'])->name('approve');
        Route::post('form', [RujukanController::class, 'form_save_new_fresh'])->name('save');
        Route::post('form/{id}', [RujukanController::class, 'form_save_edit'])->name('save-edit');
        Route::post('upload/{id}', [RujukanController::class, 'upload_process'])->name('upload-process');
        Route::delete('/', [RujukanController::class, 'destroy'])->name('delete');

        Route::get('open/{id}', [PdfController::class, 'rujukan'])->name('open');
    });

    Route::prefix('recipe')->name('recipe.')->group(function () {
        Route::get('', [RecipeController::class, 'index'])->name('index');
        Route::get('form', [RecipeController::class, 'form_fresh'])->name('form');
        Route::get('form/{id}', [RecipeController::class, 'form_edit'])->name('edit');
        Route::get('upload/{id}', [RecipeController::class, 'upload'])->name('upload');
        Route::post('form', [RecipeController::class, 'form_save_new_fresh'])->name('save');
        Route::post('form/{id}', [RecipeController::class, 'form_save_edit'])->name('save-edit');
        Route::post('upload/{id}', [RecipeController::class, 'upload_process'])->name('upload-process');
        Route::delete('/', [RecipeController::class, 'destroy'])->name('delete');
        Route::get('open/{id}', [PdfController::class, 'recipe'])->name('open');
    });


    Route::get('create-tindakan', [RekapController::class, 'form_tindakan'])->name('create-tindakan');

    Route::get('emergency/{id}/form', [EmergencyController::class, 'form'])->name('emergency-form');
    Route::POST('emergency/{id}/form', [EmergencyController::class, 'form_save_new'])->name('emergency-form-save');
    Route::POST('emergency/{id}/{id_form}/form', [EmergencyController::class, 'form_save'])->name('emergency-form-save-edit');
    Route::get('emergency/{id}/{id_form}/form-edit', [EmergencyController::class, 'form_edit'])->name('emergency-form-edit');


    Route::get('emergency/{id}/{id_form}/print/{format}', [PdfController::class, 'form_kejadian'])->name('emergency-form-print');
    Route::get('emergency-act/{id}/{act?}', [EmergencyController::class, 'action'])->name('pick-off');
    Route::get('emergency', [EmergencyController::class, 'index'])->name('emergency');

    Route::get('pengguna', [EmergencyController::class, 'pengguna'])->name('pengguna');
    Route::get('sebaran-faskes', [FaskesController::class, 'sebaran'])->name('faskes.sebaran');

    Route::prefix('rekap')->name('rekap.')->group(function () {
        Route::get('', [RekapController::class, 'tindakan'])->name('tindakan');
        Route::get('get', [RekapController::class, 'tindakan_get'])->name('tindakan.get');
    });


    Route::prefix('tindakan')->name('tindakan.')->group(function () {
        Route::get('create', [EmergencyController::class, 'form_fresh'])->name('create');
        Route::get('print/{id}/{format}', [PdfController::class, 'kejadian'])->name('print');
        Route::post('save', [EmergencyController::class, 'form_save_new_fresh'])->name('save');
        Route::get('edit/{id}', [EmergencyController::class, 'form_edit_fresh'])->name('edit');
        Route::post('save-edit/{id}', [EmergencyController::class, 'form_save_edit_fresh'])->name('save-edit');
    });



    Route::prefix('manage-faskes')->name('faskes.')->group(function () {
        Route::get('', [FaskesController::class, 'index'])->name('index');
        Route::get('get', [FaskesController::class, 'get'])->name('get');
        Route::post('', [FaskesController::class, 'create'])->name('create');
        Route::put('', [FaskesController::class, 'update'])->name('update');
        Route::delete('/', [FaskesController::class, 'delete'])->name('delete');
        Route::get('/getData/{id_wil}', [FaskesController::class, 'getData'])->name('get-data');
    });

    Route::prefix('manage-agent')->name('agent.')->middleware('can:crud_users')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('get', [UserController::class, 'get'])->name('get');
        Route::get('get/{id}', [UserController::class, 'find'])->name('find');
        Route::post('', [UserController::class, 'create'])->name('create');
        Route::put('', [UserController::class, 'update'])->name('update');
        Route::delete('/', [UserController::class, 'delete'])->name('delete');
    });
    Route::prefix('manage-unit')->name('unit.')->group(function () {
        Route::get('', [UnitController::class, 'index'])->name('index');
        Route::get('get', [UnitController::class, 'get'])->name('get');
        Route::post('', [UnitController::class, 'create'])->name('create');
        Route::put('', [UnitController::class, 'update'])->name('update');
        Route::delete('/', [UnitController::class, 'delete'])->name('delete');
    });

    Route::prefix('manage-company')->name('company.')->group(function () {
        Route::get('', [CompanyController::class, 'index'])->name('index');
        Route::get('get', [CompanyController::class, 'get'])->name('get');
        Route::post('', [CompanyController::class, 'create'])->name('create');
        Route::put('', [CompanyController::class, 'update'])->name('update');
        Route::delete('/', [CompanyController::class, 'delete'])->name('delete');
    });
    Route::prefix('manage-guarantor')->name('guarantor.')->group(function () {
        Route::get('', [GuarantorController::class, 'index'])->name('index');
        Route::get('get', [GuarantorController::class, 'get'])->name('get');
        Route::post('', [GuarantorController::class, 'create'])->name('create');
        Route::put('', [GuarantorController::class, 'update'])->name('update');
        Route::delete('/', [GuarantorController::class, 'delete'])->name('delete');
    });

    Route::prefix('manage-field')->name('field.')->group(function () {
        Route::get('', [FieldController::class, 'index'])->name('index');
        Route::get('get', [FieldController::class, 'get'])->name('get');
        Route::post('', [FieldController::class, 'create'])->name('create');
        Route::put('', [FieldController::class, 'update'])->name('update');
        Route::delete('/', [FieldController::class, 'delete'])->name('delete');
    });


    Route::prefix('manage-drug')->name('drug.')->group(function () {
        Route::get('', [DrugController::class, 'index'])->name('index');
        Route::get('get', [DrugController::class, 'get'])->name('get');
        Route::post('', [DrugController::class, 'create'])->name('create');
        Route::put('', [DrugController::class, 'update'])->name('update');
        Route::delete('/', [DrugController::class, 'delete'])->name('delete');
    });
    Route::prefix('manage-live-location')->name('live-location.')->group(function () {
        Route::get('', [LiveLocationController::class, 'index'])->name('index');
        Route::get('get', [LiveLocationController::class, 'get'])->name('get');
        Route::post('', [LiveLocationController::class, 'create'])->name('create');
        Route::put('', [LiveLocationController::class, 'update'])->name('update');
        Route::delete('/', [LiveLocationController::class, 'delete'])->name('delete');
        Route::get('/monitoring/{id}', [LiveLocationController::class, 'monitoring'])->name('monitoring');
        // Route::get('get', [LiveLocationController::class, 'get'])->name('show');
    });

    Route::prefix('content')->name('content.')->group(function () {
        Route::get('', [ContentController::class, 'index'])->name('index');
        Route::get('get', [ContentController::class, 'get'])->name('get');
        Route::post('', [ContentController::class, 'create'])->name('create');
        Route::post('/update', [ContentController::class, 'update'])->name('update');
        Route::delete('/', [ContentController::class, 'delete'])->name('delete');
        Route::get('/getData/{id_wil}', [ContentController::class, 'getData'])->name('get-data');
    });

    Route::prefix('bank')->name('bank.')->group(function () {
        Route::get('', [BankController::class, 'index'])->name('index');
        Route::get('get', [BankController::class, 'get'])->name('get');
        Route::post('', [BankController::class, 'create'])->name('create');
        Route::post('/update', [BankController::class, 'update'])->name('update');
        Route::delete('/', [BankController::class, 'delete'])->name('delete');
        Route::get('/getData/{id_wil}', [BankController::class, 'getData'])->name('get-data');
    });

    Route::prefix('mcu')->name('mcu.')->group(function () {
        Route::get('', [MCUController::class, 'index'])->name('index');
        Route::get('get', [MCUController::class, 'get'])->name('get');
        Route::post('', [MCUController::class, 'create'])->name('create');
        Route::post('/update', [MCUController::class, 'update'])->name('update');
        Route::delete('/', [MCUController::class, 'delete'])->name('delete');
        Route::get('/{id}', [MCUController::class, 'detail'])->name('detail');
        Route::get('fetch_detail/{id}', [MCUController::class, 'fetch_detail'])->name('fetch_detail');

        // Route::get('/getData/{id_wil}', [MCUController::class, 'getData'])->name('get-data');
    });
});
