<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $guarded = [];

    public function addon_categories($addon_category_id) {
        return AddonCategory::all()->where('id','=',$addon_category_id);
    }
}
