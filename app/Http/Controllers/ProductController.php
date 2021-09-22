<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use DB;


class ProductController extends Controller
{
    public $productRepo;
    public $typeRepo;

    public function __construct(ProductRepositoryInterface $productRepo, TypeRepositoryInterface $typeRepo)
    {
        $this->productRepo = $productRepo;
        $this->typeRepo = $typeRepo;
    }

    public function index(Request $request)
    {
        //$types = $this->typeRepo->getAll();
        $products = $this->productRepo->getAll();
        return view('products.list', compact('products'));
    }

    public function create()
    {
        $types = $this->typeRepo->getAll();
        return view('products.add', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $product = $this->productRepo->store($data);
        
        for ($i=0; $i < count($data['attribute_product_id']); $i++) {
                $attribute[$i]['attribute_id'] = $data['attribute_product_id'][$i];
                $attribute[$i]['value'] = $data['value'][$i];
            }
        $product->attributes()->attach($attribute);
        for ($i=0; $i < count($data['path']); $i++) {
                $data_image[$i]['path']=$data['path'][$i];
                $data_image[$i]['product_id']=$product->id;
            }
        DB::table('media')->insertOrIgnore($data_image);
        Storage::move('public/tmp/' . $data['path'][0], 'public/images/' . $data['path'][0]);
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $types = $this->typeRepo->getAll();
        return view('products.edit')->with(['product'=>$this->productRepo->edit($id), 'types'=>$types]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = $this->productRepo->update($data, $id);
        for ($i=0; $i < count($data['attribute_product_id']); $i++) {
                $attribute[$i]['attribute_id'] = $data['attribute_product_id'][$i];
                $attribute[$i]['value'] = $data['value'][$i];
            }
        $product->attributes()->sync($attribute);
        for ($i=0; $i < count($data['path']); $i++) {
                $data_image[$i]['path']=$data['path'][$i];
            }
        DB::table('media')->where('product_id',$product->id )->update(['path' => $data_image[0]['path']]);
        Storage::move('public/tmp/' . $data['path'][0], 'public/images/' . $data['path'][0]);
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->productRepo->destroy($id);
        return redirect()->route('products.index');
    }

    public function confirm(ProductRequest $request)
    {
        $product = $request->all();
        $type = $this->typeRepo->edit($product['type']);
        if ($request['file']) {
            $file = $request['file'];
            $extension = $file->getClientOriginalExtension();
            $filename = rand() . '.' . $extension;
            Storage::disk('public')->put($filename, file_get_contents($file));
            $product['url'] = $filename;
        }
         return view('products.confirm',compact('product', 'type'));
    }

    public function getAttribute($id)
    {
        $data = $this->typeRepo->edit($id);
        $data=$data->attributes->all();
        return ($data);
    }
}
