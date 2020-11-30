<?php

use Illuminate\Support\Facades\Route;


Route::get('/upload-file', 'App\Http\Controllers\FileUpload@createForm');

Route::post('/upload-file', 'App\Http\Controllers\FileUpload@fileUpload')->name('fileUpload');