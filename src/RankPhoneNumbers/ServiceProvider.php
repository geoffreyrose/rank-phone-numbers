<?php

namespace RankPhoneNumbers;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RankPhoneNumbers::class, function ($app) {
            return new RankPhoneNumbers();
        });

        $this->app->alias(RankPhoneNumbers::class, 'rankphonenumbers');
    }
}
