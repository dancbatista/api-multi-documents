<?php

namespace App\Repository\V1\Document;

use App\Models\UserDoc;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserDocumentRepository extends BaseRepository
{

    public function __construct(UserDoc $userDoc)
    {
        parent::__construct($userDoc);
    }

    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $userDoc = $this->obj->create($attributes);
            DB::commit();
            return $userDoc;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $userDoc = $this->obj->find($id);
            if ($userDoc) {
                $userDoc = $userDoc->updateOrCreate([
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
