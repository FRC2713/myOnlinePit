<?php

namespace App\Http\Livewire;

use App\Models\Config;
use Livewire\Component;

class Settings extends Component
{
    public Config $settings;

    protected array $rules = [

        'settings.team' => 'required|int|max:9999',

        'settings.event' => 'required|string|max:500',

    ];
    public function mount()

    {

        $this->settings = \App\Models\Config::all()->first();

    }
    public function render()
    {
        return view('livewire.settings')
            ->extends('layouts.app');
    }

    public function save()

    {

        $this->validate();



        $this->settings->save();

    }
}
