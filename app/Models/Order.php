<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'product_id',
        'qty'
    ];

    public static function getRecord($search = null, $startDate = null, $endDate = null)
    {
        $record = self::select('orders.*', 'products.title')
            ->join('products', 'products.id', '=', 'orders.product_id');
    
        // Apply search if provided
        if (!empty($search)) {
            $record->where(function($query) use ($search) {
                $query->where('products.title', 'like', '%' . $search . '%')
                      ->orWhere('orders.id', 'like', '%' . $search . '%')
                      ->orWhere('orders.qty', 'like', '%' . $search . '%');
            });
        }
    
        // Date range filter
        if (!empty($startDate) && !empty($endDate)) {
            $record->whereBetween('orders.created_at', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate))
            ]);
        } elseif (!empty($startDate)) {

            $record->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime($startDate)));

        } elseif (!empty($endDate)) {

            $record->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime($endDate)));
            
        }
    
        return $record->orderBy('orders.id', 'desc')->paginate(10);
    }
    


    public function getColor()
    {
        return $this->hasMany(OrderDetail::class, 'order_id')
            ->select('order_details.*', 'colors.color_name')
            ->join('colors', 'colors.id', '=', 'order_details.color_id');
    }


}
