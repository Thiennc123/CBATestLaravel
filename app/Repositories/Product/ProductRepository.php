<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function search(array $request = [], $limit = 10)
    {
        $datas = $this->model->paginate($limit);

        return $datas;
    }
}
