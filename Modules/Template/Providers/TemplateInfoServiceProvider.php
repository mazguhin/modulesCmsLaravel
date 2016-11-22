<?php

namespace Modules\Template\Providers;


use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class TemplateInfoServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        App::bind('templateinfo', function ()
        {
          return new \Modules\Template\Classes\TemplateInfo;
        });
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
}
