<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index() 
    {
        return view('admin.products.index');
    }

    public function create() 
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(ProductFormRequest $request) 
    {
        $validateData = $request->validated();

        $category = Category::findOrFail($validateData['category_id']);
        $product = $category->product()->create([
            'category_id' => $validateData['category_id'],
            'name' => $validateData['name'],
            'slug' => Str::slug($validateData['slug']),
            'brand' => $validateData['brand'],
            'small_description'  => $validateData['brand'],
            'description'  => $validateData['description'],	
            'original_price'  => $validateData['original_price'],	
            'selling_price'  => $validateData['selling_price'],	
            'quantity'  => $validateData['quantity'],
            'trendding'  => $request->trendding == true ? '1':'0',
            'status'  => $request->status == true ? '1':'0',
            'meta_title'  => $validateData['meta_title'],	
            'meta_keyword'  => $validateData['meta_keyword'],	
            'meta_description'  => $validateData['meta_description'],
        ]);
        return $product->id;
    }
}
