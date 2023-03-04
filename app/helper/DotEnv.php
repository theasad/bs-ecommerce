<?php

namespace App\Helper;

class DotEnv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected static string $path;

    public static function load($path): void
    {
        self::$path = $path;
        if (!file_exists(self::$path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        self::$path = $path;
        if (!is_readable(self::$path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', self::$path));
        }

        $lines = file(self::$path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}