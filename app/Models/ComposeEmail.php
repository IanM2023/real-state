<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComposeEmail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'compose_emails';

    protected $fillable = [
        'id',
        'user_id',
        'cc_email',
        'subject',
        'descriptions',
        'created_at',
        'updated_at',
    ];

    public static function getAgentRecord($userId)
    {
        return self::select('compose_emails.*')
                        ->where('compose_emails.user_id', '=' , $userId)
                        ->get();
    }
}
