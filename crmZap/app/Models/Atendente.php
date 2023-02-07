<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendente extends Model
{
    use HasFactory;
    protected $table = 'atendente';

    protected $fillable = [
        'nome',
        'email',
        'tell',
        'senha'

    ];
}
