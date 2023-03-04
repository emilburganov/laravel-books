<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

/* MAIN PAGE */
Route::get('/', [MainController::class, 'index'])->name('main');

/* ALL BOOKS PAGE */
Route::get('/books', [BooksController::class, 'index'])->name('books');

/* BOOK PAGE */
Route::get('/books/{id}', [BooksController::class, 'indexBook'])->name('book');

/* IF NOT AUTHORIZED */
Route::middleware('guest')->group(function () {
    /* SIGN UP*/
    Route::get('/signup', [SignUpController::class, 'index'])->name('signup');
    Route::post('/signup', [SignUpController::class, 'createUser'])->name('createUser');

    /* SIGN IN */
    Route::get('/signin', [SignInController::class, 'index'])->name('signin');
    Route::post('/signin', [SignInController::class, 'checkUser'])->name('checkUser');
});

/* IF AUTHORIZED */
Route::middleware('auth')->group(function () {
    /* IF ADMIN */
    Route::middleware('admin')->group(function () {
        /* ADMIN PANEL */
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');

        /* CRUD USERS */
        Route::post('/admin/users/create', [AdminController::class, 'createUser'])->name('adminCreateUser');
        Route::get('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('adminDeleteUser');
        Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('adminUpdateUser');

        /* CRUD AUTHORS */
        Route::get('/admin/authors/{id}/delete', [AdminController::class, 'deleteAuthor'])->name('adminDeleteAuthor');
        Route::post('/admin/authors/{id}/update', [AdminController::class, 'updateAuthor'])->name('adminUpdateAuthor');
        Route::post('/admin/authors/create', [AdminController::class, 'createAuthor'])->name('adminCreateAuthor');

        /* CRUD GENRES */
        Route::get('/admin/genres/{id}/delete', [AdminController::class, 'deleteGenre'])->name('adminDeleteGenre');
        Route::post('/admin/genres/{id}/update', [AdminController::class, 'updateGenre'])->name('adminUpdateGenre');
        Route::post('/admin/genres/create', [AdminController::class, 'createGenre'])->name('adminCreateGenre');

        /* CRUD BOOKS */
        Route::get('/admin/books/{id}/delete', [AdminController::class, 'deleteBook'])->name('adminDeleteBook');
        Route::post('/admin/books/{id}/update', [AdminController::class, 'updateBook'])->name('adminUpdateBook');
        Route::post('/admin/books/create', [AdminController::class, 'createBook'])->name('adminCreateBook');
    });

    /* LOGOUT */
    Route::get('/logout', [SignInController::class, 'logoutUser'])->name('logoutUser');
});
