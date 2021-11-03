<?php

namespace App\Service\V1\Enterprise;

use Validator;
use App\Repository\V1\Enterprise\EnterpriseRepository;

class EnterpriseServiceShowAll {

    protected $enterpriseRepository;

    public function __construct(
        EnterpriseRepository $enterpriseRepository
    )
    {
        $this->enterpriseRepository = $enterpriseRepository;
    }

    public function enterpriseShowAll() {

         return $this->enterpriseRepository->all();
    }
}
