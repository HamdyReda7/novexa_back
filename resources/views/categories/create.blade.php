@extends('layouts.app')

@section('title', 'Add Category')

@section('content')

    <div class="container-fluid p-4">

        <div class="page-header mb-4">
            <div>
                <h5 class="fw-bold mb-1"><a href="{{ route('categories.index') }}" class="text-dark back-btn">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                    </a>Add Category</h5>
                <p class="page-subtitle">
                    Create a new category.
                </p>
            </div>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                {{-- Left --}}
                <div class="col-lg-8">

                    <div class="dashboard-card">

                        <div class="card-header-custom">
                            <h5>Category Information</h5>
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
                                            Category Name
                                        </label>

                                        <input type="text" class="form-control" name="name_ar"
                                            placeholder="ادخل اسم القسم">
                                        @error('name_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                </div>

                                {{-- English --}}

                                <div class="tab-pane fade" id="en">

                                    <div class="mb-4">

                                        <label class="form-label">
                                            Category Name
                                        </label>

                                        <input type="text" class="form-control" name="name_en"
                                            placeholder="Enter category name">
                                        @error('name_en')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Right --}}

                <div class="col-lg-4">

                    <div class="dashboard-card mb-4">

                        <div class="card-header-custom">
                            <h5>Category Image</h5>
                        </div>

                        <div class="card-body-custom">

                            <label class="upload-box" id="uploadBox">

                                <div class="upload-content">

                                    <input type="file" hidden name="image" id="image" accept="image/*">

                                    <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>

                                    <h6 class="upload-title">
                                        Upload Image
                                    </h6>

                                    <small class="upload-text">
                                        Click to choose image
                                    </small>

                                </div>

                            </label>


                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>



                    <div class="dashboard-card">

                        <div class="card-header-custom">
                            <h5>Status</h5>
                        </div>

                        <div class="card-body-custom">

                            <select class="form-select" name="status">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Hidden
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <div class="text-end mt-4">

                <a href="{{ route('categories.index') }}" class="btn btn-light px-4">

                    Cancel

                </a>

                <button class="btn btn-primary px-4 ms-2">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Save Category

                </button>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const uploadBox = document.getElementById("uploadBox");

            function bindInput() {

                const imageInput = document.getElementById("image");

                imageInput.addEventListener("change", function() {

                    if (!this.files.length) return;

                    uploadBox.classList.add("success");

                    uploadBox.innerHTML = `
                <div class="upload-content">

                    <input
                        type="file"
                        hidden
                        name="image"
                        id="image"
                        accept="image/*">

                    <i class="fa-solid fa-circle-check upload-icon"></i>

                    <h6 class="upload-title">
                        Image Changed
                    </h6>

                    <small class="upload-text">
                        ${this.files[0].name}
                    </small>

                </div>
            `;

                    const newInput = document.getElementById("image");

                    const dt = new DataTransfer();
                    dt.items.add(this.files[0]);

                    newInput.files = dt.files;

                    bindInput();

                });

            }

            bindInput();

        });
    </script>

@endsection
