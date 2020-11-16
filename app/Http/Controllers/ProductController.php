<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Traits\StorageImageTrait;
use App\components\Recusive;
use App\Http\Requests\ProductRequest;
use App\Traits\DeleteItemModelTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use StorageImageTrait;
    use DeleteItemModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;

    function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
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
        $products = $this->product->latest()->simplePaginate(10);
        return view('admin.product.index', compact('products'));
    }

    function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.product.create', compact('htmlOption'));
    }

    function createSubmit(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            //insert data to product table
            $dataProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadImage = $this->storageTraitUploadFile($request, 'feature_image_path', 'product');
            if (!empty($dataUploadImage)) {
                $dataProduct['feature_image_path'] = $dataUploadImage['file_path'];
            }
            $product = $this->product->create($dataProduct);
            //insert data to product image table
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadFileMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path']
                    ]);
                }
            }
            //insert data tags for product table
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance =  $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->attach($tagIds);
            }
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('product', 'htmlOption'));
    }

    function update(ProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            //update data to product table
            $dataProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadImage = $this->storageTraitUploadFile($request, 'feature_image_path', 'product');
            if (!empty($dataUploadImage)) {
                $dataProduct['feature_image_path'] = $dataUploadImage['file_path'];
            }
            $this->product->find($id)->update($dataProduct); //update trả về true/false
            $product = $this->product->find($id);
            //update data to product image table
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete(); //xóa image cũ để cập nhật image ms vào
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadFileMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path']
                    ]);
                }
            }
            //update data tags for product table
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance =  $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->sync($tagIds); //sync : thêm những tag chưa có vào, có rồi ko thêm
            }
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function delete($id)
    {
        return $this->deleteItemTrait($id, $this->product);
    }
}
