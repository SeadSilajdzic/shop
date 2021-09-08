<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with('user')->simplePaginate(9),
            'ordersCount' => Order::all()->where('order_status_id', 3)->count()
        ]);
    }


    public function create()
    {
        return view('editor.products.index');
    }
    
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if($data['slug']) {
            $slug = Str::slug($data['slug']);
        } else {
            $slug = Str::slug($data['title']);
        }

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/products', $featured_new_name);

        Product::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => $slug,
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'user_id' => auth()->user()->id,
            'featured' => '/uploads/products/' . $featured_new_name,
        ]);

        toast('Product created','success')->autoClose(1500);
        return redirect()->back();
    }
    
    public function edit()
    {
        return view('editor.products.index');
    }
    
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if($data['slug']) {
            $slug = Str::slug($data['slug']);
        } else {
            $slug = Str::slug($data['title']);
        }

        if($request->hasFile('featured')){
            $featured = $request->featured;
            $featured_new_name = time() . $featured->getClientOriginalName();
            $featured->move('uploads/products', $featured_new_name);
            $product->featured = '/uploads/products/' . $featured_new_name;
        }

        $product->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => $slug,
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'user_id' => auth()->user()->id,
        ]);

        toast('Product updated','info')->autoClose(1500);
        return redirect()->back();
    }
    
    public function destroy($slug)
    {
        $product = Product::onlyTrashed()->where('slug', $slug)->first();
        $product->forceDelete();
        toast('Product deleted','error')->autoClose(1500);
        return redirect()->back();
    }
    
    public function trashed() {
        return view('admin.products.trashed', [
            'products' => Product::onlyTrashed()->simplePaginate(15),
            'ordersCount' => Order::all()->where('order_status_id', 3)->count()
        ]);
    }
    
    public function trash(Product $product) {
        $product->delete();
        toast('Product trashed','warning')->autoClose(1500);
        return redirect()->back();
    }
    
    public function restore($slug) {
        $product = Product::onlyTrashed()->where('slug', $slug)->first();
        $product->restore();
        toast('Product restored','success')->autoClose(1500);
        return redirect()->back();
    }
}
