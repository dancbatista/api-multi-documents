<?php

namespace App\Service\V1\User;

use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Repository\V1\Document\UserDocumentRepository;
use App\Repository\V1\Enterprise\EnterpriseRepository;
use App\Repository\V1\Document\DocumentTypeRepository;
use Illuminate\Http\Request;

use function bcrypt;
use Validator;

class UserServiceUpdate
{

    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $userRepositor;
    protected $userTypeRepository;
    protected $userDocumentRepository;
    protected $enterpriseRepository;
    protected $documentTypeRepository;

    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository,
        UserDocumentRepository $userDocumentRepository,
        EnterpriseRepository $enterpriseRepository,
        DocumentTypeRepository $documentTypeRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->userDocumentRepository = $userDocumentRepository;
        $this->enterpriseRepository = $enterpriseRepository;
        $this->documentTypeRepository = $documentTypeRepository;
    }

    public function update($id, Request $request)
    {
        $attributes = $request->all();
         $validator = Validator::make($attributes, $this->rules($id));

         if ($validator->fails()) {
             return $validator->errors();
         }

        if (!get_object_vars(($this->userTypeRepository->show($attributes['user_type_id'])))) {
            return "user_type_id invalid";
        }
        if (!get_object_vars(($this->enterpriseRepository->show($attributes['user_enterprise_id'])))) {
            return "user_enterprise_id invalid";
        }
         if (!get_object_vars(($this->documentTypeRepository->show($attributes['document_type_id'])))) {
            return "document_type_id invalid";
        }
        $user = $this->userRepository->show($id);
        $validator = Validator::make($attributes, $this->ruleDocument($user->user_doc_id));

         if ($validator->fails()) {
             return $validator->errors();
         }
        $attributes['password'] = bcrypt($attributes['password']);

        $userDoc = $this->userDocumentRepository->update($user->user_doc_id, $attributes);
        $attributes['user_doc_id'] = $userDoc->id;
        $user = $this->userRepository->update($id, $attributes);
        return $user?$user:'unidentified user';
    }

}
