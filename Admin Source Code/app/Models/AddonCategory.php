<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddonCategory extends Model
{
    protected $guarded = [];

//    public function addonProducts()
//    {
//        return $this->hasMany('App\Models\Addon');
//    }

    public function addons()
    {
        return $this->hasMany(Addon::class);
    }
}
