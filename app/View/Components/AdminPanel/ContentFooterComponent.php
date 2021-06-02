<?php

namespace App\View\Components\AdminPanel;

use Illuminate\View\Component;

class ContentFooterComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('adminpanel.components.content-footer-component');
    }
}
