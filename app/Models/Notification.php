<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory, Notifiable;
    
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'read_at',
        'created_at',
        'updated_at',
    ];
}
