<?php

namespace App\View\Components\Admin\Form;

use Illuminate\View\Component;

class Form extends Component
{
    public string $route;

    public string $method;

    public string $methodForm;

    public function __construct(string $route = '#', string $method = 'get')
    {
        $this->route = $route;
        $this->method = strtoupper($method);
        $this->methodForm = strtolower($method) == 'get' ? 'GET' : 'POST';
    }
    public function render()
    {
        // return function (array $data)
        // {
        //     if (isset($data['attributes']['enctype'])) {
        //         $data['attributes']['file'] = $data['attributes']['enctype'];
        //     }else {
        //         $data['attributes']['file'] = '';
        //     }
        return view('components.admin.form.form');
        // };
    }
}
