<?php

namespace App\View\Components\Landingpage;

use App\Models\ProgramClass;
use Illuminate\View\Component;

class Programs extends Component
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
        $programs = ProgramClass::where('status', 'aktif')->get();
        return view('components.landingpage.programs', compact('programs'));
    }
}
