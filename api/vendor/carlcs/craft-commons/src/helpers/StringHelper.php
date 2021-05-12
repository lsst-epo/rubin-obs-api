<?php

namespace carlcs\commons\helpers;

use Craft;
use Stringy\Stringy;

class StringHelper
{
    // Public Methods
    // =========================================================================

    /**
     * Highlights given terms in a text.
     *
     * @param string $str
     * @param array|string $terms
     * @param string|null $format
     * @return string
     */
    public static function highlight(string $str, $terms, string $format = null): string
    {
        $format = $format ?: '<mark>\1</mark>';

        if (!is_array($terms)) {
            $terms = (array)$terms;
        }

        $terms = array_map(function($term) {
            return preg_quote(trim($term), '/');
        }, $terms);

        $pattern = '('.implode('|', $terms).')';

        return (string)Stringy::create($str)->regexReplace($pattern, $format, 'imsr');
    }

    /**
     * Returns a comma separated list where the last two items are joined with “and”.
     *
     * @param array $items
     * @param string|null $and
     * @param string $separator
     * @return string
     */
    public static function sentenceList(array $items, string $and = null, string $separator = ', '): string
    {
        $and = $and ? Craft::t('site', $and) : Craft::t('site', ', and ');

        if (count($items) > 1) {
            $start = implode($separator, array_slice($items, null, -1));
            return $start.$and.array_pop($items);
        }

        return array_pop($items) ?? '';
    }

    /**
     * Returns the input string stripped from all words of a given list of words.
     *
     * @param string $str
     * @param array $list
     * @param bool $ignoreCase
     * @return string
     */
    public static function stripWords(string $str, array $list, bool $ignoreCase = true): string
    {
        foreach ($list as &$word) {
            $word = '/\b'.preg_quote($word, '/').'\b/';
            $word .= $ignoreCase ? 'i' : '';
        }

        return preg_replace($list, '', $str);
    }

    /**
     * Returns the input string stripped from all punctuation.
     *
     * @param string $str
     * @return string
     */
    public static function stripPunctuation(string $str): string
    {
        return preg_replace('/[^\w\s]/u', '', $str);
    }
}
