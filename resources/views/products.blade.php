@extends('layouts.main')

@section('maincontent')

@if ($products->isEmpty())
    <h1 class="text-golden">No products were found</h1>
@else
@foreach ($products as $product)
    <div class="card mb-4 bg-dark text-light" style="width: 18rem; border-color: gold;">
        <!-- ' . $fav_btn . $edit_delete . ' -->
        <img src="uploads/'{{ $product->image }} '" class="card-img-top" alt="Product Image">
        <div class="card-body">
            <h5 class="card-title text-golden"> {{ $product->title }}</h5>
            <p class="card-text text-golden"> {{ $product->title }}$</p>
        </div>
        <!-- ' . $view_btn . ' -->
    </div>
@endforeach
@endif
@endsection