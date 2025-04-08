<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputComponent extends Component
{
    public $label,$name,$type,$id,$value;
    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $type = 'text', $id = null, $value = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->id = $id ?? $name;
        $this->value = $value ?? old($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-component');
    }
}
