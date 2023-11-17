<?php

namespace App\Formatter;

class UserResponseFormatter
{
    public static function format(array $users): array
    {
        return array_map(function ($user) {
            return $user->toArray();
        }, $users);
    }
}
