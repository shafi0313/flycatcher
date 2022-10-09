<?php

namespace App\Repository\Interfaces;

interface HubInterface
{
    public function allLatestHub();
    public function getHubList();

    public function hubCreate($huData);

    public function updateHub($data, $hub);

    public function deleteHub($hubData);
}
