<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\components\Recusive;
use App\Traits\DeleteItemModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use DeleteItemModelTrait;
    private $category;

    function __construct(Category $category)
    {
        $this->category = $category;
    }

    function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->recursive($parentId);
        return $htmlOption;
    }

    function index()
    {
        $categories = $this->category->latest()->simplePaginate(5);
        return view("admin.category.index", compact('categories'));
    }

    function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view("admin.category.create", compact('htmlOption'));
    }

    function createSubmit(Request $request)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate([
            'name' => ['required'],
            'parent_id' => ['required'],
            'slug' => ['required']
        ]);
        // $data = [
        //     'name' => $request->name,
        //     'parent_id' => $request->parent_id,
        //     'slug' => Str::slug($request->name)
        // ];
        $this->category->create($data);
        return redirect()->route('categories.index');
    }

    function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    function update(Request $request, $id)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate([
            'name' => ['required'],
            'parent_id' => ['required'],
            'slug' => ['required']
        ]);
        $this->category->find($id)->update($data);
        return redirect()->route('categories.index');
    }

    function delete($id)
    {
        return $this->deleteItemTrait($id, $this->category);
    }
}
