@extends('layouts.main')

@section('maincontent')
<div class="container mt-5">
        <h1 class="mb-4 text-center text-golden"> {{ $product->title }} </h1>
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('uploads/' . $product->image) }}" class="d-block w-100" alt="Product Main Image">
                        </div>
                        <!-- foreach ($images as $image): 
                        <div class="carousel-item">
                            <img src="uploads/echo htmlspecialchars($image); ?>" class="d-block w-100" alt="Product Image">
                        </div> -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <p class="mb-4 text-justify text-golden">{{ $product->description }}</p>
                <div class="d-flex justify-content-center">
                    <form action="" method="POST">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="disabled btn btn-light mx-2" >Reserve</button>
                    </form>
                    <button type="button" class="disabled btn btn-warning mx-2" id="negotiationButton" >Negotiate</button>
                </div>
            </div>
        </div>
    </div>

@endsection