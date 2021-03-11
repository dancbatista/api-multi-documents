<?php

namespace App\Service\V1\User;

use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use function bcrypt;
use Validator;

class UserServiceRegistration
{

    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $userRepositor;
    protected $userTypeRepository;

    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
    }

    public function store($request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $attributes['cpf_cnpj'] = preg_replace('/[^0-9]/', '', (string) $attributes['cpf_cnpj']);

        if (!$this->cnpjCpf($attributes['cpf_cnpj'])) {
            return "cpf_cnpj invalid";
        }

         $validator = Validator::make($attributes, $this->rules());

         if ($validator->fails()) {
             return $validator->errors();
         }

        if (!get_object_vars(($this->userTypeRepository->show($attributes['user_type_id'])))) {
            return "user_type_id invalid";
        }

        $attributes['password'] = bcrypt($attributes['password']);
        $user = $this->userRepository->save($attributes);
        return $user?$user:'unidentified user';
    }

}
