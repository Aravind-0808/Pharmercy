@extends('Customer::layout.app')

@section('title', 'Product View')

@section('content')
    <!-- Modern Product Card -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-11">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden"
                    style="max-width: 1200px; margin: auto; padding: 0px;">
                    <div class="row g-0 flex-column flex-lg-row">
                        <!-- Left Side - Product Image & Thumbnails -->
                        <div class="col-lg-6 bg-light d-flex flex-column justify-content-center align-items-center p-4">
                            <div class="mb-3 w-100 text-center">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="img-fluid rounded-4 shadow-sm cursor-pointer" id="product-preview"
                                    alt="Product Image"
                                    style="max-height: 500px; width: 100%; object-fit: contain; background: #fff;"
                                    data-bs-toggle="modal" data-bs-target="#imageModal">
                            </div>
                        </div>

                        <!-- Right Side - Product Details -->
                        <div class="col-lg-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h1 class="fw-bold mb-3" style="font-size: 1.5rem;">{{ $product->name }}</h1>
                                <p class="text-muted mb-4" style="font-size: 0.95rem;">{{ $product->description }}</p>
                            </div>
                            <div class="mb-5">
                                <div class="d-flex align-items-center mb-2">
                                    <h2 class="me-3 mb-0 fw-bold text-primary" style="font-size: 1.25rem;">
                                        ₹{{ $product->selling_price }}</h2>
                                    <span class="badge bg-success bg-opacity-25 py-2 px-3"
                                        style="font-size: 0.95rem;">{{ $product->discount }}%</span>
                                </div>
                                <p class="text-muted text-decoration-line-through mb-4" style="font-size: 0.95rem;">
                                    ₹{{ $product->original_price }}</p>

                                <!-- Quantity and Buttons -->
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div class="input-group flex-nowrap" style="width: 160px;">
                                        <button class="btn btn-outline-secondary minus px-3 py-2" type="button">
                                            <i class="bi bi-dash-lg fs-6"></i>
                                        </button>
                                        <input type="text" class="form-control text-center cart-number fw-bold px-0"
                                            value="0" readonly style="min-width: 40px; font-size: 1rem;">
                                        <button class="btn btn-outline-secondary plus px-3 py-2" type="button">
                                            <i class="bi bi-plus-lg fs-6"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex flex-column w-100 gap-2 justify-content-start mt-3">
                                        <form action="{{ route('customer.cart') }}" method="POST" class="w-100 mb-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" id="quantity" class="cart-number">

                                            <button type="submit"
                                                class="btn btn-primary d-flex align-items-center px-4 py-3 justify-content-center shadow-sm w-100"
                                                style="font-size: 1rem;">
                                                <i class="bi bi-cart-plus me-2 fs-6"></i> Add to Cart
                                            </button>
                                        </form>

                                        <a href="{{ route('customer.checkout', ['store_id' => $product->id, 'product_id' => $product->id, 'quantity' => '__QTY__']) }}"
                                            id="buy-now-link"
                                            class="btn btn-success d-flex align-items-center px-4 py-3 justify-content-center shadow-sm w-100">
                                            <i class="bi bi-lightning-charge me-2 fs-6"></i> Buy Now
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Image Preview -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img src="" id="modal-image-preview" class="img-fluid rounded-3" style="max-height: 80vh;">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <style>
        .img-thumbs.active {
            border: 2px solid #0d6efd !important;
            box-shadow: 0 0 0 2px #e3f0ff;
        }

        .img-thumbs {
            transition: border 0.2s, box-shadow 0.2s;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .letter-spacing-1 {
            letter-spacing: 2px;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .1) !important;
        }

        .btn-outline-secondary {
            border-color: #dee2e6;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .input-group-text {
            background-color: transparent;
        }

        #add-btn {
            transition: all 0.3s ease;
        }

        #add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.15);
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .rounded-3 {
            border-radius: 0.75rem !important;
        }

        @media (max-width: 991.98px) {
            .card.shadow-lg {
                box-shadow: none !important;
                border-radius: 0.75rem !important;
            }

            .col-lg-6.bg-light {
                padding: 2rem 1rem !important;
            }

            .img-thumbnail.img-thumbs {
                width: 64px !important;
                height: 64px !important;
            }

            #product-preview {
                max-height: 350px !important;
            }
        }

        @media (max-width: 575.98px) {
            .card {
                border-radius: 0.5rem !important;
            }

            .col-lg-6.bg-light {
                padding: 1rem 0.5rem !important;
            }

            .img-thumbs {
                width: 48px !important;
                height: 48px !important;
            }

            #product-preview {
                max-height: 220px !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const minusBtn = document.querySelector('.minus');
            const plusBtn = document.querySelector('.plus');
            const quantityInput = document.querySelector('.cart-number');
            const hiddenQuantity = document.querySelector('input[name="quantity"]'); // The hidden input for form submission
            const buyNowLink = document.getElementById('buy-now-link');
            const quantity = document.getElementById("quantity");

            // Store the base URL with placeholder
            const baseBuyNowHref = buyNowLink.getAttribute('href');

            function updateQuantity() {
                let value = parseInt(quantityInput.value) || 1;
                if (value < 1) value = 1;
                quantityInput.value = value;
                hiddenQuantity.value = value;
                quantity.value = value;

                // Update Buy Now link by replacing the placeholder with the actual quantity
                buyNowLink.href = baseBuyNowHref.replace('__QTY__', value);
            }

            minusBtn.addEventListener('click', () => {
                let currentValue = parseInt(quantityInput.value) || 1;
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    updateQuantity();
                }
            });

            plusBtn.addEventListener('click', () => {
                let currentValue = parseInt(quantityInput.value) || 1;
                quantityInput.value = currentValue + 1;
                
                updateQuantity();
            });

            // Allow manual typing
            quantityInput.addEventListener('input', updateQuantity);

            // Initial sync
            updateQuantity();
        });
    </script>
@endpush