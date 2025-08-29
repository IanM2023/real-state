<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cities';

    protected $fillable = [
        'city_name'
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function country()
    {
        // Optional shortcut if you want city->country
        return $this->hasOneThrough(
            Country::class,
            State::class,
            'id',           // Foreign key on states table
            'id',           // Foreign key on countries table
            'state_id',     // Local key on cities table
            'countries_id'  // Local key on states table
        );
    }

    public static function getAllRecord($with = [], $search = null)
    {
        $record = self::with($with)
                        ->latest();
    
        // Apply search if provided
        if (!empty($search)) {
            $record->where(function ($query) use ($search) {
                // Search in city_name (current table)
                $query->where('city_name', 'like', '%' . $search . '%')
                    // Search in related country
                    ->orWhereHas('country', function ($q) use ($search) {
                        $q->where('country_name', 'like', '%' . $search . '%');
                    })
                    // Search in related state
                    ->orWhereHas('state', function ($q) use ($search) {
                        $q->where('state_name', 'like', '%' . $search . '%');
                    });
            });
        }
    
        return $record->paginate(10);
    }
    
}
