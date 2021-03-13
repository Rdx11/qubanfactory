<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'detail_transaction';

    protected $primaryKey = 'id';

    protected $fillable = [
		'id_transaction', 'id_user', 'amount', 'reference_code', 'status'
    ];

    public function getUser()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user');
    }
}
