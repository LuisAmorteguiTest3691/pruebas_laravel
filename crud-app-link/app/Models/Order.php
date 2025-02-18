<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Los atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'customer_name',
        'total_amount',
        'status',
    ];
}
