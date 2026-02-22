<?php

namespace Modules\AssetUploader\Providers;

use App\Services\ModuleService;
use Illuminate\Support\ServiceProvider;

class AssetUploaderServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'AssetUploader';
    protected string $moduleNameLower = 'assetuploader';

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', $this->moduleNameLower);
    }

    public function boot(): void
    {
        $this->registerViews();
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerAdminMenuLink();

        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path($this->moduleNameLower.'.php'),
        ], $this->moduleNameLower.'-config');
    }

    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views', $this->moduleNameLower);
    }

    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Add an entry under Admin -> Addons (left sidebar).
     * phpVMS renders these from ModuleService::getAdminLinks().
     */
    protected function registerAdminMenuLink(): void
    {
        try {
            /** @var ModuleService $moduleSvc */
            $moduleSvc = app(ModuleService::class);

            // Title shown in the Addons menu section
            $moduleSvc->addAdminLink(
                'Asset Uploader',
                '/admin/asset-uploader',
                'bi bi-cloud-arrow-up'
            );
        } catch (\Throwable $e) {
            // If phpVMS changes internals or service isn't available, fail gracefully.
        }
    }
}
