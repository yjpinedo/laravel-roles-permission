<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Roles
Route::resource('roles', 'RoleController');

// Users
Route::resource('users', 'UserController')->except(['create', 'store']);
