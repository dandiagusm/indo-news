<?php

use App\Http\Controllers\WorldNewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WorldNewsController::class, 'index'])->name('news.index');
