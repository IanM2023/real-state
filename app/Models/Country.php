<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'countries';

    protected $fillable =
    [
        'country_name'
    ];

    public static function getAllRecord()
    {
        $query = self::select('*')->orderBy('id', 'desc');
    
        // Search filter if needed
        // if (!empty($search)) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('country_name', 'like', '%' . $search . '%');
        //     });
        // }
    

        return $query->paginate(10);
    }

    public function states()
    {
        return $this->hasMany(State::class, 'id');
    }
}
