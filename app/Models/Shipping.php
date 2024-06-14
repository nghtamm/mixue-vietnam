<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'Shipping';

    protected $primaryKey = 'shipping_id';

    protected $fillable = [
        'shipping_id',
        'min_distance',
        'max_distance',
        'shipping_fee',
    ];
}
