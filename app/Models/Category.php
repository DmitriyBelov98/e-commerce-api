<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
}
