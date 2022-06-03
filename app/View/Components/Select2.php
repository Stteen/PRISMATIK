<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select2 extends Component
{

    public $model, $action, $default, $method, $select2_id,$attachToModal,$restrictors;

    public function __construct($model, $action, $method='', $default='', $attachToModal='',$restrictors='')
    {
        $this->model = $model;
        $this->action = $action;
        $this->method = $method;
        $this->default = $default;
        $this->select2_id='s_'.rand();
        $this->attachToModal = $attachToModal;
        $this->restrictors = $restrictors;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select2');
    }
}