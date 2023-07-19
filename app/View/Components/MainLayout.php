<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainLayout extends Component
{
    // protected $title;
    /**
     * Create a new component instance.
     */
    public function __construct( public string $title,public $class='' )
    {
        // $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.main');
        // [
        //     'title' =>$this->title,
        // ]);
    }
}