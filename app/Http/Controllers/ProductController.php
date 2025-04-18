<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function loadAll(Request $request)
    {        
        $products = Product::all();
        return view('products', ['products' => $products]);
    }

    public function addProduct(Request $request)
    {     
        $validated = request()->validate([
            'title' => 'required|min:4|max:255'
            , 'description' => 'required|min:4|max:255'
            , 'image' => 'required|image|mimes:jpeg,png,jpg,webp'
            , 'price' => 'required|gt:0' ]);

        $uploadPath = public_path('uploads');
        if (!file_exists($uploadPath))
            mkdir($uploadPath, 0755, true);
        
        $image = time() . '.' . $request->image->extension();

        $request->image->move($uploadPath, $image);

        $validated['image'] = $image;

        $product = Product::create($validated);
        
        return redirect()->route('products')->with('success', 'Successfully added product - '. $request['title'] .'!');
    }

    public function deleteProduct(Request $request)
    {
        Product::destroy($request->id);
        
        return redirect()->route('products')->with('success', 'Successfully removed product!');
    }
}