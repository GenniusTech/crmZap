<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Contato;

class LeadsService
{
    private $leadModel;
    private $contactModel;

    public function __construct(Lead $lead, Contato $contactModel)
    {
        $this->leadModel = $lead;
        $this->contactModel = $contactModel;
    }

    public function getLeadByStatusAndAtendenteId($status = 0, $atendente_id = null) {
        $lead = $this->leadModel->where('atendente_id', '=', $atendente_id)->where('status', $status);
        return $lead;
    }

    public function getLeadsByStatus($status) {
        $leads = $this->leadModel->where('status', '=', $status);
        return $leads;
    }
}
