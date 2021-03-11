<?php

namespace Tests\Unit\Services;

use App\Service\V1\User\UserServiceRegistration;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Models\User;
use App\Models\UserType;
use Tests\TestCase;
class UserTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \App\Service\V1\User\Traits\RuleTrait;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $attributes = [
            "name" => "Carlos",
            "email" => "carlos@gmail.com",
            "password" => "12345",
            "cpf_cnpj" => '22895159068',
            "user_type_id" => 2,
            "is_active" => 1,
        ];
        

       $UserRepository = new UserRepository(new User());
       $userTypeRepository = new UserTypeRepository(new UserType());
       $userRepository = new UserServiceRegistration(
               $UserRepository, $userTypeRepository
       );
       $user = $userRepository->store($attributes);        
        if (is_object($user)) {            
            $expceted = User::find($user->id);            
            $this->assertEquals($expceted->id, $user->id);            
        } else {
            dd($user);
        }
    }
    
    

}
