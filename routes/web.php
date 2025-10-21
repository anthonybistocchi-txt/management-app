<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegisterController;

route::get('/login', [LoginController::class, 'login'])->name('login');
route::get('/cadastro',[RegisterController::class,'register'])->name('register');
route::get('/gestao-pro', [IndexController::class, 'index'])->name('index');