<?php

namespace App;

use App\Models\Addon;
use App\Models\AddonCategory;
use App\Models\AddonCategoryItem;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function addonCategories()
    {
        return $this->hasMany(AddonCategory::class);
    }

    public function addonItems(){
        return $this->hasMany(AddonCategoryItem::class);
    }
    public function categories(){
        return $this->belongsTo(AddonCategory::class);
    }
}
