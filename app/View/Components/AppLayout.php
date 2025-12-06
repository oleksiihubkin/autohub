<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Render the layout component.
     *
     * This method returns the Blade view used as the main
     * application layout. Components like <x-app-layout>
     * will wrap their content inside this layout.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
