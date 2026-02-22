<?php

namespace Modules\AssetUploader\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Register the routes required for this module.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Modules\\AssetUploader\\Http\\Controllers';

    public function before(Router $router)
    {
        // ...
    }

    public function map(Router $router)
    {
        $this->registerAdminRoutes();
    }

    protected function registerAdminRoutes(): void
    {
        $config = [
            'as'         => 'admin.assetuploader.',
            'prefix'     => 'admin/asset-uploader',
            'namespace'  => $this->namespace.'\\Admin',
            'middleware' => config('assetuploader.middleware', ['web', 'auth', 'role:admin']),
        ];

        Route::group($config, function () {
            $this->loadRoutesFrom(__DIR__.'/../Http/Routes/admin.php');
        });
    }
}
