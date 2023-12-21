<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// TODO: для роутов админки создать отдельный файл

//Route::get('{any?}', fn() => view('app'))->where('any', '.*');
Route::get('test', function () {
    return response()->json('12345');
});

Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return 'Успешно подключено к базе данных: ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return 'Не удалось подключиться к базе данных';
    }
});
