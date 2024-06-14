<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IceOption extends Model
{
    use HasFactory;

    protected $table = 'iceOption';

    protected $primaryKey = 'ice_id';

    protected $fillable = [
        'ice_id',
        'ice_option',
    ];
}
