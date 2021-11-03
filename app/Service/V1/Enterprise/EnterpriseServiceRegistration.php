<?php

namespace App\Service\V1\Enterprise;

use Validator;
use App\Repository\V1\Enterprise\EnterpriseRepository;

class EnterpriseServiceRegistration {

    protected $enterpriseRepository;

    use Traits\RuleTrait;

    public function __construct(
        EnterpriseRepository $enterpriseRepository
    )
    {
        $this->enterpriseRepository = $enterpriseRepository;
    }

    public function store($request) {
        $attributes = $request->all();

        $validator = Validator::make($attributes, $this->rules());

         if ($validator->fails()) {
             return $validator->errors();
         }

         return $this->enterpriseRepository->save($attributes);
    }
}
