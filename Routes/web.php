<?php

use Illuminate\Support\Facades\Route;
use Modules\AssetUploader\Http\Controllers\Admin\AssetUploaderController;

Route::middleware(config('assetuploader.middleware', ['web','auth']))
    ->prefix('admin/asset-uploader')
    ->name('admin.assetuploader.')
    ->group(function () {
        Route::get('/', [AssetUploaderController::class, 'index'])->name('index');
        Route::post('/upload', [AssetUploaderController::class, 'store'])->name('store');
    });
