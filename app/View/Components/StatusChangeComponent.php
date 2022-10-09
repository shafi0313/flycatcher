<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatusChangeComponent extends Component
{
   public $title;
   public $status;
   public $route;
    public function __construct($route, $status, $title)
    {
        $this->route = $route;
        $this->status = $status;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.status-change-component');
    }
}
