<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Schedule extends Model
{
    protected $table = 'schedules_user';

    protected $fillable = [
        'id',
        'user_id',
        'week_id',
        'start_time',
        'end_time',
        'status',
        'created_at',
        'updated_at',
    ];

    public static function getDetail($weekid)
    {
        return self::where('week_id', '=', $weekid)
                        ->where('user_id', '=', Auth::user()->id)
                        ->first();
    }
}
