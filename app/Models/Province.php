<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

   	protected $table = 'province';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		'id_province', 'name'
    ];
}
