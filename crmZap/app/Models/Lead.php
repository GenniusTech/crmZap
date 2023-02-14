<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model 
{
    use HasFactory;

    protected $table = 'crm_leads';

    protected $fillable = [
        'id',
        'nome',
        'email',
        'tell',
        'chat',
        'atendent_id',
        'created_at'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

