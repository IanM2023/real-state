<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Smtp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'smtps';

    protected $fillable = [
        'id',
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
        // Prevent query if table doesn't exist
        if (Schema::hasTable('Smtp')) {
            return new self(); // return empty model instance
        }
    
        $record = self::find(1);
    
        if (!$record) {
            $record = self::create([
                'app_name' => config('app.name'),
            ]);
        }
    
        return $record;
    }
    


}
