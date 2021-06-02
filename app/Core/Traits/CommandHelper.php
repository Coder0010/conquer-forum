<?php

namespace App\Core\Traits;

use Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait CommandHelper
{
    /**
     * $confirmation
     * @var Boolen
     */
    protected $confirmation = false;

    /**
     * Asking For Password to proceed.
     * @param  $message Default strin.
     * @return Boolen
     */
    public function askingForPassword($message = "Start")
    {
        $this->comment("--------==/*$message*\==--------");
        $details["email"] = "mostafakamel000@yahoo.com";
        $this->info("Email:- ".$details["email"]);
        $details["password"] = $this->ask("Password");
        if (config("system.developer.email") == $details["email"] && $details["password"] == config("system.developer.password")) {
            $this->comment("Asked for Password");
            $this->comment("--------==/*Make Your Chocie*\==--------");
            return;
        }
        $this->error("----CommandHelper.askingForPassword Password is Wrong----");
        $this->comment("--------==/**\==--------");
        $this->askingForPassword($message);
    }

    /**
     * Optimize Project
     * This Method For Optimizing Project
     * @return Boolen
     */
    protected function optimizeProject()
    {
        Artisan::call("optimize:clear");
        return;
    }
}
