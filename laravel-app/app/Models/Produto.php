<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';  

    protected $primaryKey = 'id_product';  

    public $timestamps = false; 

    protected $fillable = [
        'product_name',
        'ean',
        'preco',
        'custo',
    ];
}
