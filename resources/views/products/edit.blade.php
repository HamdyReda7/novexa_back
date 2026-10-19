@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

    <div class="container-fluid p-4">

        <div class="page-header mb-4">
            <div>
                <h5 class="fw-bold mb-1">
                    <a href="{{ route('products.index') }}" class="text-dark back-btn">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                    </a>
                    Edit Product
                </h5>
                <p class="page-subtitle">Edit product.</p>
            </div>
        </div>

        <form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Hidden old_id --}}
            <input type="hidden" name="old_id" value="{{ $product->id }}">

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
                                    <button type="button" class="nav-link active" data-bs-toggle="pill"
                                        data-bs-target="#ar">
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
                                        <label class="form-label">Product Title</label>
                                        <input type="text" class="form-control" name="title_ar"
                                            value="{{ old('title_ar', $product->title_ar) }}" placeholder="ادخل اسم المنتج">
                                        @error('title_ar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="6" name="description_ar" placeholder="ادخل وصف المنتج">{{ old('description_ar', $product->description_ar) }}</textarea>
                                        @error('description_ar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                {{-- English --}}
                                <div class="tab-pane fade" id="en">

                                    <div class="mb-4">
                                        <label class="form-label">Product Title</label>
                                        <input type="text" class="form-control" name="title_en"
                                            value="{{ old('title_en', $product->title_en) }}"
                                            placeholder="Enter product title">
                                        @error('title_en')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="6" name="description_en" placeholder="Enter product description">{{ old('description_en', $product->description_en) }}</textarea>
                                        @error('description_en')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                            <hr class="my-4">

                            <div class="row">

                                {{-- Price Before --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price Before</label>
                                    <input type="number" step="0.01" name="price_before"
                                        value="{{ old('price_before', $product->price_before) }}" class="form-control">
                                    @error('price_before')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Price After --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price After</label>
                                    <input type="number" step="0.01" name="price_after"
                                        value="{{ old('price_after', $product->price_after) }}" class="form-control">
                                    @error('price_after')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Quantity --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                        class="form-control">
                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1"
                                            {{ old('status', $product->status) == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $product->status) == 0 ? 'selected' : '' }}>
                                            Hidden
                                        </option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                {{-- Current Images --}}
                                @if ($product->images && count($product->images) > 0)
                                    <div class="card-header-custom">
                                        <h5>Current Images</h5>
                                    </div>

                                    <div class="card-body-custom">

                                        <div class="row g-2">
                                            @foreach ($product->images as $image)
                                                <div class="col-6" id="image-wrapper-{{ $loop->index }}">

                                                    <div class="position-relative">

                                                        <img src="{{ asset('img/products/' . $image) }}"
                                                            class="img-fluid rounded border"
                                                            style="height: 110px; width: 100%; object-fit: cover;">

                                                        <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image-btn"
                                                            data-image="{{ $image }}"
                                                            data-product-id="{{ $product->id }}"
                                                            data-wrapper="image-wrapper-{{ $loop->index }}"
                                                            style="padding: 2px 7px; font-size: 12px;">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>

                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @endif

                                {{-- Upload New Images --}}

                                <div class="card-header-custom">
                                    <h5>Upload New Images</h5>
                                </div>

                                <div class="card-body-custom">

                                    <div id="imagesContainer">

                                        <label class="upload-box upload-label mb-3">

                                            <div class="upload-content">

                                                <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>

                                                <h5 class="upload-title mt-3">
                                                    Upload Image
                                                </h5>

                                                <p class="upload-text text-muted mb-0">
                                                    Click to choose image
                                                </p>

                                            </div>

                                            <input type="file" name="images[]" accept="image/*"
                                                class="image-input d-none">

                                        </label>

                                    </div>

                                    @error('images')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Right Side --}}
                <div class="col-lg-4">

                    {{-- Product Options --}}
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

                                <div class="row">

                                    @foreach ($categories as $category)
                                        <div class="col-md-4 col-sm-6 mb-2">

                                            <div class="form-check">

                                                <input class="form-check-input" type="checkbox" name="categories[]"
                                                    id="category{{ $category->id }}" value="{{ $category->id }}"
                                                    {{ collect(old('categories', $product->categories->pluck('id')->toArray()))->contains($category->id) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="category{{ $category->id }}">
                                                    {{ $category->name_en }}
                                                </label>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                                @error('categories')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <hr>

                            {{-- Sizes --}}
                            <div class="mb-4">

                                <h6 class="fw-bold mb-3">
                                    Sizes
                                </h6>

                                <div class="row">

                                    @foreach ($sizes as $size)
                                        <div class="col-md-4 col-sm-6 mb-2">

                                            <div class="form-check">

                                                <input class="form-check-input" type="checkbox" name="sizes[]"
                                                    id="size{{ $size->id }}" value="{{ $size->id }}"
                                                    {{ collect(old('sizes', $product->sizes->pluck('id')->toArray()))->contains($size->id) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="size{{ $size->id }}">
                                                    {{ $size->name }}
                                                </label>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>

                            <hr>

                            {{-- Colors --}}
                            <div>

                                <h6 class="fw-bold mb-3">
                                    Colors
                                </h6>

                                <div class="row">

                                    @foreach ($colors as $color)
                                        <div class="col-md-4 col-sm-6 mb-2">

                                            <div class="form-check">

                                                <input class="form-check-input" type="checkbox" name="colors[]"
                                                    id="color{{ $color->id }}" value="{{ $color->id }}"
                                                    {{ collect(old('colors', $product->colors->pluck('id')->toArray()))->contains($color->id) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="color{{ $color->id }}">
                                                    {{ $color->name }}
                                                </label>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="text-end mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-light px-4">Cancel</a>
                <button type="submit" class="btn btn-primary px-4 ms-2">
                    <i class="fa-solid fa-floppy-disk me-2"></i>
                    Update Product
                </button>
            </div>

        </form>

    </div>

    <script>
        // Add new image input dynamically
        document.getElementById('imagesContainer').addEventListener('change', function(e) {

            if (!e.target.classList.contains('image-input')) return;

            const inputs = document.querySelectorAll('.image-input');

            // تغيير شكل الـ Upload Box الحالي
            const label = e.target.closest('.upload-label');

            if (label && e.target.files.length) {

                label.classList.add('success');

                label.querySelector('.upload-icon').classList.remove('fa-cloud-arrow-up');
                label.querySelector('.upload-icon').classList.add('fa-circle-check');

                label.querySelector('.upload-title').textContent = 'Image Changed';

                label.querySelector('.upload-text').textContent = e.target.files[0].name;
            }

            if (e.target === inputs[inputs.length - 1] && e.target.files.length) {

                const newLabel = document.createElement('label');

                newLabel.className = 'upload-box upload-label mb-3';

                newLabel.innerHTML = `
            <div class="upload-content">

                <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>

                <h5 class="upload-title mt-3">
                    Upload Image
                </h5>

                <p class="upload-text text-muted mb-0">
                    Click to choose image
                </p>

            </div>

            <input
                type="file"
                name="images[]"
                accept="image/*"
                class="image-input d-none">
        `;

                this.appendChild(newLabel);
            }

        });

        document.querySelectorAll('.delete-image-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const image = this.dataset.image;
                const productId = this.dataset.productId;
                const wrapperId = this.dataset.wrapper;

                if (!confirm('Are you sure you want to delete this image?')) return;

                fetch('{{ route('products.image.delete') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            image: image,
                            product_id: productId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(wrapperId).remove();
                        } else {
                            alert(data.message || 'Failed to delete image.');
                        }
                    })
                    .catch(() => alert('Something went wrong.'));
            });
        });
    </script>

@endsection
