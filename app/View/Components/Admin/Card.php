<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.admin.card');
    }
}
