<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Week extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'weeks';

    protected $fillable = [
        'id',
        'week_name',
        'created_at',
        'updated_at',
    ];

}
