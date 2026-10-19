@extends('layouts.app')

@section('title', 'Show Category')

@section('content')

    <div class="container-fluid p-4">

        <div class="page-header mb-4">
            <div>
                <h5 class="fw-bold mb-1"><a href="{{ route('categories.index') }}" class="text-dark back-btn">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                    </a>Show Category</h5>
                <p class="page-subtitle">
                    Show one category.
                </p>
            </div>
        </div>

        <form>

            <div class="row g-4">

                <input name="old_id" type="hidden" value={{ $categories->id }}>

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

                                {{-- English --}}

                                <div class="tab-pane fade" id="en">

                                    <div class="mb-4">

                                        <label class="form-label">
                                            Category Name
                                        </label>

                                        <input type="text" class="form-control" disabled value="{{ $categories->name_en }}">

                                    </div>

                                </div>

                                {{-- Arabic --}}

                                <div class="tab-pane fade show active" id="ar">

                                    <div class="mb-4">

                                        <label class="form-label">
                                            Category Name
                                        </label>

                                        <input type="text" class="form-control" disabled
                                            value="{{ $categories->name_ar }}">

                                    </div>

                                </div>

                                <label class="form-label">
                                    Status
                                </label>

                                @if ($categories->status)
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

                {{-- Right --}}

                <div class="col-lg-4">

                    <div class="dashboard-card mb-4">

                        <div class="card-header-custom">
                            <h5>Category Image</h5>
                        </div>

                        <div class="card-body-custom">

                            <img src="{{ asset('img/categories/' . $categories->image) }}" id="previewImage"
                                class="preview-image w-100">
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>

@endsection
