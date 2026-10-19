@extends('layouts.app')

@section('title', 'Show Product')

@section('content')

    <div class="container-fluid p-4">

        <div class="page-header mb-4">

            <div>

                <h5 class="fw-bold mb-1">
                    <a href="{{ route('products.index') }}" class="text-dark back-btn">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                    </a>
                    Show Product
                </h5>

                <p class="page-subtitle">
                    Product Details
                </p>

            </div>

        </div>

        <div class="row g-4">

            {{-- Left Side --}}
            <div class="col-lg-8">

                <div class="dashboard-card">

                    <div class="card-header-custom">
                        <h5>Product Information</h5>
                    </div>

                    <div class="card-body-custom">

                        <ul class="nav nav-pills language-tabs mb-4">

                            <li class="nav-item">
                                <button type="button" class="nav-link active" data-bs-toggle="pill" data-bs-target="#ar">

                                    🇪🇬 العربية

                                </button>
                            </li>

                            <li class="nav-item">
                                <button type="button" class="nav-link" data-bs-toggle="pill" data-bs-target="#en">

                                    🇺🇸 English

                                </button>
                            </li>

                        </ul>

                        <div class="tab-content">

                            {{-- Arabic --}}
                            <div class="tab-pane fade show active" id="ar">

                                <div class="mb-4">

                                    <label class="form-label">
                                        Product Title
                                    </label>

                                    <input type="text" class="form-control" value="{{ $product->title_ar }}" disabled>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea class="form-control" rows="6" disabled>{{ $product->description_ar }}</textarea>

                                </div>

                            </div>

                            {{-- English --}}
                            <div class="tab-pane fade" id="en">

                                <div class="mb-4">

                                    <label class="form-label">
                                        Product Title
                                    </label>

                                    <input type="text" class="form-control" value="{{ $product->title_en }}" disabled>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea class="form-control" rows="6" disabled>{{ $product->description_en }}</textarea>

                                </div>

                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="row">

                            {{-- Price Before --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Price Before
                                </label>

                                <input type="text" class="form-control" value="{{ $product->price_before }}" disabled>

                            </div>

                            {{-- Price After --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Price After
                                </label>

                                <input type="text" class="form-control" value="{{ $product->price_after }}" disabled>

                            </div>

                            {{-- Quantity --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Quantity
                                </label>

                                <input type="text" class="form-control" value="{{ $product->quantity }}" disabled>

                            </div>

                            {{-- Status --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Status
                                </label>

                                @if ($product->status)
                                    <span class="badge bg-success w-100 py-2">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-danger w-100 py-2">
                                        Hidden
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            {{-- Right Side --}}
            <div class="col-lg-4">

                {{-- Product Images --}}
                <div class="dashboard-card mb-4">

                    <div class="card-header-custom">
                        <h5>Product Images</h5>
                    </div>

                    <div class="card-body-custom">

                        @php
                            $images = $product->images ?? [];
                        @endphp

                        @if ($images && count($images))

                            <div id="productImagesCarousel" class="carousel slide" data-bs-ride="carousel">

                                <div class="carousel-inner">

                                    @foreach ($images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                                            <img src="{{ asset('img/products/' . $image) }}" class="d-block w-100 rounded"
                                                style="height:290px;object-fit:cover;">

                                        </div>
                                    @endforeach

                                </div>

                                @if (count($images) > 1)
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#productImagesCarousel" data-bs-slide="prev">

                                        <span class="carousel-control-prev-icon"></span>

                                    </button>

                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#productImagesCarousel" data-bs-slide="next">

                                        <span class="carousel-control-next-icon text-white"></span>

                                    </button>
                                @endif

                            </div>
                        @else
                            <div class="text-center py-5">

                                <i class="fa-regular fa-image fa-3x text-secondary mb-3"></i>

                                <p class="text-muted mb-0">
                                    No Images Found
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

                <div class="dashboard-card mb-4">

                    <div class="card-header-custom">
                        <h5>Product Options</h5>
                    </div>

                    <div class="card-body-custom">

                        {{-- Categories --}}
                        <div class="mb-4">

                            <h6 class="fw-bold mb-3">
                                Categories
                            </h6>

                            @forelse($product->categories as $category)
                                <span class="badge bg-primary me-2 mb-2 px-3 py-2">
                                    {{ $category->name_en }}
                                </span>
                            @empty
                                <span class="text-muted">
                                    No Categories
                                </span>
                            @endforelse

                        </div>

                        <hr>

                        {{-- Sizes --}}
                        <div class="mb-4">

                            <h6 class="fw-bold mb-3">
                                Sizes
                            </h6>

                            @forelse($product->sizes as $size)
                                <span class="badge bg-info text-dark me-2 mb-2 px-3 py-2">
                                    {{ $size->name }}
                                </span>
                            @empty
                                <span class="text-muted">
                                    No Sizes
                                </span>
                            @endforelse

                        </div>

                        <hr>

                        {{-- Colors --}}
                        <div>

                            <h6 class="fw-bold mb-3">
                                Colors
                            </h6>

                            @forelse($product->colors as $color)
                                <span class="badge bg-secondary me-2 mb-2 px-3 py-2">
                                    {{ $color->name }}
                                </span>
                            @empty
                                <span class="text-muted">
                                    No Colors
                                </span>
                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
