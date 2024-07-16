<?php

namespace App\Helpers;

class TextHelper
{
    public static function truncateWords($text, $wordLimit)
    {
        $words = explode(' ', $text);
        if (count($words) <= $wordLimit) {
            return $text;
        }

        $truncatedText = implode(' ', array_slice($words, 0, $wordLimit)) . '...';
        return $truncatedText;
    }
}
