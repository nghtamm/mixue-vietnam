<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'Staff';

    protected $primaryKey = 'telegram_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'telegram_id',
        'name',
        'phone',
        'restaurant_id',
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
