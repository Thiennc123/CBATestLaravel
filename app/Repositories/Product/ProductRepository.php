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
        $datas = $this->model->when(!empty($request['name']), function($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request['name']}%");
        });

        $datas = $datas->when(!empty($request['supplier']), function($query) use ($request) {
            $query->where('supplier', 'LIKE', "%{$request['supplier']}%");
        });

        $datas = $datas->when(!empty($request['price']), function($query) use ($request) {
            $query->where('price', $request['price']);
        });

        $datas = $datas->when(!empty($request['type']), function ($query) use ($request) {
            $query->whereHas('type', function ($query2) use ($request) {
               $query2->where('name', 'like', "%{$request['type']}%");
            });
        });

        $datas = $datas->when(!empty($request['attribute']), function ($query) use ($request) {
            $query->whereHas('attributes', function ($query2) use ($request) {
               $query2->where('name', 'like', "%{$request['attribute']}%");
            });
        });

        $datas = $datas->orderBy('stt', 'asc');

        $datas = $datas->paginate($limit);
        return $datas;
    }
}
