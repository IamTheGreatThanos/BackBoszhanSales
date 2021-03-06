<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\PriceType;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductPriceType;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::with('category')->get();
        return view('admin.product.index',compact('products'));
    }
    function create()
    {
        $categories = Category::orderBy('brand_id')->where('enabled',1)->with('brand')->get();
        $priceTypes = PriceType::all();
        return view('admin.product.create',compact('categories','priceTypes'));
    }
    function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }
    function store(ProductStoreRequest $request)
    {
        $product = new Product();
        $product->category_id = $request->get('category_id');
        $product->name = $request->get('name');
        $product->article = $request->get('article');
        $product->id_1c = $request->get('id_1c');
        $product->measure = $request->get('measure');
        $product->barcode = $request->get('barcode');
        $product->remainder = $request->get('remainder');
        $product->hit = $request->has('hit');
        $product->new = $request->has('new');
        $product->action = $request->has('action');
        $product->discount_5 = $request->has('discount_5');
        $product->discount_10 = $request->has('discount_10');
        $product->discount_15 = $request->has('discount_15');
        $product->discount_20 = $request->has('discount_20');

        $product->save();

        foreach ($request->get('price_types') as $item) {
            ProductPriceType::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'price_type_id' => $item['price_type_id']
                ],
                [
                    'product_id' => $product->id,
                    'price_type_id' => $item['price_type_id'],
                    'price' => $item['price']
                ]
            );
        }
        if ($request->file('images')){
            foreach ($request->file('images') as $image) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->name = $image->getClientOriginalName();
                $productImage->path =  Storage::disk('public')->put("images",$image);
                $productImage->save();
            }
        }




        return redirect()->route('admin.product.index');

    }
    function edit(Product $product)
    {
        $priceTypes = PriceType::all();
        $categories = Category::orderBy('brand_id')->where('enabled',1)->with('brand')->get();
        return view('admin.product.edit',compact('product','priceTypes','categories'));
    }
    function update(Request $request,Product $product)
    {
        $product->name = $request->get('name');
        $product->article = $request->get('article');
        $product->id_1c = $request->get('id_1c');
        $product->measure = $request->get('measure');
        $product->barcode = $request->get('barcode');
        $product->remainder = $request->get('remainder');
        $product->discount = $request->get('discount');
        $product->hit = $request->has('hit');
        $product->new = $request->has('new');
        $product->action = $request->has('action');
        $product->discount_5 = $request->has('discount_5');
        $product->discount_10 = $request->has('discount_10');
        $product->discount_15 = $request->has('discount_15');
        $product->discount_20 = $request->has('discount_20');
        $product->save();


        foreach ($request->get('price_types') as $item) {
            ProductPriceType::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'price_type_id' => $item['price_type_id']
                ],
                [
                    'product_id' => $product->id,
                    'price_type_id' => $item['price_type_id'],
                    'price' => $item['price']
                ]
            );
        }
        if ($request->file('images')){

            foreach ($request->file('images') as $image) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->name = $image->getClientOriginalName();
                $productImage->path =  Storage::disk('public')->put("images",$image);
                $productImage->save();
            }
        }



        return redirect()->route('admin.product.index');

    }
    function delete(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $product->delete();

        return redirect()->back();
    }
    function deleteImage(ProductImage $productImage)
    {

        Storage::disk('public')->delete($productImage->getRawOriginal('path'));

        $productImage->delete();

        return redirect()->back();
    }
}
