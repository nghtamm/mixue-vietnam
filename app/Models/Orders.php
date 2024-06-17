<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'Orders';

    protected $primaryKey = 'id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'total_price',
        'shipping_id',
        'restaurant_id',
        'user_note',
        'bill_status',
        'payment_status',
        'order_payment',
        'is_asap',
        'scheduled_delivery_time',
        'order_gift',
        'order_name',
        'order_phone',
        'order_address',
        'order_date',
        'daily_order_number',
        'created_at',
        'quantity',
        'telegram_id',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(UserMixue::class, 'user_id', 'user_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'shipping_id');
    }

    public function staff()
    {
        return $this->belongsTo(NhanVien::class, 'telegram_id', 'telegram_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'restaurant_id');
    }
    public function OrderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id');
    }
}
