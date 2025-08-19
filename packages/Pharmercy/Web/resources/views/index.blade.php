@extends('Web::layout.app')
@section('content')

    <!-- Start Hero Section -->
    <div class="hero py-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5">
                    <div>
                        <h1 class="mb-4">Find Your Nearby Pharmacy</h1>
                        <p class="mb-4">Discover licensed pharmacies in your area and place orders directly. Pharmacy owners
                            can list their store after KYC verification and grow their business online.</p>
                        <p>
                            <a href="#" class="btn btn-secondary me-3  px-4 py-2">Browse Pharmacies</a>
                            <a href="#" class="btn btn-white-outline px-4 py-2">Learn More</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end text-center">
                    <div class="hero-img-wrap">
                        <img src="/images/6286fe8a7bea2e869bf2efaf4ea90572-removebg-preview.png" class="img-fluid"
                            alt="Pharmacy Hero" style="max-width: 90%; height: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Pharmacy Listing Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Verified Local Pharmacies</h2>
                    <p class="mb-4">We connect you to nearby pharmacies where you can order medicines with ease. Pharmacy
                        owners can list their stores after quick verification.</p>
                    <p><a href="shop.html" class="btn">Find Pharmacies</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Pharmacy 1 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="pharmacy-details.html">
                        <img src="https://s3-media0.fl.yelpcdn.com/bphoto/zYx3ykVgEuqaLmzxI_kV8g/1000s.jpg"
                            class="img-fluid product-thumbnail" alt="HealthPlus Pharmacy">
                        <h3 class="product-title">HealthPlus Pharmacy</h3>
                        <strong class="product-price">Chennai, Tamil Nadu</strong>
                        <span class="icon-cross">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Pharmacy 1 -->

                <!-- Start Pharmacy 2 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="pharmacy-details.html">
                        <img src="https://s3-media0.fl.yelpcdn.com/bphoto/zYx3ykVgEuqaLmzxI_kV8g/1000s.jpg"
                            class="img-fluid product-thumbnail" alt="CityMeds Store">
                        <h3 class="product-title">CityMeds Store</h3>
                        <strong class="product-price">Bangalore, Karnataka</strong>
                        <span class="icon-cross">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Pharmacy 2 -->

                <!-- Start Pharmacy 3 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="pharmacy-details.html">
                        <img src="https://s3-media0.fl.yelpcdn.com/bphoto/zYx3ykVgEuqaLmzxI_kV8g/1000s.jpg"
                            class="img-fluid product-thumbnail" alt="MedCare Pharmacy">
                        <h3 class="product-title">MedCare Pharmacy</h3>
                        <strong class="product-price">Hyderabad, Telangana</strong>
                        <span class="icon-cross">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Pharmacy 3 -->

            </div>
        </div>
    </div>
    <!-- End Pharmacy Listing Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose PharmaHub</h2>
                    <p>We ensure a trusted pharmacy network where buyers get genuine medicines and sellers grow their
                        businesses with ease.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/truck.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Fast & Free Delivery</h3>
                                <p>Quick doorstep delivery of your orders from nearby pharmacies.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/bag.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Simple Shopping</h3>
                                <p>Find and order from local pharmacies with ease and convenience.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/support.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>We provide round-the-clock assistance to buyers and pharmacy owners.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/return.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Hassle-Free Returns</h3>
                                <p>Eligible orders can be returned with ease, making your experience smooth.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="https://i.pinimg.com/736x/ab/a7/1d/aba71d49d003c4c5146f8ad4ffd10f45.jpg" alt="Pharmacy Benefits"
                            class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="https://i.pinimg.com/736x/91/d2/d6/91d2d690ac0b68bd794cee3d577a2f99.jpg"
                                alt="PharmaHub"></div>
                        <div class="grid grid-2"><img src="https://i.pinimg.com/736x/e2/dc/99/e2dc995c0a241497f4bb42aeb827507b.jpg"
                                alt="PharmaHub"></div>
                        <div class="grid grid-3"><img src="https://i.pinimg.com/736x/61/33/5f/61335ff1771f0b2effe788f9e6dcca22.jpg"
                                alt="PharmaHub"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">Empowering Local Pharmacies Digitally</h2>
                    <p>We bring local pharmacies online, helping them reach more customers and making medicine delivery fast
                        and reliable for everyone.</p>

                    <ul class="list-unstyled custom-list my-4">
                        <li>Certified Pharmacies with Verified KYC</li>
                        <li>Easy Shop Listing for Sellers</li>
                        <li>Real-Time Order Tracking</li>
                        <li>Secure Payments & Hassle-Free Returns</li>
                    </ul>
                    <p><a href="#" class="btn">Explore Now</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start FAQ Section -->
    <div class="faq-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="text-muted">Everything you need to know about how PharmaHub works for buyers and pharmacy
                        owners.</p>
                </div>
            </div>

            <div class="accordion" id="faqAccordion">

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="faqHeadingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                            How can I order medicines from a pharmacy?
                        </button>
                    </h2>
                    <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Browse the list of pharmacies available in your location, select a pharmacy, and place your
                            order directly. You'll receive updates on order confirmation and delivery status.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="faqHeadingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                            How do I list my pharmacy on PharmaHub?
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pharmacy owners can register and complete the KYC verification process through our seller
                            dashboard. Once approved, you can list your pharmacy and manage products & orders.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="faqHeadingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                            Is there any commission fee for sellers?
                        </button>
                    </h2>
                    <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, we charge a small commission per order to help maintain the platform and offer you business
                            visibility. The fee details are shared during KYC onboarding.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="faqHeadingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                            How long does delivery take?
                        </button>
                    </h2>
                    <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Delivery time depends on the pharmacy's location and delivery method. Orders from nearby stores
                            are typically delivered within a few hours.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="faqHeadingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
                            What payment methods are supported?
                        </button>
                    </h2>
                    <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We support secure online payments via UPI, Debit/Credit Cards, and also Cash on Delivery (COD)
                            where applicable.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="faqHeadingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseSix" aria-expanded="false" aria-controls="faqCollapseSix">
                            Is my prescription required?
                        </button>
                    </h2>
                    <div id="faqCollapseSix" class="accordion-collapse collapse" aria-labelledby="faqHeadingSix"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, for prescription-only medicines, you'll need to upload a valid prescription during
                            checkout. Pharmacies will verify before fulfilling your order.
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- End FAQ Section -->


    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;PharmaHub made ordering medicines from my local pharmacy so
                                                    simple. The delivery was quick and hassle-free.&rdquo;</p>
                                            </blockquote>
                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="images/person-1.png" alt="Ananya Sharma" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Ananya Sharma</h3>
                                                <span class="position d-block mb-3">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;As a pharmacy owner, listing on PharmaHub increased my visibility
                                                    and sales. The KYC process was quick and easy.&rdquo;</p>
                                            </blockquote>
                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="images/person-1.png" alt="Ravi Kumar" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Ravi Kumar</h3>
                                                <span class="position d-block mb-3">Pharmacy Owner</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

@endsection