<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('generateUniqueCode')) {
    function generateUniqueCode() {
        // Get the current date in the desired format
        $datePart = now()->format('Ymd');

        // Generate a unique number (you can use any method you prefer)
        $uniqueNumber = mt_rand(100, 999);

        // Combine the date, unique number, and user ID
        $uniqueCode = $datePart . $uniqueNumber;

        return $uniqueCode;
    }
}
