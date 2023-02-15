<?php

namespace App\View\Components\Landingpage;

use App\Models\Gallery;
use Illuminate\View\Component;

class Galleries extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $galleries = Gallery::get();
        return view('components.landingpage.galleries', compact('galleries'));
    }
}
