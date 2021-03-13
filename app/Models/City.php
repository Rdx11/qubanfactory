<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'city';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
       'id_city', 'id_province', 'name'
    ];

    public function getProvine()
    {
        return $this->hasOne('App\Models\Province', 'id_province', 'id_province');
    }
}
