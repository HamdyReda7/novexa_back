@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="container-fluid p-4">


        @if (session('success'))
            <div id="successModal" class="success-modal">
                <div class="success-box">

                    <div class="success-circle">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <h4>Successfly</h4>

                    <p class="fw-bolder text-dark">{{ session('success') }}</p>

                    <button type="button" class="btn btn-success success-btn" id="closeSuccessModal">

                        OK

                    </button>

                </div>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="fw-bold mb-1">Categories</h5>
                <p class="text-muted mb-0">
                    Manage all categories from here
                </p>
            </div>

            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-lg add-btn">
                <i class="fa-solid fa-plus me-2"></i>
                Add Category
            </a>

        </div>


        {{-- Table --}}
        <div class="card dashboard-card border-0">

            <div class="header-table py-2">
                <div class="position-relative w-50">
                    <i class="fa fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" class="form-control ps-5" id="search" placeholder="Search category...">
                </div>

                <select class="form-select w-25" id="statusFilter">
                    <option value="all">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Hidden</option>
                </select>
            </div>


            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h4 class="mb-0 fw-bold">
                        All Categories
                    </h4>

                    <span class="badge bg-primary px-3 py-2">
                        {{ $categories->count() }} Categories
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0 text-center">

                        <thead>

                            <tr>

                                <th>Image</th>

                                <th>Name</th>

                                <th width="120">Products</th>

                                <th width="120">Status</th>

                                <th width="170">Created</th>

                                <th width="170" class="text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody id="categoriesTable">

                            @forelse($categories as $category)
                                <tr data-status="{{ $category->status }}">
                                    <td>
                                        <img class="rounded" src="{{ asset('img/categories/' . $category->image) }}"
                                            height="70px" width="70">
                                    </td>

                                    <td>
                                        <strong>
                                            {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                                        </strong>

                                        <span class="d-none">
                                            {{ app()->getLocale() == 'ar' ? $category->name_en : $category->name_ar }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $category->products_count ?? 0 }}
                                        </span>
                                    </td>

                                    <td>

                                        @if ($category->status)
                                            <span class="status active">
                                                {{ app()->getLocale() == 'ar' ? 'مفعل' : 'Active' }}
                                            </span>
                                        @else
                                            <span class="status hidden">
                                                {{ app()->getLocale() == 'ar' ? 'مخفي' : 'Hidden' }}
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $category->created_at->format('d M Y') }}

                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ route('categories.show', $category->id) }}"
                                                class="action-btn view">

                                                <i class="fa-solid fa-eye"></i>

                                            </a>

                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="action-btn edit">

                                                <i class="fa-solid fa-pen"></i>

                                            </a>

                                            <a href="{{ route('categories.delete', $category->id) }}"
                                                class="action-btn delete">

                                                <i class="fa-solid fa-trash"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7">

                                        <div class="text-center py-5">

                                            <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>

                                            <h5>No Categories Found</h5>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                            <tr id="noResultsRow" style="display:none;">
                                <td colspan="6">
                                    <div class="text-center py-5">
                                        <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                                        <h5>
                                            {{ app()->getLocale() == 'ar' ? 'لا توجد أقسام' : 'No Categories Found' }}
                                        </h5>

                                        <p class="text-muted" id="noResultsMessage"></p>
                                    </div>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
    <script>
        function filterTable() {

            const search = document.getElementById('search').value.trim().toLowerCase();
            const status = document.getElementById('statusFilter').value;

            const isArabic = @json(app()->getLocale() == 'ar');

            const rows = document.querySelectorAll('#categoriesTable tr[data-status]');

            let visibleRows = 0;

            rows.forEach(row => {

                const text = row.textContent.toLowerCase();
                const rowStatus = row.dataset.status;

                const matchSearch = text.includes(search);
                const matchStatus = status === 'all' || rowStatus === status;

                if (matchSearch && matchStatus) {

                    row.style.display = '';
                    visibleRows++;

                } else {

                    row.style.display = 'none';

                }

            });

            const noResultsRow = document.getElementById('noResultsRow');
            const noResultsMessage = document.getElementById('noResultsMessage');

            if (visibleRows === 0) {

                if (search !== '') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد أقسام مطابقة لعملية البحث.' :
                        'No categories found matching your search.';

                } else if (status === '0') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد أقسام مخفية.' :
                        'There are no hidden categories.';

                } else if (status === '1') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد أقسام مفعلة.' :
                        'There are no active categories.';

                } else {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد أقسام.' :
                        'No categories found.';

                }

                noResultsRow.style.display = '';

            } else {

                noResultsRow.style.display = 'none';

            }

        }

        document.getElementById('search').addEventListener('keyup', filterTable);
        document.getElementById('statusFilter').addEventListener('change', filterTable);
    </script>

@endsection
