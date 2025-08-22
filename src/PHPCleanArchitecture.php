<?php

namespace GiacomoMasseroni\PHPCleanArchitecture;

final class PHPCleanArchitecture
{
    private static PHPCleanArchitecture $instance;

    /**
     * Singleton's constructor should not be public. However, it can't be
     * private either if we want to allow subclassing.
     */
    protected function __construct() {}

    /**
     * The method you use to get the Singleton's instance.
     */
    private static function getInstance(): PHPCleanArchitecture
    {
        if (!isset(self::$instance)) {
            self::$instance = new PHPCleanArchitecture();
        }

        return self::$instance;
    }

    public static function __callStatic(string $name, mixed $arguments): PHPCleanArchitecture
    {
        $instance = self::getInstance();
        $instance->$name(...$arguments);

        return $instance;
    }

    public function __call(string $name, mixed $arguments): PHPCleanArchitecture
    {
        $this->$name(...$arguments);

        return $this;
    }
}
