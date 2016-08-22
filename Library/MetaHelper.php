<?php

namespace Library;

abstract class MetaHelper
{
    private static $title = 'ГОІ ВАПІ';

    /**
     * @return string
     */
    public static function getTitle()
    {
        return self::$title;
    }

    /**
     * @param string $title
     */
    public static function setTitle($title)
    {
        self::$title = $title;
    }

    public static function addTitle($title)
    {
        self::$title .= ' - ' . $title;
    }


}