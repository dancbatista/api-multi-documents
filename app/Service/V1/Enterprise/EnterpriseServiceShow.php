<?php

namespace App\Service\V1\Enterprise;

use Validator;
use App\Repository\V1\Enterprise\EnterpriseRepository;

class EnterpriseServiceShow{

    protected $enterpriseRepository;

    public function __construct(
        EnterpriseRepository $enterpriseRepository
    )
    {
        $this->enterpriseRepository = $enterpriseRepository;
    }

    public function enterpriseShow(int $id) {

         return $this->enterpriseRepository->show($id);
    }
}
