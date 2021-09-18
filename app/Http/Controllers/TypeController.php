<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    public $typeRepo;

    public function __construct(TypeRepositoryInterface $typeRepo)
    {
        $this->typeRepo = $typeRepo;
    }

    public function index(Request $request)
    {
        $conditions[]   = $request->all();
        $types          = $this->typeRepo->search($conditions);
        return view('types.list',compact('types'));
    }

    public function create()
    {
        return view('types.add');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->typeRepo->store($input);
        return redirect()->route('types.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('types.edit')->with('type', $this->typeRepo->edit($id));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->typeRepo->update($input, $id);
        return redirect()->route('types.index');
    }

    public function destroy($id)
    {
        $this->typeRepo->destroy($id);
        return redirect()->route('types.index');
    }

    public function confirm(TypeRequest $request)
    {
        return view('types.confirm',compact('request'));
    }
}
