<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankType extends Model
{
    use HasFactory;

    protected $table = 'BankingType';

    protected $primaryKey = 'banking_id';

    protected $fillable = [
        'banking_id',
        'name',
        'account_number',
        'restaurant_id',
        'status',
        'banking_name',
        'banking_setDefault',
        'banking_code',
        'banking_bin',
    ];
}
