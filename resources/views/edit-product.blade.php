@extends('layouts.main')

@section('maincontent')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="border rounded p-4" method="POST" action="{{ route('product.edit-product', ['id' => $product->id]) }}"
                enctype="multipart/form-data">
                @csrf
                    <h3 class="text-center text-golden">Edit product</h3>
                    <div class="mb-3">
                        <label for="title" class="form-label text-golden">Name:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label text-golden">Price:</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            value="{{ $product->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label text-golden">Description:</label>
                        <textarea class="form-control" id="description" name="description"
                            rows="3">{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label text-golden">Image:</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-3 text-center">
                        <img class="img-fluid" src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->title }}">
                    </div>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-warning mx-auto">Edit</button>
                </form>
            </div>
        </div>
    </div>

@endsection