<?php
namespace App\Repositories\Type;

use App\Repositories\BaseRepository;
use App\Repositories\Type\TypeRepositoryInterface;

class TypeRepository extends BaseRepository implements TypeRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getProduct()
    {
        return $this->model->select('product_name')->take(5)->get();
    }
}
