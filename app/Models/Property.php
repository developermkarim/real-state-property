<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PropertyType;
use App\Models\MultiImage;
use App\Models\Amenities;

class Property extends Model
{
    use HasFactory, SoftDeletes;
  
    protected $guarded = [];

/*     public function amenities()
    {
        return $this->belongsToMany(Amenities::class);
    } */


      /**
         * Get all of the multi_images for the Property
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */

        public static function boot()
        {
            parent::boot();
    
            static::deleting(function ($property) {
                // Manually soft delete related multi_images
                $property->multi_images()->update(['deleted_at' => now()]);
            });
        }
    
        public function multi_images() : HasMany
        {
            return $this->hasMany(MultiImage::class);
        }

  
        /**
         * Get the propertyType that owns the Property
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function propertyType(): BelongsTo
        {
            return $this->belongsTo(PropertyType::class,'ptype_id','id');
        }

}
