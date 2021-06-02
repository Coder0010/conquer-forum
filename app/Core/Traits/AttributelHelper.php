<?php

namespace App\Core\Traits;

trait AttributelHelper
{
    /**
     * setSectionsAttribute
     */
    public function setSectionsAttribute($incoming_data)
    {
        $main_array = [];
        if ($incoming_data) {
            foreach ($incoming_data as $key => $data) {
                $main_array[$key] = [];
                if (is_array($data)) {
                    foreach ($data as $value) {
                        if (isset($value["title"]) && isset($value["description"])) {
                            $main_array[$key][] = [
                                "title"       => $value["title"],
                                "description" => $value["description"],
                            ];
                        }
                    }
                }
            }
            $this->attributes["sections"] = json_encode($main_array);
        }
    }

    /**
     * This attribute function for returning the value of name.  => { name_val }
     */
    public function getNameValAttribute()
    {
        return $this->attributes["name_".app()->getLocale()];
    }

    /**
     * This attribute function for returning the value of description_en.  => { description_en }
     */
    public function getDescriptionEnAttribute($value)
    {
        if ($this->data) {
            return (isset($this->data["description_en"]) || $this->data["description_en"] != null) ? $this->data["description_en"] : "-";
        }
        return "-";
    }

    /**
     * This attribute function for returning the value of description_ar.  => { description_ar }
     */
    public function getDescriptionArAttribute($value)
    {
        if ($this->data) {
            return (isset($this->data["description_ar"]) || $this->data["description_ar"] != null) ? $this->data["description_ar"] : "-";
        }
        return "-";
    }

    /**
     * This attribute function for returning the value of description_val.  => { description_val }
     */
    public function getDescriptionValAttribute($value)
    {
        if ($this->data) {
            return (isset($this->data["description_".app()->getLocale()]) || $this->data["description_".app()->getLocale()] != null) ? $this->data["description_".app()->getLocale()] : "-";
        }
        return "-";
    }
}
