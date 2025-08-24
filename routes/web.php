<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;


route::get('/', [IndexController::class, 'index'])->name('index');
route::get('/sobre-nos', [AboutUsController::class, 'aboutUs'])->name('about_us');
route::get('/contato', [ContactController::class, 'contact'])->name('contact');
route::get('/login', [LoginController::class, 'login'])->name('login');