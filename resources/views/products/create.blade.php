@extends('layouts.app')

@section('title', 'Add Product')

@section('content')

    <div class="container-fluid p-4">

        <div class="page-header mb-4">

            <div>

                <h5 class="fw-bold mb-1">

                    <a href="{{ route('products.index') }}" class="text-dark back-btn">

                        <i class="fa-solid fa-arrow-left me-2"></i>

                    </a>

                    Add Product

                </h5>

                <p class="page-subtitle">

                    Create a new product.

                </p>

            </div>

        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

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

                                        <label class="form-label">

                                            Product Title

                                        </label>

                                        <input type="text" class="form-control" name="title_ar"
                                            value="{{ old('title_ar') }}" placeholder="ادخل اسم المنتج">

                                        @error('title_ar')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                    <div class="mb-4">

                                        <label class="form-label">

                                            Description

                                        </label>

                                        <textarea class="form-control" rows="6" name="description_ar" placeholder="ادخل وصف المنتج">{{ old('description_ar') }}</textarea>

                                        @error('description_ar')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>

                                {{-- English --}}
                                <div class="tab-pane fade" id="en">

                                    <div class="mb-4">

                                        <label class="form-label">

                                            Product Title

                                        </label>

                                        <input type="text" class="form-control" name="title_en"
                                            value="{{ old('title_en') }}" placeholder="Enter product title">

                                        @error('title_en')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                    <div class="mb-4">

                                        <label class="form-label">

                                            Description

                                        </label>

                                        <textarea class="form-control" rows="6" name="description_en" placeholder="Enter product description">{{ old('description_en') }}</textarea>

                                        @error('description_en')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
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
                                        value="{{ old('price_before') }}" class="form-control">

                                    @error('price_before')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Price After --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price After</label>

                                    <input type="number" step="0.01" name="price_after"
                                        value="{{ old('price_after') }}" class="form-control">

                                    @error('price_after')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Quantity --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Quantity</label>

                                    <input type="number" name="quantity" value="{{ old('quantity', 0) }}"
                                        class="form-control">

                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>

                                    <select name="status" class="form-select">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                            Hidden
                                        </option>
                                    </select>

                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                
                                {{-- Images --}}
                                
                                <div class="card-header-custom">
                                    <hr class="my-2">
                                    <h5 class="mt-3">Product Images</h5>
                                </div>
                                
                                <div class="card-body-custom">
                                    
                                    <div id="imagesContainer">

                                        <label class="upload-box mb-3">

                                            <input type="file" hidden name="images[]" class="image-input"
                                                accept="image/*">

                                            <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>

                                            <h6 class="uploadTitle">
                                                Upload Image
                                            </h6>

                                            <small class="uploadText">
                                                Click to choose image
                                            </small>

                                        </label>

                                    </div>
                                    @error('images')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                            </div>

                        </div>


                    </div>


                </div>

                {{-- Right Side --}}
                <div class="col-lg-4">
                    {{-- categories --}}
                    <div class="dashboard-card mb-4">

                        <div class="card-header-custom">
                            <h5>Categories</h5>
                        </div>

                        <div class="card-body-custom">

                            <div class="row">

                                @foreach ($categories as $category)
                                    <div class="col-md-4 col-sm-6 mb-2">

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" name="categories[]"
                                                id="category{{ $category->id }}" value="{{ $category->id }}"
                                                {{ collect(old('categories'))->contains($category->id) ? 'checked' : '' }}>

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

                    </div>

                    {{-- Product Options --}}
                    <div class="dashboard-card mb-4">

                        <div class="card-header-custom">
                            <h5>Product Options</h5>
                        </div>

                        <div class="card-body-custom">

                            {{-- Sizes --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Sizes
                                </label>

                                <div class="row">

                                    @foreach ($sizes as $size)
                                        <div class="col-md-4 col-sm-6 mb-2">

                                            <div class="form-check">

                                                <input class="form-check-input" type="checkbox" name="sizes[]"
                                                    id="size{{ $size->id }}" value="{{ $size->id }}"
                                                    {{ collect(old('sizes'))->contains($size->id) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="size{{ $size->id }}">
                                                    {{ $size->name }}
                                                </label>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                                @error('sizes')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <hr>

                            {{-- Colors --}}
                            <div>

                                <label class="form-label fw-semibold">
                                    Colors
                                </label>

                                <div class="row">

                                    @foreach ($colors as $color)
                                        <div class="col-md-4 col-sm-6 mb-2">

                                            <div class="form-check">

                                                <input class="form-check-input" type="checkbox" name="colors[]"
                                                    id="color{{ $color->id }}" value="{{ $color->id }}"
                                                    {{ collect(old('colors'))->contains($color->id) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="color{{ $color->id }}">
                                                    {{ $color->name }}
                                                </label>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                                @error('colors')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                    </div>


                </div>

            </div>

            <div class="text-end mt-4">

                <a href="{{ route('products.index') }}" class="btn btn-light px-4">

                    Cancel

                </a>

                <button type="submit" class="btn btn-primary px-4 ms-2">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Save Product

                </button>

            </div>

        </form>

    </div>

    <script>
        document.getElementById('imagesContainer').addEventListener('change', function(e) {

            if (!e.target.classList.contains('image-input')) return;

            // تغيير شكل الـ Upload الحالي
            const box = e.target.closest('.upload-box');

            if (box && e.target.files.length) {

                box.classList.add('success');

                box.querySelector('.upload-icon').classList.remove('fa-cloud-arrow-up');
                box.querySelector('.upload-icon').classList.add('fa-circle-check');

                box.querySelector('.uploadTitle').textContent = 'Image Changed';

                box.querySelector('.uploadText').textContent = e.target.files[0].name;
            }

            const inputs = document.querySelectorAll('.image-input');

            if (e.target === inputs[inputs.length - 1] && e.target.files.length) {

                const label = document.createElement('label');

                label.className = 'upload-box mb-3';

                label.innerHTML = `
            <input
                type="file"
                hidden
                name="images[]"
                class="image-input"
                accept="image/*">

            <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>

            <h6 class="uploadTitle">
                Upload Image
            </h6>

            <small class="uploadText">
                Click to choose image
            </small>
        `;

                this.appendChild(label);

            }

        });
    </script>

@endsection
