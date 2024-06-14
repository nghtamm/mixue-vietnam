<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurant';

    protected $primaryKey = 'restaurant_id';

    protected $fillable = [
        'restaurant_id',
        'restaurant_name',
        'restaurant_location',
        'restaurant_openTime',
        'restaurant_closeTime',
        'restaurant_openStatus',
        'restaurant_image',
        'tgroup_id',
    ];
}
