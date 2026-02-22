<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Route / Admin Middleware
    |--------------------------------------------------------------------------
    | Adjust this to match your phpVMS installation.
    | Recommended: ['web','auth','role:admin']  (Laratrust ability requires roles+permissions params; avoid ability:admin)
    */
    'middleware' => ['web', 'auth', 'role:admin'],

    /*
    |--------------------------------------------------------------------------
    | Upload Targets (edit these!)
    |--------------------------------------------------------------------------
    | Each target is a "bucket" the admin can upload to.
    | - path: relative to public_path() by default (so it lands in /public/...)
    | - base: 'public' (public_path) or 'storage' (storage_path) if you want
    | - allowed_extensions: validated by extension via Laravel 'mimes' rule
    | - max_size_kb: file size limit in kilobytes
    | - naming: 'original' keeps original filename (sanitized). 'unique' appends timestamp+random.
    | - overwrite: if false, unique suffix is forced if filename already exists.
    | - hint: optional helper text shown in the admin UI
    */
    'targets' => [

        // === SPTheme Assets ===
        'sptheme_banners' => [
            'label' => 'SPTheme - Banner Images',
            'base'  => 'public',
            'path'  => 'SPTheme/images/banner',
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
            'max_size_kb' => 8192,
            'naming' => 'unique',
            'overwrite' => false,
        ],

        'sptheme_awards' => [
            'label' => 'SPTheme - Award Images',
            'hint'  => 'Awards MUST be 250px × 250px.',
            'base'  => 'public',
            'path'  => 'SPTheme/images/awards',
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'webp'],
            'max_size_kb' => 8192,
            'naming' => 'unique',
            'overwrite' => false,
        ],

        'sptheme_events' => [
            'label' => 'SPTheme - Event Images',
            'base'  => 'public',
            'path'  => 'SPTheme/images/events',
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
            'max_size_kb' => 8192,
            'naming' => 'unique',
            'overwrite' => false,
        ],

        'sptheme_tours' => [
            'label' => 'SPTheme - Tour Graphics',
            'hint'  => 'Tour images MUST be 1024px × 1024px.',
            'base'  => 'public',
            'path'  => 'SPTheme/images/tours',
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'webp'],
            'max_size_kb' => 12288, // 12MB
            'naming' => 'unique',
            'overwrite' => false,
        ],

        // === Public Downloads ===
        'docs_downloads' => [
            'label' => 'Public Downloads (PDF/ZIP)',
            'base'  => 'public',
            'path'  => 'downloads',
            'allowed_extensions' => ['pdf', 'zip'],
            'max_size_kb' => 51200, // 50MB
            'naming' => 'unique',
            'overwrite' => false,
        ],

    ],

];
