<?php

use \Illuminate\Support\Facades\Request;

if (!function_exists('isCurrentRoute')) {
    function isCurrentRoute(string $routeName): bool
    {
        return Request::route()->getName() === $routeName;
    }
}

if (!function_exists('isCurrentPath')) {
    function isCurrentPath(string $path): bool
    {
        return request()->is($path);
    }
}
