<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecordsList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected array $records)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.records-list');
    }
}
