<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMTP extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 's_m_t_p_s';

    protected $fillable = [
        'app_name',
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
    ];

    static public function getSingleFirst()
    {
        return self::find(1);
    }
}
