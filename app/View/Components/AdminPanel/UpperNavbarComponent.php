<?php

namespace App\View\Components\AdminPanel;

use Illuminate\View\Component;

class UpperNavbarComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('adminpanel.components.upper-navbar-component', [
            "data" => $this->data()
        ]);
    }

    public function data()
    {
        return [
            [
                "type"   => "single-level-menu",
                "id"     => "auths-link",
                "title"  => "main.auths",
                "icon"   => "flaticon-user",
                "route"  => "admin.auths",
                "roles"  => "Super_Role",
            ],/* auths */
            [
                "type"   => "single-level-menu",
                "id"     => "generals-link",
                "title"  => "main.generals",
                "icon"   => "flaticon2-soft-icons",
                "route"  => "admin.generals",
                "roles"  => "Super_Role",
            ],/* generals */
        ];
    }
}
