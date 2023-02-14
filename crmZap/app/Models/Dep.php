<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dep extends Model
{
    use HasFactory;

    protected $table = 'crm_dep';

    protected $fillable = [
        'id',
        'nome',
        'segmento',
        'resp',
        'status',
        'created_at'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
