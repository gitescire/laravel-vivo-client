<?php

use Gitescire\LaravelVivoClient\Vivo\Infrastructure\LaravelVivoClientController;
use Illuminate\Support\Facades\Route;

// This route group is for the LaravelVivoClient package.
// It provides a route for each method of the LaravelVivoClient class.
// The routes are prefixed with "lvc" which is a shorthand for "laravel-vivo-client"
Route::group(["prefix" => "lvc"], function () {
    /* // Routes for tests. Comment this area section in production or if you don't need it. quitarc
    Route::get('/web', [LaravelVivoClientController::class, 'web'])->name('lvcWeb');
    Route::post('/query', [LaravelVivoClientController::class, 'query'])->name("lvcQuery");
    Route::get('/test/{type}', [LaravelVivoClientController::class, 'test'])->name("lvcTest");
    // End of Routes for tests */
});
