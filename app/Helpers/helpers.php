<?php

if (!function_exists('ccMasking')) {
    function ccMasking($number, $maskingCharacter = 'X'): string
    {
        return substr($number, 0, 4).str_repeat($maskingCharacter, strlen($number) - 8).substr($number, -4);
    }
}
