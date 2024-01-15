<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcumb extends Component
{
    public $title, $sub;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $sub = NULL)
    {
        $this->title = $title;
        $this->sub = $sub;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.breadcumb');
    }
}
