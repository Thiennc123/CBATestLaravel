<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    public $typeRepo;
    public $attributeRepo;

    public function __construct(TypeRepositoryInterface $typeRepo, AttributeRepositoryInterface $attributeRepo)
    {
        $this->typeRepo = $typeRepo;
        $this->attributeRepo = $attributeRepo;
    }

    public function index(Request $request)
    {
        $conditions[]   = $request->all();
        $types          = $this->typeRepo->search($conditions);
        return view('types.list',compact('types'));
    }

    public function create()
    {
        $attributes = $this->attributeRepo->getAll();
        return view('types.add', compact('attributes'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $type = $this->typeRepo->store($input);
        $type->attributes()->attach($request->attribute);
        return redirect()->route('types.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $attributes = $this->attributeRepo->getAll();
        return view('types.edit')->with(['type'=>$this->typeRepo->edit($id), 'attributes'=>$attributes]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $type = $this->typeRepo->update($input, $id);
        $type->attributes()->sync($request->attribute);
        return redirect()->route('types.index');
    }

    public function destroy($id)
    {
        $this->typeRepo->destroy($id);
        return redirect()->route('types.index');
    }

    public function confirm(TypeRequest $request)
    {
        $type = $request->all();
        foreach($type['attribute'] as $item){
            $type['attributes'][$item] = $this->attributeRepo->edit($item);
            
        }
        return view('types.confirm',compact('type'));
    }
}
