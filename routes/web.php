<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\JSON\QuestionJsonController;

Route::get('/', [PagesController::class, 'index'])->name('index')->middleware('guest');
Route::get('/register', [PagesController::class, 'register'])->name('register')->middleware('guest');

Route::group(['prefix' => 'user'], function() {
    Route::post('/register', [RegisterController::class, 'create']);
    Route::post('/login',    [LoginController::class, 'create']);
    Route::post('/logout',   [LoginController::class, 'logout']);
});

Route::group(['prefix' => 'vote', 'middleware' => 'auth'], function() {
    Route::get('/questions',        [PagesController::class, 'questions'])->name('questions');
    Route::get('/questions/{code}', [PagesController::class, 'viewQuestion']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkAdmin'] ], function() {
    Route::get('/dashboard', [AdminPagesController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'question'], function() {
        Route::get('/add',      [AdminPagesController::class, 'questionAdd'])->name('question_add');
        Route::get('/list',     [AdminPagesController::class, 'questionList'])->name('question_list');
        Route::get('/archive',  [AdminPagesController::class, 'questionArchive'])->name('question_archive');
    });
});

Route::group(['prefix' => 'question'], function() {
    Route::get('/json/{code}',       [QuestionJsonController::class, 'viewQuestionJSON']);
    
    Route::group(['middleware' => 'checkAdmin'], function() {
        Route::get('/list/json',         [QuestionJsonController::class, 'questionListJson']);
        Route::get('/archive/json',      [QuestionJsonController::class, 'questionArchiveJson']);
        Route::get('/find/id={id}',      [QuestionController::class, 'find']);
        Route::post('/create',           [QuestionController::class, 'create']);
        Route::post('/update/id={id}',   [QuestionController::class, 'update']);
        Route::post('/archive/id={id}',  [QuestionController::class, 'archive']);
        Route::post('/restore/id={id}',  [QuestionController::class, 'restore']);
        Route::delete('/delete/id={id}', [QuestionController::class, 'delete']);
    });
});

Route::group(['prefix' => 'vote', 'middleware' => 'auth'], function() {
    Route::post('/create', [VoteController::class, 'create']);
});