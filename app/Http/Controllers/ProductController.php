<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductImport;
use DB;
use Excel;




class ProductController extends Controller
{
    public $attributeRepo;
    public $productRepo;
    public $typeRepo;

    public function __construct(AttributeRepositoryInterface $attributeRepo, ProductRepositoryInterface $productRepo, TypeRepositoryInterface $typeRepo)
    {
        $this->productRepo = $productRepo;
        $this->typeRepo = $typeRepo;
        $this->attributeRepo = $attributeRepo;
    }

    public function index(Request $request)
    {
        $conditions   = $request->all();
        $products = $this->productRepo->search($conditions);
        $types = $this->typeRepo->getAll();
        $attributes = $this->attributeRepo->getAll();
        return view('products.list', compact('products', 'types', 'attributes'));
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
        $data['path'] = array('file' => json_decode($request->path[0]));
        for ($i=0; $i < count($data['path']['file']); $i++) {
            $data_image[$i]['path']=$data['path']['file'][$i];
            $data_image[$i]['product_id']=$product->id;
            Storage::move('public/tmp/' . $data['path']['file'][$i], 'public/images/' . $data['path']['file'][$i]);
        }
        DB::table('media')->insertOrIgnore($data_image);
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
        $data['path'] = array('file' => json_decode($request->path[0]));
        DB::table('media')->where('product_id',$product->id )->delete();
        for ($i=0; $i < count($data['path']['file']); $i++) {
                $data_image[$i]['path']=$data['path']['file'][$i];
                $data_image[$i]['product_id']=$product->id;
                Storage::move('public/tmp/' . $data['path']['file'][$i], 'public/images/' . $data['path']['file'][$i]);
            }

        DB::table('media')->insertOrIgnore($data_image);
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
        foreach($request['file'] as $file)
        {
            if ($file) {
                $file = $file;
                $extension = $file->getClientOriginalExtension();
                $filename = rand() . '.' . $extension;
                Storage::disk('public')->put($filename, file_get_contents($file));
                $product['url'][] = $filename;
            }
        }
        return view('products.confirm',compact('product', 'type'));
    }

    public function getAttribute($id)
    {
        $data = $this->typeRepo->edit($id);
        $data=$data->attributes->all();
        return ($data);
    }

    public function exportCsv(Request $request)
    {
        $fileName       = 'product.csv';
        $conditions     = $request->all();
        $products       = $this->productRepo->search($conditions);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns    = array('Id', 'Name', 'Price', 'Amount', 'Type');
        $callback   = function() use($products, $columns) {
            $file   = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $product) {
                $row['Id']          = $product->id;
                $row['Name']        = $product->name;
                $row['Price']       = $product->price;
                $row['Amount']      = $product->amount;
                $row['Type']        = $product->type->name;

                fputcsv($file, array($row['Id'], $row['Name'], $row['Price'], $row['Amount'], $row['Type']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importForm()
    {
        return view('products.import_form');
    }

    public function importCsv(Request $request)
    {
        Excel::import(new ProductImport, $request->file);
    }

    public function updateStt(Request $request)
    {
        $data = $request->all();
        $data['stt'] = (int)$data['stt'];
        $product = $this->productRepo->update($data,$data['oldId']);
        return redirect()->route('products.index');
    }
}