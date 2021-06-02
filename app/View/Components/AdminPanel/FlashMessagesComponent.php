<?php

namespace App\View\Components\AdminPanel;

use Illuminate\View\Component;

class FlashMessagesComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('adminpanel.components.flash-messages-component');
    }
}
