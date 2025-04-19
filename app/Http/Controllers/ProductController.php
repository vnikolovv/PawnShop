<?php

namespace App\Http\Controllers;

use App\Models\AdditionalProductImage;
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

        $additionalImages = AdditionalProductImage::where('product_id', $id)->get();

        return view($view, ['product' => $product, 'additionalImages' => $additionalImages]);
    }

    public function addProduct(Request $request)
    {
        $validated = request()->validate([
            'title' => 'required|min:4|max:255'
            ,
            'description' => 'required|min:4|max:255'
            ,
            'image' => 'required|image|mimes:jpeg,png,jpg,webp'
            ,
            'price' => 'required|gt:0'
        ]);

        $uploadPath = public_path('uploads');
        if (!file_exists($uploadPath))
            mkdir($uploadPath, 0755, true);

        $image = time() . '_' . uniqid() . '.' . $request->image->extension();

        $request->image->move($uploadPath, $image);

        $validated['image'] = $image;

        $product = Product::create($validated);

        return redirect()->route('products')->with('success', 'Successfully added product - ' . $request->title . '!');
    }

    public function editProduct(Request $request, $id)
    {
        $validated = request()->validate([
            'title' => 'required|min:4|max:255'
            ,
            'description' => 'required|min:4|max:255'
            ,
            'price' => 'required|gt:0'
        ]);

        $product = Product::find($id);
        if (!$product)
            return redirect()->route('products')->with('error', 'Product not found!');

        if ($request->hasFile('image')) {
            $validated['image'] = time() . '_' . uniqid() . '.' . $request->image->extension();
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

        return redirect()->route('products')->with('success', 'Successfully edited product - ' . $request->title . '!');
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product)
            return redirect()->route('products')->with('error', 'Product not found!');

        $additionalImages = AdditionalProductImage::where('product_id', $request->id)->get();

        if (!Product::destroy($request->id))
            return redirect()->route('products')->with('error', 'Failed to remove product!');

        foreach ($additionalImages as $image) {
            if (!unlink(public_path('uploads/' . $image->image)))
                return redirect()->route('products')->with('error', 'Failed to remove additional product image!');
        }

        if (!unlink(public_path('uploads/' . $product->image)))
            return redirect()->route('products')->with('error', 'Failed to remove product image!');

        return redirect()->route('products')->with('success', 'Successfully removed product!');
    }

    public function deleteAdditionalImage(Request $request)
    {
        $image = AdditionalProductImage::find($request->id);

        if (!$image)
            return back()->with('error', 'Error finding image!');

        if (!unlink(public_path('uploads/' . $image->image)))
            return redirect()->route('products')->with('error', 'Failed to remove product image!');

        if (!AdditionalProductImage::destroy($request->id))
            return redirect()->route('products')->with('error', 'Failed to remove product image!');

        return back()->with('success', 'Successfully removed photo!');
    }

    public function addAdditionalImages(Request $request)
    {
        request()->validate([
            'additionalImages' => 'required|array|min:1|max:5',
            'additionalImages.*' => 'required|image|mimes:jpeg,png,jpg,webp'
        ]);

        foreach ($request->additionalImages as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $uploadPath = public_path('uploads');

            if (!file_exists($uploadPath))
                mkdir($uploadPath, 0755, true);

            $image->move($uploadPath, $imageName);

            AdditionalProductImage::create([
                'product_id' => $request->productId,
                'image' => $imageName
            ]);
        }

        return back()->with('success', 'Successfully added additional images!');
    }
}