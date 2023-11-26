<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Property;

class PropertyType extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the property associated with the PropertyType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property(): HasOne
    {
        return $this->hasOne(Property::class, 'ptype_id', 'id');
    }
}
