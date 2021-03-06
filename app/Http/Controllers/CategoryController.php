<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\components\Recusive;
use App\Models\Product;
use App\Traits\DeleteItemModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use DeleteItemModelTrait;
    private $category;
    private $product;

    function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->recursive($parentId);
        return $htmlOption;
    }

    function index(Request $request)
    {
        $categories = $this->category->latest()->simplePaginate(10);
        if ($request->name) $categories = $this->category->where('name', 'like', '%' . $request->name . '%')->latest()->simplePaginate(10);
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

    //client
    public function showProductByCategory($slug, $cate_id)
    {
        $categories = $this->category->where('parent_id', 0)->get();
        $products = $this->product->where('category_id', $cate_id)->simplePaginate(12);
        return view('client.product.category.list', compact('categories', 'products'));
    }
}
