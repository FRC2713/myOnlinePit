<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PastLists extends Component
{
    public string | bool $error = false;
    public string $matchID = "";

    public string $eventID = "";

    public function mount() {
        $this->eventID = \App\Config::event();
    }

    public function render()
    {
        $this->eventID = \App\Config::event();

        return view('livewire.past-lists')
            ->extends('layouts.app');
    }

    public function submit()
    {
        if(empty($this->matchID) || empty($this->eventID)) {
            $this->error = "Specify match and event id";
            return;
        }
        redirect()->route('specificmatch', [
            "id" => $this->matchID,
            "event" => $this->eventID
        ]);
    }
}
