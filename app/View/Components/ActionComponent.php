<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionComponent extends Component
{
    public $status;
    public $actions;
    public function __construct($actions, $status)
    {
        $this->actions = $actions;
        $this->status = $status;
    }

    public function render()
    {
        return view('components.action-component');
    }
}
