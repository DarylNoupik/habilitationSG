<?php
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\FonctionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Fonctions;
use App\Models\application;

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

// Middleware for authentified users
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		$userscount = User::count();
		$applicationscount = application::count();
		$fonctionscount = Fonctions::count();
		return view('dashboard',compact(['userscount','applicationscount','fonctionscount']));
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');


	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');


	Route::get('/users', [UserController::class, 'index']);
	Route::get('/users2', [UserController::class, 'getUsers']);
	
	// Routage des applications
	Route::prefix('applications')->group(function () {
		Route::get('/', [ApplicationController::class, 'index'])->name('applications.index');
		Route::get('/create', [ApplicationController::class, 'create'])->name('applications.create');
		Route::post('/store', [ApplicationController::class, 'store'])->name('applications.store');
		Route::get('/edit/{id}', [ApplicationController::class, 'edit'])->name('applications.edit');
		Route::post('/update/{id}', [ApplicationController::class, 'update'])->name('applications.update');
		Route::get('/delete/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
	});
    // Routage des utilisateurs
	Route::prefix('users')->group(function () {
		Route::get('/', [UserController::class, 'getUsers'])->name('users.index');
		Route::get('/create', [UserController::class, 'create'])->name('users.create');
		Route::post('/store', [UserController::class, 'store'])->name('users.store');
		Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
		Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
		Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    });
    // Routage des fonctions
	Route::prefix('fonctions')->group(function () {
		Route::get('/', [FonctionsController::class, 'index'])->name('fonctions.index');
		Route::get('/create', [FonctionsController::class, 'create'])->name('fonctions.create');
		Route::get('/show/{id}', [FonctionsController::class, 'show'])->name('fonctions.show');
		Route::post('/store', [FonctionsController::class, 'store'])->name('fonctions.store');
		Route::post('/store/{id}', [FonctionsController::class, 'storeApp'])->name('fonctions.storeApp');
		Route::get('/edit/{id}', [FonctionsController::class, 'edit'])->name('fonctions.edit');
		Route::post('/update/{id}', [FonctionsController::class, 'update'])->name('fonctions.update');
		Route::get('/delete/{id}', [FonctionsController::class, 'destroy'])->name('fonctions.destroy');
	});
    // Routage des equipements
	Route::prefix('equipements')->group(function () {
		Route::get('/', [EquipementController::class, 'index'])->name('equipements.index');
		Route::get('/create', [EquipementController::class, 'create'])->name('equipements.create');
		Route::post('/store', [EquipementController::class, 'store'])->name('equipements.store');
		Route::get('/edit/{id}', [EquipementController::class, 'edit'])->name('equipements.edit');
		Route::post('/update/{id}', [EquipementController::class, 'update'])->name('equipements.update');
		Route::get('/delete/{id}', [EquipementController::class, 'destroy'])->name('equipements.destroy');
	});
	// Routage des actions des applications
	Route::prefix('actions')->group(function () {
		Route::get('/', [ActionController::class, 'index'])->name('actions.index');
		Route::get('/create', [ActionController::class, 'create'])->name('actions.create');
		Route::post('/store', [ActionController::class, 'store'])->name('actions.store');
		Route::get('/edit/{id}', [ActionController::class, 'edit'])->name('actions.edit');
		Route::post('/update/{id}', [ActionController::class, 'update'])->name('actions.update');
		Route::get('/delete/{id}', [ActionController::class, 'destroy'])->name('actions.destroy');
	});


});





// Middleware for guest users
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});
// login route
Route::get('/login', function () {
    return view('session/login-session');
})->name('login');