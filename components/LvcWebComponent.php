<?php

namespace Gitescire\LaravelVivoClient\Components;

use Illuminate\View\Component;

class LvcWebComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('laravel-vivo-client::components.lvc-web-component');
    }
}
