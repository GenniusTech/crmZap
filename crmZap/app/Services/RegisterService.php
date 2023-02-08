<?php 

namespace App\Services;

use App\Models\Atendente;

class RegisterService
{   
    private $atendenteModel;

    public function __construct(Atendente $atendente)
    {
        $this->atendenteModel = $atendente;
    }

    public function store($data) 
    {   
        if ($data->email) {

        }

        $create = $this->atendenteModel->create($data);

        return $create;
    }

}
