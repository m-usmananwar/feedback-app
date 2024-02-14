<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('success', function($message, $data = null) {
            $request = app(\Illuminate\Http\Request::class);
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
                'request' => [
                    'request_type' => $request->method(),
                    'payload' => $request->input()
                ]
            ]);
        });

        Response::macro('error', function($message, $code, $arr = []) {
            $request = app(\Illuminate\Http\Request::class);
            $response = [
                'success' => false,
                'message' => $message,
                'request' => [
                    'request_type' => $request->method(),
                    'payload' => $request->input()
                ]
            ];

            if(count($arr) > 0) $response = array_merge($response, $arr);

            return response()->json($response, $code);
        });

        Relation::enforceMorphMap([
            "User" => "App\Models\User",
            "Feedback" => "App\Models\Feedback",
            "Comment" => "App\Models\Comment"
        ]);
    }
}
