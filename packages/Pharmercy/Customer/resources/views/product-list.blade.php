@extends('Customer::layout.app')

@section('title', 'Customer')

@section('content')
    <!-- Start Hero Section -->
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <!-- Title & Subtitle -->
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="pharmercy-section-title">Available Drugs</h2>
                    <p class="pharmercy-section-subtitle">Explore our wide range of medicines and healthcare products</p>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section mb-5 box-shadow-sm">
                <div class="p-3 border-0">
                    <form method="GET" action="{{ route('customer.product', ['store_id' => $storeId]) }}">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 filter-section-title">Filter Drugs</h5>
                            <div class="input-group w-50">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control form-control-sm filter-section-search" placeholder="Search...">
                                <button class="input-group-text border-0 bg-light">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Product List -->
            <div class="container">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-2">
                            <a class="product-item" href="{{ route('customer.product.view', $product->id) }}">
                                <div class="image-container mb-3">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="img-fluid product-thumbnail rounded">
                                </div>
                                <h3 class="product-title mt-3">{{ $product->name }}</h3>
                                <div class="d-flex justify-content-center gap-2 align-items-center">
                                    <p class="product-address text-decoration-line-through fw-bold mb-1">
                                        ₹{{ number_format($product->original_price, 2) }}
                                    </p>
                                    <p class="product-address text-success  fw-bold mb-1">
                                        ₹{{ number_format($product->selling_price, 2) }}
                                    </p>
                                </div>
                                <div class="product-rating text-muted mb-2">
                                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </div>
                                <span class="icon-cross">
                                    <img src="{{ asset('images/right-arrow-svgrepo-com.svg') }}" class="img-fluid">
                                </span>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No products found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Same CSS from your original -->
    <style>
        .product-thumbnail {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        @media screen and (max-width: 600px) {
            .product-title {
                font-size: 0.85rem !important;
            }

            .product-address {
                font-size: 0.75rem !important;
                margin-bottom: 0.2rem !important;
            }

            .product-rating {
                font-size: 0.75rem !important;
                margin-bottom: 0.2rem !important;
            }

            .product-rating .bi {
                font-size: 0.9em !important;
            }

            .product-thumbnail {
                height: 100px;
            }

            .filter-section-search.form-control {
                height: 32px !important;
                font-size: 0.85rem !important;
                padding: 0.15rem 0.5rem !important;
                border-radius: 3px;
            }

            .filter-section .input-group-text {
                height: 32px !important;
                font-size: 0.85rem !important;
                padding: 0.15rem 0.5rem !important;
            }

            .pharmercy-section-title {
                font-size: 22px;
                font-weight: bold;
            }

            .pharmercy-section-subtitle {
                font-size: 15px;
            }

            .filter-section-title {
                display: block !important;
                margin-bottom: 0.5rem;
            }

            .filter-section .d-flex.justify-content-between.align-items-center.mb-3 {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 1rem;
            }

            .filter-section .input-group.w-50 {
                width: 100% !important;
            }

            .hide-scrollbar {
                overflow-x: auto;
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }

            .custom-navbar .navbar-brand {
                font-size: 25px !important;
                font-weight: 600;
            }

            .custom-navbar {
                background: #1abc9c !important;
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }
    </style>
@endsection