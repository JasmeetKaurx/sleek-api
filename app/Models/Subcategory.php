<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'categoryType',
        'categoryId'
    ];

    protected $hidden = [
        'categoryType'
    ];

    public function category()
    {
        return $this->morphTo(__FUNCTION__, 'categoryType', 'categoryId');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategoryId');
    }
}
