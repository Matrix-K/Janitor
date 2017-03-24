<?php
namespace CookieTime\Janitor;

use CookieTime\Janitor\Models\Ability;
use CookieTime\Janitor\Observer\AbilityObserver;
use CookieTime\Janitor\Strategy\BitAndKeyCode;
use CookieTime\Janitor\Strategy\PrimeKeyCode;
use Illuminate\Support\ServiceProvider;

class JanitorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishMigrations();
        $this->registerObserver();
        $this->mergeConfig();
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
            switch (config('janitor.strategy'))
            {
                case 'BitAnd':
                    return new Janitor(new BitAndKeyCode());
                    break;
                case 'Prime':
                    return new Janitor(new PrimeKeyCode());
                    break;
            }
        });
    }

    protected function registerObserver()
    {
        Ability::observe(AbilityObserver::class);
    }

    protected function mergeConfig()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('janitor.php'),
        ]);
    }
}
