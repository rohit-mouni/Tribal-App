<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $guarded = [];

    public function CategoryInfo()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
