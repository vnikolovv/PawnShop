@extends('layouts.main')

@section('maincontent')

    <div class="d-flex flex-wrap justify-content-between">

        @if ($products->isEmpty())
            <h1 class="text-golden">No products were found</h1>
        @else
            @foreach ($products as $product)
                <div class="card mb-4 bg-dark text-light" style="width: 18rem; border-color: gold;">
                    @if (Auth::user()->name == 'admin')
                        <div class="card-header d-flex flex-row justify-content-between">
                        <a class="btn btn-sm btn-light" href="{{ route('product.edit', ['id' => $product->id]) }}">Change</a>                            <form method="POST" action="{{ route('product.delete-product') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    @endif
                    <img src="{{ asset('uploads/' . $product->image) }}" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title text-golden"> {{ $product->title }}</h5>
                        <p class="card-text text-golden"> {{ $product->price }}$</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="/product/{{ $product->id }}" class="btn btn-sm btn-warning">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection