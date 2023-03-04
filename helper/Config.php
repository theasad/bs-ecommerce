<?php

namespace helper;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use Exception;

class Config
{
    const CONFIG_DIR = 'config' . DIRECTORY_SEPARATOR;
    protected static array $config;
    protected static string $fileName;

    /**
     * @throws Exception
     */
    public static function get($key, $default = null)
    {
        $parts = explode('.', $key);
        self::$fileName = reset($parts);
        $value = self::load();

        foreach (array_slice($parts, 1) as $part) {
            if (!isset($value[$part])) {
                return $default;
            }

            $value = $value[$part];
        }

        return $value;
    }

    /**
     * @throws Exception
     */
    protected static function load()
    {
        if (!isset(self::$config[self::$fileName])) {
            if (!self::isConfigFileExists()) {
                throw new Exception(sprintf("Configuration file %s not found", self::$fileName));
            }

            self::$config[self::$fileName] = require self::filePath();
        }
        return self::$config[self::$fileName];
    }


    /**
     * @return string
     */
    protected static function filePath(): string
    {
        return self::CONFIG_DIR . self::$fileName . '.php';
    }


    /**
     * @return bool
     */
    protected static function isConfigFileExists(): bool
    {
        return file_exists(self::filePath());
    }
}
