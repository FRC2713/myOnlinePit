<?php

namespace App\Http;

use App\Config;
use App\Models\PitList;

class API
{
    public function getByMatch(string $id, string $event = null)
    {
        $event ??= Config::event();
        $query = PitList::query()->where(['match_num' => $id, 'event' => $event]);
        if ($query->count() > 0) {
            return $query->get()[0];
        } else {
            return [
                'error' => "Cannot find given match number's pit list",
            ];
        }
    }
    public function config() {
        return [
            "event" => Config::event(),
            "team" => Config::team()
        ];
    }
}
