<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table = 'cupons';  

    protected $fillable = [
        'codigo',
        'tipo_desconto', // 'fixo' ou 'percentual'
        'valor_desconto',
        'max_uso',
        'usos',
        'validade',
        'ativo',
    ];

    protected $casts = [
        'validade' => 'date',
        'ativo' => 'boolean',
    ];

    public $timestamps = true;

    public function usuarios()
{
    return $this->belongsToMany(User::class, 'cupom_usuario', 'cupom_id', 'usuario_id')
                ->withPivot('usos')
                ->withTimestamps();
}

    
}
