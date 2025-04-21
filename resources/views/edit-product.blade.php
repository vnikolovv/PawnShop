@extends('layouts.main')

@section('maincontent')

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <form class="border rounded p-4" method="POST"
                    action="{{ route('product.edit-product', ['id' => $product->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-center text-golden">Edit product</h3>
                    <div class="mb-3">
                        @if ($errors->has('title'))
                            <div class="text-danger">{{ $errors->first('title') }}</div>
                        @endif
                        <label for="title" class="form-label text-golden">Name:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}">
                    </div>
                    <div class="mb-3">
                        @if ($errors->has('price'))
                            <div class="text-danger">{{ $errors->first('price') }}</div>
                        @endif

                        <label for="price" class="form-label text-golden">Price:</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            value="{{ $product->price }}">
                    </div>
                    <div class="mb-3">
                        @if ($errors->has('description'))
                            <div class="text-danger">{{ $errors->first('description') }}</div>
                        @endif

                        <label for="description" class="form-label text-golden">Description:</label>
                        <textarea class="form-control" id="description" name="description"
                            rows="3">{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label text-golden">Image:</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-3 text-center">
                        <img class="img-fluid" src="{{ Str::startsWith($product->image, 'https://') ? $product->image : asset('uploads/' . $product->image) }}">
                    </div>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-warning mx-auto">Edit</button>
                </form>
            </div>
            <div class="col-md-6">
                <form class="border rounded p-4" method="POST" action="{{ route('product.add-additional-images') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-center text-golden">Upload Additional Photos</h3>
                    <div class="mb-3">
                        @if ($errors->has('additionalImages'))
                            <div class="text-danger">{{ $errors->first('additionalImages') }}</div>
                        @endif
                        <label for="additionalImages" class="form-label text-golden">Additional Images:</label>
                        <input type="file" class="form-control" id="additionalImages" name="additionalImages[]"
                            accept="image/*" multiple>
                    </div>
                    <input type="hidden" name="productId" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-warning mx-auto">Upload</button>
                </form>
            </div>
        </div>
        <div class="row mb-4">
            @foreach ($additionalImages as $image)
                <div class="col-md-6">
                    <form class="border rounded p-4" method="POST" action="{{ route('product.delete-additional-image') }}">
                        @csrf
                        <h3 class="text-center text-golden">Delete Photo</h3>
                        <div class="mb-3 d-flex justify-content-center">
                            <img class="img-fluid" src="{{ asset('uploads/' . $image->image) }}" alt="Product Image">
                        </div>
                        <input type="hidden" name="id" value="{{ $image->id }}">
                        <button type="submit" class="btn btn-danger mx-auto">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

@endsection