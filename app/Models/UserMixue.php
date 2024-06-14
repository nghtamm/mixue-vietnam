<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserMixue extends Authenticatable
{
    use Notifiable;

    protected $table = 'User';

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_gender',
        'user_email',
        'verified',
        'user_password',
        'user_address',
        'role_id',
        'role_status',
    ];

    protected $hidden = [
        'user_password',
    ];

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
