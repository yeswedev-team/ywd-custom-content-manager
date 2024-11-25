<?php

namespace YwdCustomContentManager;

/**
 * From : https://github.com/yeswedev-team/ywd-acf-field-group
 */
abstract class SingletonInit
{
    private static $instances = [];

    abstract protected function __construct();

    public static function getInstance()
    {
        if (! isset(static::$instances[static::class])) {
            static::$instances[static::class] = new static();
        }
        return static::$instances[static::class];
    }
}
