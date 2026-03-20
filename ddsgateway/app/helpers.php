<?php

declare(strict_types=1);

if (!function_exists('config_path')) {
    function config_path(string $path = ''): string
    {
        $base = dirname(__DIR__);
        $config = $base.DIRECTORY_SEPARATOR.'config';

        if ($path === '') {
            return $config;
        }

        return $config.DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR);
    }
}

