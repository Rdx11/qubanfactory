<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use HasFactory;

    protected $table = 'verify_users';

    protected $primaryKey = 'id';

    protected $fillable = [
		'id_user', 'token', 'expired', 
    ];

    public function getUser()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user');
    }
}
