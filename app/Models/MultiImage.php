<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Property;

class MultiImage extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'multi_images';

    protected $guarded = [];

    public function property() : BelongsTo 
    {
        return $this->BelongsTo(Property::class);
    }
}
