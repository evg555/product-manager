<?php


namespace MyTest;

class StringHelper
{
    public static function safeString($value, $maxLength = false)
    {
        if (!isset($value)) {
            return "";
        }

        $maxLength = intval($maxLength);

        $value = htmlspecialchars($value);
        $value = trim($value);

        if ($maxLength && mb_strlen($value, SITE_CHARSET) > $maxLength) {
            $value = mb_substr($value, 0, $maxLength, SITE_CHARSET);
        }

        return $value;
    }
}