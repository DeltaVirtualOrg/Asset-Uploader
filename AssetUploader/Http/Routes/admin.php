<?php

use Illuminate\Support\Facades\Route;

// Admin routes for AssetUploader
Route::get('/', 'AssetUploaderController@index')->name('index');
Route::post('/upload', 'AssetUploaderController@store')->name('store');
