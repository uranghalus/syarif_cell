<?php

namespace App\Helpers;

if (!function_exists('shorten_text')) {
    function shorten_text($text, $max_length = 100, $suffix = '...')
    {
        if (strlen($text) <= $max_length) {
            return $text;
        }

        $shortened_text = substr($text, 0, $max_length);
        $last_space = strrpos($shortened_text, ' ');
        if ($last_space !== false) {
            $shortened_text = substr($shortened_text, 0, $last_space);
        }

        return rtrim($shortened_text) . $suffix;
    }
}
