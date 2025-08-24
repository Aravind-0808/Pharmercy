@extends('Customer::layout.app')

@section('title', 'Customer')

@section('content')
    <!-- Start Hero Section -->
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="pharmercy-section-title">Available Pharmacy</h2>
                    <p class="pharmercy-section-subtitle">Explore our exclusive range of pharmacies</p>
                </div>
            </div>
            <div class="filter-section mb-5 box-shadow-sm">
                <form method="GET" action="" class="p-3 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 filter-section-title">Filter Location</h5>
                        <div class="input-group w-50">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control form-control-sm filter-section-search"
                                placeholder="Search store name...">
                            <span type="submit" class="input-group-text"> <button type="submit"
                                    class="input-group-text border-0 bg-transparent p-0" style="cursor:pointer;">
                                    <i class="bi bi-search"></i>
                                </button></span>
                        </div>
                    </div>
                    <div class="row hide-scrollbar flex-nowrap overflow-auto g-3 align-items-center"
                        style="white-space:nowrap;">
                        <div class="col-8 col-sm-6 col-md-3" style="min-width: 220px;">
                            <label for="zip_code" class="form-label mb-1">Zip Code</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <select id="zip_code" name="zip_code" class="form-select form-select-sm">
                                    <option>Select Zip Code</option>
                                    @foreach($zipCodes as $zipCode)
                                        <option value="{{ $zipCode }}" {{ request('zip_code') == $zipCode ? 'selected' : '' }}>
                                            {{ $zipCode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-8 col-sm-6 col-md-3" style="min-width: 220px;">
                            <label for="country" class="form-label mb-1">Country</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <select id="country" name="country" class="form-select form-select-sm">
                                    <option>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-8 col-sm-6 col-md-3" style="min-width: 220px;">
                            <label for="state" class="form-label mb-1">State</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <select id="state" name="state" class="form-select form-select-sm">
                                    <option>Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>
                                            {{ $state }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-8 col-sm-6 col-md-3" style="min-width: 220px;">
                            <label for="city" class="form-label mb-1">City</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <select id="city" name="city" class="form-select form-select-sm">
                                    <option>Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container">
                <div class="row">
                    @if(count($stores) > 0)
                        @foreach($stores as $store)
                            <div class="col-6 col-md-4 col-lg-3 mb-2">
                                <a class="product-item" href="{{ url('/products/' . $store->id) }}">
                                    <div class="image-container mb-3">
                                        <img src="{{ asset($store->logo) }}" class="img-fluid product-thumbnail rounded"
                                            alt="{{ $store->name }}">
                                    </div>
                                    <h3 class="product-title mt-3">{{ $store->name }}</h3>
                                    <p class="product-address text-muted mb-1">
                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                        {{ $store->address }}, {{ $store->city }}, {{ $store->state }}, {{ $store->country }}
                                    </p>
                                    <div class="product-rating text-warning mb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <span class="text-muted">(4.0/5)</span> {{-- Optional: dynamic rating --}}
                                    </div>
                                    <span class="icon-cross">
                                        <img src="{{ asset('images/right-arrow-svgrepo-com.svg') }}" class="img-fluid">
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <h4 class="text-muted">No stores were found.</h4>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.filter-section form');
            ['zip_code', 'country', 'state', 'city'].forEach(function (id) {
                const select = document.getElementById(id);
                if (select) {
                    select.addEventListener('change', function () {
                        form.submit();
                    });
                }
            });
            // Remove auto-submit for search input
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('filterForm');
            ['zip_code', 'country', 'state', 'city'].forEach(function (id) {
                const select = document.getElementById(id);
                if (select) {
                    select.addEventListener('change', function () {
                        form.submit();
                    });
                }
            });
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                let timeout = null;
                searchInput.addEventListener('input', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        form.submit();
                    }, 500); // Wait 500ms after typing
                });
            }
        });
    </script>
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
                /* Adjust subtitle size for smaller screens */
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

            .filter-section .input-group.w-50,
            .filter-section .input-group.w-100,
            .filter-section .input-group {
                width: 100% !important;
            }

            .hide-scrollbar {
                overflow-x: auto;
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }

            .hide-scrollbar::-webkit-scrollbar {
                display: none;
                /* Chrome, Safari, Opera */
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