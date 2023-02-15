<?php

namespace App\View\Components\Admin\Table;

use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;

    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }
    public function render()
    {
        return view('components.admin.table.table');
    }
}
