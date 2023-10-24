<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $appends = ['sub_categories'];

    public function getSubcategoriesAttribute()
    {
        return SubCategory::select("categories.id", "categories.name")
            ->join("categories", "categories.id", "subcategories.subcategory_id")
            ->where("subcategories.category_id", $this->id)
            ->get();
    }
}
