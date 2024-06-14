<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyOrderCount extends Model
{
    use HasFactory;
    protected $table = 'DailyOrderCount';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'order_count',
        'restaurant_id',
    ];
}
