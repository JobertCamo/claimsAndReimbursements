<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    return redirect('/');
});


Route::middleware('auth')->group(function() {
    // HR
    Route::view('/admin-dashboard', 'pages-admin.dashboard');
    Route::view('/pending', 'pages-admin.claims.pending');
    Route::view('/payments', 'pages-admin.department');
    Route::view('/approved', 'pages-admin.claims.approved');
    Route::view('/rejected', 'pages-admin.claims.rejected');
    Route::view('/reports', 'pages-admin.reports');
    Volt::route('/view-claim/{claim}' , 'admin.view-claim');
    Volt::route('/employee-profile/{user}' , 'admin.employee-profile');
    // Employee
    Route::view('/dashboard', 'pages-employee.dashboard');
    Route::view('/request', 'pages-employee.claims');
    Route::view('/history', 'pages-employee.history');
    Volt::route('/my-profile', 'employee.profile');
});