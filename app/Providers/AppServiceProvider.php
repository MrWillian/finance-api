<?php

namespace App\Providers;

use Aws\Sns\SnsClient;
use Aws\Credentials\Credentials;
use App\Channels\SmsChannel;
use App\User;
use App\Observers\UserObserver;
use App\Services\TokenService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TokenService::class, function() {
            return new TokenService();
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('sms', function ($app) {
                return new SmsChannel(
                    new SnsClient([
                        'version' => '2010-03-31',
                        'credentials' => new Credentials(
                            config('services.sns.key'),
                            config('services.sns.secret')
                        ),
                        'region' => config('services.sns.region'),
                    ])
                );
            });
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
