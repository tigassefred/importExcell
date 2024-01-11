<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortDestination extends Model
{
    use HasFactory;
    protected $table = 'port_destinations';

    protected $guarded = ['*'];
}
