@extends('layouts.main')

@section('maincontent')
    <link rel="stylesheet" href="styles.css">
    <form class="border rounded p-4 w-50 mx-auto" method="POST" action="{{ route('product.add-product') }}"
        enctype="multipart/form-data">
        @csrf
        <h3 class="text-center text-golden">Add product</h3>
        <div class="mb-3">
            @if ($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
            <label for="title" class="form-label text-golden">Name:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            @if ($errors->has('price'))
                <div class="text-danger">{{ $errors->first('price') }}</div>
            @endif
            <label for="price" class="form-label text-golden">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            @if ($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
            <label for="description" class="form-label text-golden">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            @if ($errors->has('image'))
                <div class="text-danger">{{ $errors->first('image') }}</div>
            @endif
            <label for="image" class="form-label text-golden">Image:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" ">
            </div>
            <button type=" submit" class="btn btn-warning mx-auto">Add</button>
    </form>

@endsection