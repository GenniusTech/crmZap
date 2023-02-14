<?php

namespace App\Services;

use App\Models\Atendente;

class AtendenteService
{
    private $atendenteModel;

    public function __construct(Atendente $atendente)
    {
        $this->atendenteModel = $atendente;
    }

    public function getAtendenteByUserId($id) {
       $atendente = $this->atendenteModel->where('user_id', $id)->first();
       return $atendente;
    }

    public function getAll() {
        $atendentes = $this->atendenteModel->all();
        return $atendentes;
    }
}
