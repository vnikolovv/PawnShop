@extends('layouts.main')

@section('maincontent')

    <div class="container mt-5">
        <h1 class="mb-4 text-center text-golden"> {{ $product->title }} </h1>
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ Str::startsWith($product->image, 'https://') ? $product->image : asset('uploads/' . $product->image) }}" class="d-block w-100" alt="Product Main Image">
                        </div>
                        @foreach ($additionalImages as $image)
                        <div class="carousel-item">
                            <img src="{{ Str::startsWith($image->image, 'https://') ? $image->image : asset('uploads/' . $image->image) }}" class="d-block w-100" alt="Product Image">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <p class="mb-4 text-justify text-golden">{{ $product->description }}</p>
                <div class="d-flex justify-content-center">
                    <form action="{{ route('product.reserve') }}" method="POST">
                        @csrf
                        <input type="hidden" name="productId" value="{{ $product->id }}">
                        <button type="submit" class="{{ $reserved ? 'disabled' : '' }} btn btn-light mx-2">
                            {{ $reserved && $reserved->user_id == Auth::user()->id ? 'Waiting for pickup' : ($reserved ? 'Reserved' : 'Reserve') }}
                        </button>
                    </form>
                    <div>
                        @if ($errors->has('price'))
                            <div class="text-danger">{{ $errors->first('price') }}</div>
                        @endif
                        <button type="button" class="btn btn-warning mx-2 {{ $reserved || $offerSent ? 'disabled' : '' }}"
                            data-bs-toggle="modal" data-bs-target="#negotiationModal" id="negotiationButton">
                            {{ $offerSent ? 'Offer sent for ' . $offerSent->price . '$' : 'Negotiate' }}
                        </button>

                    </div>
                </div>

                <div class="modal fade" id="negotiationModal" tabindex="-1" aria-labelledby="negotiationModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-golden" id="negotiationModalLabel">Negotiate Price</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('product.negotiate') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="price" class="form-label text-golden">Price:</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                                            placeholder="Enter your offer">
                                    </div>
                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                    <input type="hidden" name="productPrice" value="{{ $product->price }}">
                                    <button type="submit" class="btn btn-warning w-100">
                                        Submit Offer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection