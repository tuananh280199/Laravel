<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $slider;
    private $category;
    private $product;

    function __construct(Slider $slider, Category $category, Product $product)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
    }

    function index()
    {
        $sliders = $this->slider->latest()->get();
        $categories = $this->category->where('parent_id', 0)->get();
        $products = $this->product->latest()->take(8)->get();
        return view("client.home", compact('sliders', 'categories', 'products'));
    }
}
