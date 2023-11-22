<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Amenities;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

/*     public function amenities()
    {
        return $this->belongsToMany(Amenities::class);
    } */
}
