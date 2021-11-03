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
        
        if (auth('api')->user()->user_enterprise_id == 2) {
            if (auth('api')->user()->user_enterprise_id != $id) {
                return 'Os gerentes tem acesso apenas as informações de sua própria empresa';
            }
        }
         return $this->enterpriseRepository->show($id);
    }
}
