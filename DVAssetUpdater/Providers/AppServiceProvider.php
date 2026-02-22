<?php

namespace Modules\DVAssetUpdater\Providers;

use App\Contracts\Modules\ServiceProvider;

/**
 * @package $NAMESPACE$
 */
class AppServiceProvider extends ServiceProvider
{
    private $moduleSvc;

    protected $defer = false;

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->moduleSvc = app('App\Services\ModuleService');

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $this->registerLinks();

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }

    /**
     * Add module links here
     */
    public function registerLinks(): void
    {
        // Show this link if logged in
        // $this->moduleSvc->addFrontendLink('AssetUploader', '/dvassetupdater', '', $logged_in=true);

        // Admin links:
        $this->moduleSvc->addAdminLink('Asset Uploader', '/admin/asset-uploader');
    }

    /**
     * Register config.
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('dvassetupdater.php'),
        ], 'dvassetupdater');

        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'dvassetupdater');
    }

    /**
     * Register views.
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/dvassetupdater');
        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([$sourcePath => $viewPath,], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return str_replace('default', setting('general.theme'), $path) . '/modules/dvassetupdater';
        }, \Config::get('view.paths')), [$sourcePath]), 'dvassetupdater');
    }

    /**
     * Register translations.
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/dvassetupdater');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'dvassetupdater');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'dvassetupdater');
        }
    }
}
