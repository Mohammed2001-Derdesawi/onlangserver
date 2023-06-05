<?php

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\User\Providers\RouteServiceProvider;
use Modules\User\Repositories\Interfaces\CartInterface;
use Modules\User\Repositories\Interfaces\UserInterface;
use Modules\User\Repositories\Interfaces\LevelInterface;
use Modules\User\Repositories\Interfaces\ArticleInterface;
use Modules\User\Repositories\Interfaces\MessageInterface;
use Modules\User\Repositories\Interfaces\PaymentInterface;
use Modules\User\Repositories\Repositories\CartRepository;
use Modules\User\Repositories\Repositories\UserRepository;
use Modules\User\Repositories\Interfaces\CampaignInterface;
use Modules\User\Repositories\Interfaces\PlaylistInterface;
use Modules\User\Repositories\Interfaces\WithdrawalInterface;
use Modules\User\Repositories\Repositories\LevelRepository;
use Modules\User\Repositories\Repositories\ArticleRepository;
use Modules\User\Repositories\Repositories\MessageRepository;
use Modules\User\Repositories\Repositories\PaymentRepository;
use Modules\User\Repositories\Repositories\CampaignRepository;
use Modules\User\Repositories\Repositories\PlaylistRepository;
use Modules\User\Repositories\Repositories\WithdrawalRepository;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'User';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'user';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(PaymentInterface::class,PaymentRepository::class);
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(ArticleInterface::class,ArticleRepository::class);
        $this->app->bind(PlaylistInterface::class,PlaylistRepository::class);
        $this->app->bind(CartInterface::class,CartRepository::class);
        $this->app->bind(MessageInterface::class,MessageRepository::class);
        $this->app->bind(CampaignInterface::class,CampaignRepository::class);
        $this->app->bind(LevelInterface::class,LevelRepository::class);
        $this->app->bind(WithdrawalInterface::class,WithdrawalRepository::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
