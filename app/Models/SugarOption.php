<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SugarOption extends Model
{
    use HasFactory;

    protected $table = 'sugarOption';

    protected $primaryKey = 'sugar_id';

    protected $fillable = [
        'sugar_id',
        'sugar_option',
    ];
}
