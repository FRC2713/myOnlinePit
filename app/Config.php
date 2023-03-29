<?php

namespace App;

class Config
{
    public static function team(): int {
        return \App\Models\Config::query()->get("team")[0]["team"];
    }
//7203
//    public static string $event = '2023mila2';
    public static function event(): string {
        return \App\Models\Config::query()->get("event")[0]["event"];
    }
}
