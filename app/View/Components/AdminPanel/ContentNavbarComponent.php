<?php

namespace App\View\Components\AdminPanel;

use Illuminate\View\Component;

class ContentNavbarComponent extends Component
{
    public $child;
    public $parent;
    public $parentRoute;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($child, $parent = null, $parentRoute = null)
    {
        $this->child = $child;
        $this->parent = $parent;
        $this->parentRoute = $parentRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('adminpanel.components.content-navbar-component');
    }
}
