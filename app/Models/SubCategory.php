<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'subcategory_id'
    ];
}