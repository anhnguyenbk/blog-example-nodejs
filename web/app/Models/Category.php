<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function allMainCategoriesWithChildren()
    {
        return self::whereNull('parent_id')->with('childrenCategories')->get();
    }
}
