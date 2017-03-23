<?php
namespace CookieTime\Janitor;

use CookieTime\Janitor\Models\Ability;
use CookieTime\Janitor\Observer\AbilityObserver;
use Illuminate\Support\ServiceProvider;

class JanitorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishMigrations();
        $this->registerObserver();
    }

    public function register()
    {
        $this->registerSingleton();
    }

    protected function publishMigrations()
    {
        $publishes = [];

        $migrations = scandir(__DIR__."/../migrations/");

        $date = date('Y_m_d_His', time());

        foreach($migrations as $migration)
        {
            if($migration != '.' && $migration != '..')
            {
                $publishes[__DIR__."/../migrations/$migration"] = database_path('migrations/'.$date."_".$migration);
            }
        }

        $this->publishes($publishes,'janitor.migrations');
    }

    protected function registerSingleton()
    {
        $this->app->singleton('janitor', function ($app) {
            return new Janitor($app);
        });
    }

    protected function registerObserver()
    {
        Ability::observe(AbilityObserver::class);
    }
}
