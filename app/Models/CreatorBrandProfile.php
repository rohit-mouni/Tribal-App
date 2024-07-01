<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorBrandProfile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'creator_brand_profile';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

