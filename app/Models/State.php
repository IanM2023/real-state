<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'states';

    protected $fillable = ['state_name'];

    public static function getAllRecord($with = [])
    {
        return self::with($with)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }


    public function country()
    {
        return $this->belongsTo(Country::class, 'countries_id', 'id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }

}
