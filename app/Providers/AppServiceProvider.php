<?php

namespace App\Providers;

use App\Actions\Chat\GetMessagesForChat;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GetMessagesForChat::class, static function () {
            return new GetMessagesForChat(config('chat.messages.count_on_page'));
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
