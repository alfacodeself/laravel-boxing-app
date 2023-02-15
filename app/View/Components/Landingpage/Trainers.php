<?php

namespace App\View\Components\Landingpage;

use App\Models\Trainer;
use Illuminate\View\Component;

class Trainers extends Component
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
        $trainers = Trainer::get();
        return view('components.landingpage.trainers', compact('trainers'));
    }
}
