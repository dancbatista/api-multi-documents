<?php

namespace App\Service\V1\Enterprise;

use Validator;
use App\Repository\V1\Enterprise\EnterpriseRepository;

class EnterpriseServiceUpdate {

    protected $enterpriseRepository;

    use Traits\RuleTrait;

    public function __construct(
        EnterpriseRepository $enterpriseRepository
    )
    {
        $this->enterpriseRepository = $enterpriseRepository;
    }

    public function enterpriseUpdate($id, $request)
    {
        $attributes = $request->all();

        $validator = Validator::make($request->all(), $this->rules($id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $this->enterpriseRepository->update($id, $attributes);
    }

}