<?php

namespace carlcs\commons\helpers;

use Craft;

class NumberHelper
{
    /**
     * Converts a decimal number to a representation of that number in another numeral system.
     *
     * @param int $int
     * @param string $system
     * @param int $zero
     * @return string
     */
    public static function numeralSystem(int $int, string $system, int $zero = -1)
    {
        switch ($zero) {
            case -1:
                // Start negative numerals with 0 (i.e. -1 => -B, 0 => -A, 1 => A)
                $int = ($int < 1) ? $int - 1 : $int;
                break;
            case 1:
                // Start positive numerals with 0 (i.e. -1 => -A, 0 => A, 1 => B)
                $int = ($int > -1) ? $int + 1 : $int;
                break;
        }

        if ($int == 0) {
            return $zero;
        }

        if ($int < 0) {
            $int = abs($int);
            $prefix = '-';
        } else {
            $prefix = '';
        }

        switch ($system) {
            case 'roman':
            case 'upperRoman':
                return $prefix.self::_roman($int);
            case 'lowerRoman':
                return $prefix.self::_roman($int, 'lower');
            case 'alpha':
            case 'upperAlpha':
                return $prefix.self::_alpha($int);
            case 'lowerAlpha':
                return $prefix.self::_alpha($int, 'lower');
            default:
                return $int;
        }
    }

    /**
     * Formats a number with unit prefixes.
     *
     * @param float $float
     * @param array|string $system
     * @param int $decimals
     * @param bool $trailingZeros
     * @param string $decPoint
     * @param string $thousandsSep
     * @param string $unitSep
     * @return string
     */
    public static function unitPrefix(float $float, $system = 'decimal', int $decimals = 1, bool $trailingZeros = false, string $decPoint = '.', string $thousandsSep = '', string $unitSep = ' '): string
    {
        if (is_string($system)) {
            $system = self::_getUnitPrefixSettings($system);
        }

        if (!array_key_exists('map', $system)) {
            return $float;
        }

        $base = array_key_exists('base', $system) ? $system['base'] : 10;

        /** @var array $map */
        $map = $system['map'];

        foreach ($map as $exp => $prefix) {
            if ($float >= ($base ** $exp)) {
                $float /= ($base ** $exp);

                $float = number_format($float, $decimals, $decPoint, $thousandsSep);

                if (!$trailingZeros) {
                    $float = self::trimTrailingZeroes($float, $decPoint);
                }

                return $float.$unitSep.Craft::t('site', $prefix);
            }
        }

        return $float;
    }

    /**
     * Converts a fraction to a decimal number.
     *
     * @param string $str
     * @param int $precision
     * @return float
     */
    public static function fractionToFloat(string $str, int $precision = 4): float
    {
        if (self::isFloat($str)) {
            return $str;
        }

        if (self::isFraction($str)) {
            list($numerator, $denominator) = explode('/', $str);

            $float = $numerator / ($denominator ?: 1);

            return round($float, $precision);
        }

        return 0;
    }

    /**
     * Converts a decimal number to a fraction.
     *
     * @see http://jonisalonen.com/2012/converting-decimal-numbers-to-ratios/
     * @param float $float
     * @param float $tolerance
     * @return string
     */
    public static function floatToFraction(float $float, float $tolerance = 0.001): string
    {
        if (!self::isFloat($float)) {
            return 0;
        }

        $h1 = 1;
        $h2 = 0;
        $k1 = 0;
        $k2 = 1;
        $b = 1 / $float;

        do {
            $b = 1 / $b;
            $a = floor($b);
            $aux = $h1;
            $h1 = $a * $h1 + $h2;
            $h2 = $aux;
            $aux = $k1;
            $k1 = $a * $k1 + $k2;
            $k2 = $aux;
            $b -= $a;
        } while (abs($float - $h1 / $k1) > $float * $tolerance);

        if ($h1 == $k1) {
            return $h1;
        }

        return $h1.'/'.$k1;
    }

    /**
     * Returns whether a number is a fraction.
     *
     * @param string $str
     * @return bool
     */
    public static function isFraction(string $str): bool
    {
        return preg_match('/^[-+]?\d*\.?\d+[ ]?\/[ ]?[-+]?\d*\.?\d+$/', $str);
    }

    /**
     * Returns whether a number is a rational number.
     *
     * @param float $float
     * @return bool
     */
    public static function isFloat($float): bool
    {
        return preg_match('/^[-+]?\d*\.?\d+$/', $float);
    }

    /**
     * Trims trailing zeroes.
     *
     * @param int $int
     * @param string $decPoint
     * @return string
     */
    public static function trimTrailingZeroes(int $int, string $decPoint = '.'): string
    {
        return strpos($int, $decPoint) !== false ? rtrim(rtrim($int, '0'), $decPoint) : $int;
    }

    // Private Methods
    // =========================================================================

    /**
     * Converts a decimal number to its roman numberal equivalent.
     *
     * @param int $int
     * @param string $case
     * @return string
     */
    private static function _roman(int $int, string $case = 'upper'): string
    {
        $map = [1000 => 'M', 900 => 'CM', 500 => 'D', 400 => 'CD', 100 => 'C', 90 => 'XC', 50 => 'L', 40 => 'XL', 10 => 'X', 9 => 'IX', 5 => 'V', 4 => 'IV', 1 => 'I'];
        $roman = '';

        foreach ($map as $d => $r) {
            $roman .= str_repeat($r, (int)($int / $d));
            $int %= $d;
        }

        return ($case == 'lower') ? strtolower($roman) : $roman;
    }

    /**
     * Converts a decimal number to its alphabetic equivalent.
     *
     * @param int $int
     * @param string $case
     * @return string
     */
    private static function _alpha(int $int, string $case = 'upper'): string
    {
        $counter = 1;
        for ($alpha = 'A'; $alpha <= 'ZZ'; $alpha++) {
            if ($counter == $int) {
                return ($case == 'lower') ? strtolower($alpha) : $alpha;
            }
            $counter++;
        }

        return '';
    }

    /**
     * Returns configuration settings for unit prefixes.
     *
     * @param string $preset
     * @return array
     */
    private static function _getUnitPrefixSettings(string $preset): array
    {
        $settings = [];

        switch ($preset) {
            case 'names':
                $settings['map'] = [12 => 'trillion', 9 => 'billion', 6 => 'million', 3 => 'thousand', 2 => 'hundred', 0 => ''];
                break;
            case 'decimal':
            case 'decimalSymbol':
                $settings['map'] = [15 => 'P', 12 => 'T', 9 => 'G', 6 => 'M', 3 => 'k', 0 => '', -2 => 'c', -3 => 'm', -6 => 'µ', -9 => 'n'];
                break;
            case 'decimalNames':
                $settings['map'] = [15 => 'peta', 12 => 'tera', 9 => 'giga', 6 => 'mega', 3 => 'kilo', 0 => '', -2 => 'centi', -3 => 'milli', -6 => 'micro', -9 => 'nano'];
                break;
            case 'binary':
            case 'binarySymbol':
                $settings['base'] = 2;
                $settings['map'] = [50 => 'Pi', 40 => 'Ti', 30 => 'Gi', 20 => 'Mi', 10 => 'Ki', 0 => ''];
                break;
            case 'binaryNames':
                $settings['base'] = 2;
                $settings['map'] = [50 => 'pebi', 40 => 'tebi', 30 => 'gibi', 20 => 'mebi', 10 => 'kibi', 0 => ''];
                break;
        }

        return $settings;
    }
}
