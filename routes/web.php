<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', function () {
    $books = \App\Models\Book::with('category')->latest()->take(6)->get();
    $trendingBooks = \App\Models\Book::with('category')->orderBy('views', 'desc')->take(6)->get();
    $categories = \App\Models\Category::all();
    return view('user.home', compact('books', 'trendingBooks', 'categories'));
})->name('home');

Route::get('/about', function () {
    return view('user.about');
})->name('about');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes (Protected)
Route::middleware(['user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [DashboardController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [DashboardController::class, 'deleteAccount'])->name('profile.delete');

    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

// Book Routes (Public & Protected)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/trending', [BookController::class, 'trending'])->name('books.trending');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/{id}/read', [BookController::class, 'read'])->name('books.read')->middleware('user');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Books Management
    Route::get('/books', [AdminController::class, 'booksIndex'])->name('books.index');
    Route::get('/books/create', [AdminController::class, 'booksCreate'])->name('books.create');
    Route::post('/books', [AdminController::class, 'booksStore'])->name('books.store');
    Route::get('/books/{id}/edit', [AdminController::class, 'booksEdit'])->name('books.edit');
    Route::put('/books/{id}', [AdminController::class, 'booksUpdate'])->name('books.update');
    Route::delete('/books/{id}', [AdminController::class, 'booksDestroy'])->name('books.destroy');

    // Categories Management
    Route::get('/categories', [AdminController::class, 'categoriesIndex'])->name('categories.index');
    Route::post('/categories', [AdminController::class, 'categoriesStore'])->name('categories.store');
    Route::delete('/categories/{id}', [AdminController::class, 'categoriesDestroy'])->name('categories.destroy');
});
