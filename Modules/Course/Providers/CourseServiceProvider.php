<?php

namespace Modules\Course\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Modules\Course\Providers\RouteServiceProvider;
use Modules\Course\Repositories\Interfaces\ArticleInterface;
use Modules\Course\Repositories\Interfaces\LectureInterface;
use Modules\Course\Repositories\Repositories\CourseRepository;
use Modules\Course\Repositories\Interfaces\CourseInterface;
use Modules\Course\Repositories\Interfaces\ReviewInterface;
use Modules\Course\Repositories\Interfaces\VariousInterface;
use Modules\Course\Repositories\Repositories\ReviewRepository;
use Modules\Course\Repositories\Interfaces\LanguageInterface;
use Modules\Course\Repositories\Interfaces\OpinionInterface;
use Modules\Course\Repositories\Interfaces\TeacherInterface;
use Modules\Course\Repositories\Interfaces\VariousGroupInterface;
use Modules\Course\Repositories\Repositories\ArticleRepository;
use Modules\Course\Repositories\Repositories\LectureRepository;
use Modules\Course\Repositories\Repositories\OpinionRepository;
use Modules\Course\Repositories\Repositories\TeacherRepository;
use Modules\Course\Repositories\Repositories\VariousRepository;
use Modules\Course\Repositories\Repositories\LanguageRepository;
use Modules\Course\Repositories\Repositories\VariousGroupRepository;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Course';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'course';

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
        Paginator::useBootstrap();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(CourseInterface::class,CourseRepository::class);
        $this->app->bind(LanguageInterface::class,LanguageRepository::class);
        $this->app->bind(LectureInterface::class,LectureRepository::class);
        $this->app->bind(TeacherInterface::class,TeacherRepository::class);
        $this->app->bind(ArticleInterface::class,ArticleRepository::class);
        $this->app->bind(VariousGroupInterface::class,VariousGroupRepository::class);
        $this->app->bind(VariousInterface::class,VariousRepository::class);
        $this->app->bind(OpinionInterface::class,OpinionRepository::class);
        $this->app->bind(ReviewInterface::class,ReviewRepository::class);

        if(str_contains('admin',Route::currentRouteName()))
        Paginator::useBootstrap();
        else
        Paginator::useTailwind();
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
