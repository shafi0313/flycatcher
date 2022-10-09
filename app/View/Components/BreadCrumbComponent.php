<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BreadCrumbComponent extends Component
{
    public $title;
    public $links;

    public function __construct($title, $links)
    {
        $this->title = $title;
        $this->links = $links;
    }

    public function render()
    {
        return view('components.bread-crumb-component');
    }
}
