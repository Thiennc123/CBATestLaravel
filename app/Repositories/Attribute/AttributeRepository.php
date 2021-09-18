<?php
namespace App\Repositories\Attribute;

use App\Repositories\BaseRepository;
use App\Repositories\Attribute\AttributeRepositoryInterface;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Attribute::class;
    }

    public function search(array $request = [], $limit = 10)
    {
        $datas = $this->model->paginate($limit);

        return $datas;
    }
}

