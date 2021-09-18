<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Http\Requests\AttributeRequest;

class AttributeController extends Controller
{
    public $attributeRepo;

    public function __construct(AttributeRepositoryInterface $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    public function index(Request $request)
    {
        $conditions[]        = $request->all();
        $attributes          = $this->attributeRepo->search($conditions);
        return view('attributes.list',compact('attributes'));
    }

    public function create()
    {
        return view('attributes.add');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->attributeRepo->store($input);
        return redirect()->route('attributes.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('attributes.edit')->with('attribute', $this->attributeRepo->edit($id));
    }

    
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->attributeRepo->update($input, $id);
        return redirect()->route('attributes.index');
    }

    
    public function destroy($id)
    {
        $this->attributeRepo->destroy($id);
        return redirect()->route('attributes.index');
    }

    public function confirm(AttributeRequest $request)
    {
        return view('attributes.confirm',compact('request'));
    }
}
