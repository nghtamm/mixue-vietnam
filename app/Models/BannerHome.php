<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerHome extends Model
{
    use HasFactory;

    protected $table = 'BannerHome';

    protected $primaryKey = 'banner_id';

    protected $fillable = [
        'banner_id',
        'banner_image',
        'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];
}
