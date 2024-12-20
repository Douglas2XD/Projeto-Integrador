<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('index');
});
*/
Auth::routes();

Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name(name: 'index');

Route::get('/register_employees/new', [EmployeeController::class, "index"])->name('new');

Route::post('/register_employees', [EmployeeController::class, "store"])->name('store');

Route::get('/register_employees/{employee}', [EmployeeController::class, "edit"])->name('edit');

Route::put('/register_employees/{employee}', [EmployeeController::class, "update"])->name('update');

Route::get('/register_employees/delete/{employee}', [EmployeeController::class, "delete"])->name('delete');

Route::get('/register_employees', [App\Http\Controllers\HomeController::class, 'register_employees'])->name(name: 'register_employees');

Route::get('/recrutamento', [App\Http\Controllers\HomeController::class, 'recrutamento'])->name(name: 'recrutamento');

Route::get('/processos_seletivos', [App\Http\Controllers\HomeController::class, 'processos_seletivos'])->name(name: 'processos_seletivos');

Route::get('/show_employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name(name: 'show_employees');


Route::get('/create_job_vacancy', [App\Http\Controllers\HomeController::class, 'create_job_vacancy'])->name(name: 'create_job_vacancy');

Route::get('/endomarketing', [App\Http\Controllers\HomeController::class, 'endomarketing'])->name(name: 'endomarketing');


//rotas das vagas

Route::post('/create_job_vacancy', [VacancyController::class, "store"])->name('store_vacancy');

Route::get('/latest_processes', [VacancyController::class, "index"])->name('latest_processes');

Route::get('/show_candidates/{id_vancancy}', [HomeController::class, "show_candidates"])->name('show_candidates');

Route::get('/show_all_candidates', [HomeController::class, "show_all_candidates"])->name('show_all_candidates');


Route::get('/latest_processes/delete/{vacancy}', [VacancyController::class, "delete"])->name('delete_vacancy');

Route::get('/latest_processes/new_process', [VacancyController::class, "index"])->name('new_process');

Route::get('/create_job_vacancy/{vacancy}', [VacancyController::class, "edit"])->name('edit_vacancy');

Route::put('/create_job_vacancy/{vacancy}', [VacancyController::class, "update"])->name('update_vacancy');



Route::get('/ainda_em_desenvolvimento', [HomeController::class, "desenvolvimento"])->name('ainda_em_desenvolvimento');


Route::get('/home', [HomeController::class,"index"])->name('home');
});

Route::get('/candidate_portal', [CandidateController::class, "index"])->name('candidate_portal');

Route::post('/candidate_portal', [CandidateController::class, "create"])->name('create_candidate');



Route::get('/', [HomePageController::class,"index"])->name('home_page');