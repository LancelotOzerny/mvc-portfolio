<?php

namespace Core\Patterns;

trait Singleton
{
    private static self | null $instance = null;

    public static function getInstance(): static
    {
        if (!isset(static::$instance))
        {
            static::$instance = new static();
        }

        return static::$instance;
    }
}