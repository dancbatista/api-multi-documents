<?php

namespace App\Repository\V1\Enterprise;

use App\Models\Enterprise;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class EnterpriseRepository extends BaseRepository
{

    public function __construct(Enterprise $enterprise)
    {
        parent::__construct($enterprise);
    }

    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $enterprise = $this->obj->create($attributes);
            DB::commit();
            return $enterprise;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $enterprise = $this->obj->find($id);
            if ($enterprise) {
                $enterprise = $enterprise->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }
            DB::commit();
            return (object) $enterprise;
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
