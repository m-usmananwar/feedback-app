<?php

namespace App\Providers;

use App\Repositories\CommentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\FeedbackRepository;
use App\Contracts\CommentRepositoryInterface;
use App\Contracts\FeedbackRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;

class BindingsServiceProvider extends ServiceProvider
{
    const BINDINGS = [
        FeedbackRepositoryInterface::class => FeedbackRepository::class,
        CommentRepositoryInterface::class => CommentRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        foreach (self::BINDINGS as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
