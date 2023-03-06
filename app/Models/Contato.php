<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $table = 'crm_contato';

    protected $fillable = [
        'id',
        'nome',
        'email',
        'tell',
        'empresa',
        'profissao',
        'instagram',
        'facebook',
        'id_atendente',
        'created_at'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
