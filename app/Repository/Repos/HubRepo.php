<?php

namespace App\Repository\Repos;

use App\Models\Hub;
use App\Repository\Interfaces\HubInterface;

class HubRepo implements HubInterface
{
    public function allLatestHub()
    {
        return Hub::with('area')->latest('id');
    }

    public function getHubList(){
        return Hub::where('status', 'active')->get();
    }

    public function hubCreate($huData){
        return Hub::create($huData);
    }
    public function updateHub($data, $hub){
        return $hub->update($data);
    }

    public function deleteHub($hubData){
        return $hubData->delete();
    }
}
