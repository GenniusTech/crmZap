<?php

namespace App\Services;
use App\Models\Contato;

class ContatoService
{
    private $contactModel;

    public function __construct(Contato $contactModel)
    {
        $this->contactModel = $contactModel;
    }

    public function getAll() 
    {
        $contatos = $this->contactModel->all();
        return $contatos;
    }

    public function getByAtendenteId($id)
    {
        $contato = $this->contactModel->where('atendente_id', $id)->first();
        return $contato;
    }
}
