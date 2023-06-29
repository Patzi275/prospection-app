<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospection extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_name',
        'client_name',
        'address',
        'date',
        'start_time',
        'end_time',
        'duration',
        'product',
        'observation',
        'is_sold'
    ];
}
