<?php

namespace App\Http\Livewire;

use App\Config;
use App\Models\PitList;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Form extends Component
{
    public array $checks = [


        ['name' => 'Kinetic Tests', 'type' => 'header'],

        ['name' => 'Driving', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Drive wheels not wobbly', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Intake cube', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Score cube', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Intake upright cone', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Intake tipped cone', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Score cone', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Elevator low', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Elevator mid', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Elevator high', 'value' => false, 'type' => 'boolean'],


        ['name' => 'Static Tests', 'type' => 'header'],

        ['name' => 'Chassis', 'type' => 'header2'],
        ['name' => 'Bumpers set to correct colour', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Bumpers tightly secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Module <-> chassis bolt tightened', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Module 12-24 bolts tightened', 'value' => false, 'type' => 'boolean'],
        ['name' => 'No carpet in wheels/module', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Check tread wear on wheels', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Swerve motors securely mounted', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Module corner bolt secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Sponsor panels secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Elevator', 'type' => 'header2'],
        ['name' => 'Rope evenly tensioned', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Rope secure to capstan and carriage', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Elevator bolts secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Shaft collars on gear box secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Pulleys secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Bearing blocks secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Bearings touching 2x1', 'value' => false, 'type' => 'boolean'],
        ['name' => 'End Effector + 4-Bar', 'type' => 'header2'],
        ['name' => 'Flopper aligned', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Belts tensioned', 'value' => false, 'type' => 'boolean'],
        ['name' => '4-Bar bolts secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Electronics', 'type' => 'header2'],
        ['name' => 'Radio bolts secured', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Wires clear of swerve modules, elevator, and end effector', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Radio ethernet secured', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Main breaker secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'New battery above 115% charge', 'value' => false, 'type' => 'boolean'],
        ['name' => 'New battery placed into robot', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Spark LEDs on', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Spark Max thumb screws tight', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Sensor thumb screws tight', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Limelight bolts secure', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Chassis -> Carriage routing checked', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Software', 'type' => 'header2'],
        ['name' => 'Gyro Working on Shuffleboard', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Limelight working', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Intake sensor(s) working', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Tuning mode disabled', 'value' => false, 'type' => 'boolean'],
        ['name' => 'Debug mode disabled', 'value' => false, 'type' => 'boolean'],

        ['name' => 'Notes', 'value' => '', 'type' => 'string'],
        ['name' => 'New battery number', 'value' => '', 'type' => 'string'],


    ];

    public bool $showModal = false;

    public bool $hasSubmitted = false;

    public string $match = '';

    public string $signed = '';

    public string $event;

    public string | bool $error = false;

    public function mount(string $id = '', string | null $event = null)
    {
        $event ??= Config::event();
        $this->event = $event;
        $this->match = $id;
        if (! empty($id)) {
            $this->hasSubmitted = true;
        }
    }

    public function render()
    {
        if (empty($this->match)) {
            $this->getNextMatch();
        }
        $query = PitList::query()->where(['match_num' => $this->match, "event" => $this->event]);
        if ($query->count() > 0) {
            if (!empty($query->get('signed')[0]['signed'])) {
                $this->hasSubmitted = true;
                $this->signed = $query->get('signed')[0]['signed'];
            }
            $this->checks = $query->get('list')[0]['list'];
        } elseif ($this->hasSubmitted) {
            exit('Match not found');
        }

        return view('livewire.form')
            ->extends('layouts.app');
    }

    public function submitForm()
    {
        $query = PitList::query()->where(['match_num' => $this->match, "event" => $this->event]);
        if ($query->count() === 0) {
            \App\Models\PitList::create(['signed' => $this->signed, 'list' => $this->checks, 'match_num' => $this->match, 'event' => $this->event]);
        } else {
            $query->update(['signed' => $this->signed, 'list' => $this->checks]);
        }
    }

    public function submit()
    {
        $query = PitList::query()->where(['match_num' => $this->match, 'event' => $this->event]);
        if ($query->count() > 0) {
            $query->update(['signed' => $this->signed]);
        }
        $this->showModal = false;
    }

    public function getNextMatch(): void
    {
//        $ch = curl_init();
//        $url = 'https://www.thebluealliance.com/api/v3/team/frc'.Config::$team.'/event/'.Config::$event.'/matches';
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIYPEER, 0)
//        curl_setopt($ch, CURLOPT_FAILONERROR, true); // Required for HTTP error codes to be reported via our call to curl_error($ch)
//        curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-TBA-Auth-Key: uSqAJfiJwCciUTUQGRKjcSqdnq2p33fUWBseQePtdjS7bNvtbaPZ0nh7yUPdVbi0']);
//        $result = curl_exec($ch); // run!
//        curl_close($ch);
//        if (curl_errno($ch)) {
//            return curl_error($ch);
//        }
//        return $result ? "true" : "false";
//        $client = new \GuzzleHttp\Client(["headers" => ['X-TBA-Auth-Key: uSqAJfiJwCciUTUQGRKjcSqdnq2p33fUWBseQePtdjS7bNvtbaPZ0nh7yUPdVbi0']]);
//        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://www.thebluealliance.com/api/v3/team/frc'.Config::$team.'/event/'.Config::$event.'/matches');
//        $client->sendAsync($request)->then(function ($response) {
//            $this->match = $response->getBody();
//        });
//        return '';
        //{"2":{"actual_time":null,"alliances":{"blue":{"dq_team_keys":[],"score":-1,"surrogate_team_keys":[],"team_keys":["frc6078","frc6002","frc7203"]},"red":{"dq_team_keys":[],"score":-1,"surrogate_team_keys":[],"team_keys":["frc4381","frc2767","frc5559"]}},"comp_level":"f","event_key":"2023mila2","key":"2023mila2_f1m3","match_number":3,"post_result_time":null,"predicted_time":1679951456,"score_breakdown":null,"set_number":1,"time":1679950980,"videos":[],"winning_alliance":""}}
        $response = Http::withHeaders([
            'X-TBA-Auth-Key' => 'uSqAJfiJwCciUTUQGRKjcSqdnq2p33fUWBseQePtdjS7bNvtbaPZ0nh7yUPdVbi0',
        ])->get('https://www.thebluealliance.com/api/v3/team/frc'.Config::team().'/event/'.$this->event.'/matches');
        if ($response->ok()) {
//            $tmp = '{"2":{"actual_time":null,"alliances":{"blue":{"dq_team_keys":[],"score":-1,"surrogate_team_keys":[],"team_keys":["frc6078","frc6002","frc7203"]},"red":{"dq_team_keys":[],"score":-1,"surrogate_team_keys":[],"team_keys":["frc4381","frc2767","frc5559"]}},"comp_level":"f","event_key":"2023mila2","key":"2023mila2_f1m3","match_number":3,"post_result_time":null,"predicted_time":1679951456,"score_breakdown":null,"set_number":1,"time":1679950980,"videos":[],"winning_alliance":""}}';

            $upcoming = array_filter($response->json(), function ($ele) {
                return $ele['actual_time'] === null;
            });
//            $upcoming = array_filter(json_decode($tmp, true), function ($ele) {
//                return $ele['actual_time'] === null;
//            });
            if(!empty(array_key_first($upcoming))) {
                $upcoming = $upcoming[array_key_first($upcoming)];
                $this->match = strtoupper($upcoming['comp_level'][0]).$upcoming['match_number'];

            }
            else {
                $this->error = 'No more upcoming matches';
            }
        }
    }
}
