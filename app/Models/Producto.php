<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria_id',
        'marca_id',
        'descripcion',
        'costo',
        'precio_venta',
        'stock',
        'stock_minimo',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'costo' => 'decimal:2',
            'precio_venta' => 'decimal:2',
            'stock' => 'integer',
            'stock_minimo' => 'integer',
            'activo' => 'boolean',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }
}