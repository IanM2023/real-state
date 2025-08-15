<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo',
        'phone',
        'address',
        'about',
        'website',
        'role',
        'status',
        'token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getRecord($search = null, $startDate = null, $endDate = null)
    {
        $query = self::select('*')->orderBy('id', 'desc');
    
        // Search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('role', 'like', '%' . $search . '%');
            });
        }
    
        // Date range filter
        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate))
            ]);
        } elseif (!empty($startDate)) {
            $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($startDate)));
        } elseif (!empty($endDate)) {
            $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($endDate)));
        }
    
        return $query->paginate(10);
    }
    

    public static function countBy($column, $value)
    {
        return self::where($column, $value)->count();
    }
    
    
}
