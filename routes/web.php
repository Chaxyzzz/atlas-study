<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AiAnalyzerController;
use App\Http\Controllers\Auth\PublicAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\CategoryController as PublicCategoryController;
use App\Http\Controllers\Public\LessonController as PublicLessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('lang.switch');
Route::post('/lang/{locale}', [LanguageController::class, 'switchLanguage']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/opening', function () {
    return view('opening');
})->name('opening');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Public Authentication Routes
Route::post('/auth/phone/send-otp', [PublicAuthController::class, 'sendOtp'])->middleware('throttle:5,1')->name('auth.phone.send');
Route::post('/auth/phone/verify-otp', [PublicAuthController::class, 'verifyOtp'])->middleware('throttle:5,1')->name('auth.phone.verify');
Route::get('/auth/google', [PublicAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [PublicAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/auth/google', [PublicAuthController::class, 'googleAuth']);
Route::post('/auth/logout', [PublicAuthController::class, 'logout'])->name('public.logout');

// Public Category Pages
Route::get('/categories', [PublicCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [PublicCategoryController::class, 'show'])->name('categories.show');

// Public Lessons
Route::get('/lessons', [PublicLessonController::class, 'index'])->name('lessons.index');
Route::get('/lesson/{slug}', [PublicLessonController::class, 'show'])->name('lessons.show');

// AI Vision Analyzer Routes
Route::get('/ai-analyzer', [AiAnalyzerController::class, 'index'])->name('ai.analyzer');
Route::post('/ai-analyzer/analyze', [AiAnalyzerController::class, 'analyze'])->name('ai.analyze');
Route::get('/ai-analyzer/history', [AiAnalyzerController::class, 'history'])->name('ai.history');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        // Category CRUD Routes
        Route::resource('categories', CategoryController::class);
        
        // Lesson CRUD Routes
        Route::resource('lessons', LessonController::class);

        // User Management Export & Actions
        Route::get('users/export/csv', [UserController::class, 'exportCsv'])->name('users.export.csv');
        Route::get('users/export/excel', [UserController::class, 'exportExcel'])->name('users.export.excel');
        Route::get('users/export/pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf');
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::post('users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
        Route::post('users/{user}/reset-session', [UserController::class, 'resetSession'])->name('users.reset-session');
    });
});
