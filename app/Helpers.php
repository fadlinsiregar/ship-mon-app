<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($date) {
        return Carbon::parse($date)->format('d F Y');
    }
}

if (!function_exists('activeRoute')) {
    function activeRoute($route) {
        return request()->is($route) ? 'active' : '';
    }
}
