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

    public function loadById($id, $view)
    {
        $product = Product::find($id);

        if (!$product)
            return redirect()->route('products')->with('error', 'Product not found!');

        return view($view, ['product' => $product]);
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
        
        return redirect()->route('products')->with('success', 'Successfully added product - '. $request->title .'!');
    }

    public function editProduct(Request $request, $id)
    {     
        $validated = request()->validate([
            'title' => 'required|min:4|max:255'
            , 'description' => 'required|min:4|max:255'
            , 'price' => 'required|gt:0' ]);

        $product = Product::find($id);
        if (!$product)
            return redirect()->route('products')->with('error', 'Product not found!');

        if ($request->hasFile('image')) {
            $validated['image'] = time() . '.' . $request->image->extension();
            $uploadPath = public_path('uploads');
            if (!file_exists($uploadPath))
                mkdir($uploadPath, 0755, true);
            
            $request->image->move($uploadPath, $validated['image']);

            if (!unlink(public_path('uploads/' . $product->image)))
                return redirect()->route('products')->with('error', 'Failed to remove old product image!');
        }

        $product->title = $validated['title'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        if (isset($validated['image']))
            $product->image = $validated['image'];

        if (!$product->save())
            return redirect()->route('products')->with('error', 'Failed to edit product!');

        return redirect()->route('products')->with('success', 'Successfully edited product - '. $request->title .'!');
    }



    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product)
            return redirect()->route('products')->with('error', 'Product not found!');

        if (!Product::destroy($request->id))
            return redirect()->route('products')->with('error', 'Failed to remove product!');

        if (!unlink(public_path('uploads/' . $product->image)))
            return redirect()->route('products')->with('error', 'Failed to remove product image!');
        
        return redirect()->route('products')->with('success', 'Successfully removed product!');
    }
}