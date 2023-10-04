<?php

namespace Config;

class Config
{
    public function __construct()
    {
        $envFilePath = __DIR__ . '/../.env';
        if (file_exists($envFilePath)) {
            $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                if (str_contains($line, '=')) {
                    list($key, $value) = explode('=', $line, 2);
                    putenv("$key=$value");
                }
            }
        }
    }

    public function get(string $key): bool|array|string
    {
        return getenv($key);
    }
}
