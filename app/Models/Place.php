<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'city',
        'state',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($place) {
            if (empty($place->slug)) {
                $place->slug = Str::slug($place->name);
            }
        });
        
        static::updating(function ($place) {
            if ($place->isDirty('name') && !$place->isDirty('slug')) {
                $place->slug = Str::slug($place->name);
            }
        });
    }
}
