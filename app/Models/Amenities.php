<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Property;

class Amenities extends Model
{
    protected $table = 'amenities';
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the Amenities
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class,'amenities_id','id'); // $this->belongsTo(Property::class, 'foreign_key', 'other_key');
    }
    
  
}
