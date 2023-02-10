<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Atendente extends Model
{
    use HasApiTokens, HasFactory, Notifiable;use HasFactory;
    protected $table = 'crm_atendente';

    public function retrieveByCredentials(array $credentials)
    {
        $atendente = Atendente::where('email', $credentials['email'])->first();

        if ($atendente && Hash::check($credentials['password'], $atendente->password)) {
            return $atendente;
        }

        return null;
    }

    protected $fillable = [
        'nome',
        'email',
        'tell',
        'senha',
        'dep',
        'tipo',
        'status'

    ];
    protected $hidden = [
        'senha',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}