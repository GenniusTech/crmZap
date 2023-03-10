<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Atendente extends Authenticatable
{
    protected $table = 'crm_atendente';

    public function getAuthPassword()
    {
        return $this->senha;
    }

    protected $fillable = [
        'nome',
        'email',
        'tell',
        'dep',
        'tipo',
        'status',
        'user_id',
        'ref_id'

    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        //return $this->hasOne(User::class); 
       return $this->belongsTo(User::class);
    }

    public function contatos ()
    {
        return $this->hasMany(Contato::class);
    }

    public function leads()
    {
       // return $this->hasMany(Lead::class);
        return $this->hasMany(Lead::class, 'atendente_id', 'user_id');
    }
    public function dep()
    {
        return $this->hasMany(Lead::class);
    }
}
