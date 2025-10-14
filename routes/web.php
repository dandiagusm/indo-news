<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorldNewsController;

Route::get('/', [WorldNewsController::class, 'index'])->name('news.index');
