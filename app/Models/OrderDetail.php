<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'OrderDetail';

    // protected $primaryKey = 'id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'quantity',
        'price',
        'sugar_id',
        'ice_id',
        'product_total',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'product_id');
    }

    public function ice()
    {
        return $this->belongsTo(IceOption::class, 'ice_id', 'ice_id');
    }

    public function sugar()
    {
        return $this->belongsTo(SugarOption::class, 'sugar_id', 'sugar_id');
    }
}
