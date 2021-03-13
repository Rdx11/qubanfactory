<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

	protected $table = 'product';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		'id_user_address', 'id_user', 'id_city', 'title', 'street', 'postCode', 
    ];
    
    public function getUser()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user');
    }
}
