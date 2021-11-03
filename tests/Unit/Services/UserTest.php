<?php

namespace Tests\Unit\Services;

use App\Service\V1\User\UserServiceRegistration;

use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Repository\V1\Document\UserDocumentRepository;
use App\Repository\V1\Enterprise\EnterpriseRepository;
use App\Repository\V1\Document\DocumentTypeRepository;


use App\Models\User;
use App\Models\UserType;
use App\Models\UserDoc;
use App\Models\Enterprise;
use App\Models\DocumentType;
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
        'user_type_id' => 1,
        'document' => (string) rand(174829237, 95474583292842),
        'user_enterprise_id' => 1,
        'name' => 'Daniel Batista',
        'email' => 'dancbatista@gmail.com',
        'password' => bcrypt(123456),   
        'document_type_id' => 2,
        'is_active' => 1,
        ];
        

        $userRepository = new UserRepository(new User());
        $userTypeRepository = new UserTypeRepository(new UserType());
        $userDocumentRepository = new UserDocumentRepository(new UserDoc());
        $enterpriseRepository = new EnterpriseRepository(new Enterprise());
        $documentTypeRepository = new DocumentTypeRepository(new DocumentType());
       $userRepository = new UserServiceRegistration(
               $userRepository, $userTypeRepository, $userDocumentRepository, $enterpriseRepository, $documentTypeRepository 
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
