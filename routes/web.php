<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "
        Run this app on CLI with

        <span style=\"
            background-color: #444;
            color: #eee;
            padding: 4px;
            font-weight: bold;
            font-family: 'Courier New';
        \">php artisan roach:run ReadOnePieceCom</span>
        ";
});
