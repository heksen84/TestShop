<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $appends = ['subCategories'];

    public function getSubcategoriesAttribute()
    {
        /*        return MuscleGroup::select("muscle_groups.id", "muscle_groups.name")
            ->join("exercise_muscle_groups", "exercise_muscle_groups.muscle_group_id", "muscle_groups.id")
            ->where("exercise_muscle_groups.exercise_id", $this->id)
            ->distinct()
            ->get();*/
        return "hello";
    }
}
