<?php
namespace CookieTime\Janitor;

use Illuminate\Support\Facades\Facade;

class JanitorFacade extends Facade
{
    /**
     * Get the registered name of the component
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'janitor';
    }
}