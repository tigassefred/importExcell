<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;
    protected $fillable = [
        'CONSIGNEE',
        'ISPAYE',
        'PAYEMENT',
        'COST_NUMBER',
        'CONTAINER_NUMBER',
        'BL',
        'DESTINATION',
        'TELEX_DOC',
        'LOADING_TIME',
        'ARRIVAL_TIME',
        'AGENT_PRICE',
        'COST_PRICE',
        'TYPE',
        'SHIPPING_LINE',
        'SHIPPING_AGENT',
        'REMARK',
        'GRD_BALLES',
        'HAND_BALLES',
        'PTES_BALLES',
        'CBM',
    ];
}
