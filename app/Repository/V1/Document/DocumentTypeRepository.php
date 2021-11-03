<?php

namespace App\Repository\V1\Document;

use App\Models\DocumentType;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class DocumentTypeRepository extends BaseRepository
{

    public function __construct(DocumentType $documentType)
    {
        parent::__construct($documentType);
    }

    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $documentType = $this->obj->create($attributes);
            DB::commit();
            return $documentType;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $documentType = $this->obj->find($id);
            if ($documentType) {
                $documentType = $documentType->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }
            DB::commit();
            return (object) $userDoc;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {

        return (object) $this->obj->where('id', $id)->first();
    }

    public function all($searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                            ->where('name', 'ilike', '%' . $searchQuery . '%')
                            ->get();
        }
        return $this->obj->all();
    }

}
