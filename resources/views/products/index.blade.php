@extends('layouts.app')

@section('title', 'Products')

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
                <h5 class="fw-bold mb-1">Products</h5>
                <p class="text-muted mb-0">
                    Manage all products from here
                </p>
            </div>

            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg add-btn">
                <i class="fa-solid fa-plus me-2"></i>
                Add product
            </a>

        </div>


        {{-- Table --}}
        <div class="card dashboard-card border-0">

            <div class="header-table py-2">
                <div class="position-relative input-search">
                    <i class="fa fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" class="form-control ps-5" id="search" placeholder="Search product...">
                </div>

                <div class="selected">
                    <select class="form-select" id="categoryFilter">
                        <option value="all">All Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-select" id="statusFilter">
                        <option value="all">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Hidden</option>
                    </select>
                </div>
            </div>


            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h4 class="mb-0 fw-bold">
                        All Products
                    </h4>

                    <span class="badge bg-primary px-3 py-2">
                        {{ $products->count() }} Products
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
                                <th>price</th>
                                <th>quantity</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Created</th>
                                <th width="170" class="text-center">
                                    Actions
                                </th>
                            </tr>

                        </thead>

                        <tbody id="categoriesTable">

                            @forelse($products as $product)
                                <tr data-status="{{ $product->status ? 1 : 0 }}"
                                    data-category="{{ $product->categories->pluck('id')->implode(',') }}">
                                    <td>
                                        <img src="{{ asset('img/products/' . collect($product->images)->first()) }}"
                                            width="70" height="70">
                                    </td>

                                    <td>
                                        <strong>
                                            {{ app()->getLocale() == 'ar' ? $product->title_ar : $product->title_en }}
                                        </strong>

                                        <span class="d-none">
                                            {{ app()->getLocale() == 'ar' ? $product->title_en : $product->title_ar }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $product->price_after }}
                                    </td>

                                    <td>
                                        {{ $product->quantity }}
                                    </td>

                                    <td>
                                        @if ($product->status)
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
                                        @foreach ($product->categories as $category)
                                            <span class="badge bg-primary me-1 p-2">
                                                {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                                            </span>

                                            <span class="d-none">
                                                {{ app()->getLocale() == 'ar' ? $category->name_en : $category->name_ar }}
                                            </span>
                                        @endforeach
                                    </td>

                                    <td>
                                        {{ $product->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ route('products.show', $product->id) }}" class="action-btn view">

                                                <i class="fa-solid fa-eye"></i>

                                            </a>

                                            <a href="{{ route('products.edit', $product->id) }}" class="action-btn edit">

                                                <i class="fa-solid fa-pen"></i>

                                            </a>

                                            <a href="{{ route('products.delete', $product->id) }}"
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

                                            <h5>No Products Found</h5>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                            <tr id="noResultsRow" style="display:none;">
                                <td colspan="8">
                                    <div class="text-center py-5">
                                        <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                                        <h5>No Products Found</h5>
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
            const category = document.getElementById('categoryFilter').value;

            // معرفة اللغة الحالية
            const isArabic = document.documentElement.lang === 'ar' ||
                document.body.dir === 'rtl';

            const rows = document.querySelectorAll('#categoriesTable tr[data-status]');
            let visibleRows = 0;

            rows.forEach(row => {

                const text = row.textContent.toLowerCase();
                const rowStatus = row.dataset.status;
                const rowCategories = row.dataset.category ?
                    row.dataset.category.split(',') : [];

                const matchSearch = text.includes(search);
                const matchStatus = (status === 'all' || rowStatus === status);
                const matchCategory = (category === 'all' || rowCategories.includes(category));

                if (matchSearch && matchStatus && matchCategory) {
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
                        'لا توجد منتجات مطابقة لعملية البحث.' :
                        'No products found matching your search.';

                } else if (status === '0' && category !== 'all') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد منتجات مخفية في هذا القسم.' :
                        'There are no hidden products in this category.';

                } else if (status === '0') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد منتجات مخفية.' :
                        'There are no hidden products.';

                } else if (status === '1' && category !== 'all') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد منتجات مفعلة في هذا القسم.' :
                        'There are no active products in this category.';

                } else if (status === '1') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد منتجات مفعلة.' :
                        'There are no active products.';

                } else if (category !== 'all') {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد منتجات في هذا القسم.' :
                        'There are no products in this category.';

                } else {

                    noResultsMessage.innerText = isArabic ?
                        'لا توجد منتجات.' :
                        'No products found.';

                }

                noResultsRow.style.display = '';

            } else {

                noResultsRow.style.display = 'none';

            }

        }

        document.getElementById('search').addEventListener('keyup', filterTable);
        document.getElementById('statusFilter').addEventListener('change', filterTable);
        document.getElementById('categoryFilter').addEventListener('change', filterTable);
    </script>

@endsection
