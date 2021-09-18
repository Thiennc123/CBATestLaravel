<?php
namespace App\Repositories\Type;

use App\Repositories\BaseRepository;
use App\Repositories\Type\TypeRepositoryInterface;

class TypeRepository extends BaseRepository implements TypeRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Type::class;
    }

    public function search(array $request = [], $limit = 10)
    {
        $datas = $this->model->paginate($limit);

        return $datas;
    }
}
