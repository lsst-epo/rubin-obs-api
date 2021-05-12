<?php

namespace carlcs\commons\helpers;

class ArrayHelper
{
    /**
     * Traverse an array using dot notation.
     *
     * @see https://selv.in/blog/traversing-arrays-using-dot-notation
     * @param string $path
     * @param array $data
     * @return mixed|null
     */
    public static function getValueByKey(string $path, array $data)
    {
        if (strpos($path, '.') !== false) {
            foreach (explode('.', $path) as $key) {
                if (!array_key_exists($key, $data)) {
                    return null;
                }

                // Continue traversing the array.
                $data = $data[$key];
            }

            return $data;
        }

        return $data[$path] ?? null;
    }
}
