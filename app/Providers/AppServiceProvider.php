<?php

namespace App\Providers;

use App\Actions\Chat\GetMoreMessages;
use App\Actions\Chat\GetSelectedChat;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GetSelectedChat::class, static function () {
            return new GetSelectedChat(config('chat.messages.count_on_page'));
        });
        $this->app->bind(GetMoreMessages::class, static function () {
            return new GetMoreMessages(config('chat.messages.count_on_page'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
