<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenCategory extends Model
{
    use HasFactory;

    protected $table = 'menCategories';

    protected $fillable = [
        'name'
    ];

    public function subcategories()
    {
        return $this->morphMany(Subcategory::class, 'category', 'categoryType', 'categoryId');
    }
}
