<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WeekTime extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'week_times';

    protected $fillable = [
        'id',
        'week_time',
        'created_at',
        'updated_at',
    ];
}
