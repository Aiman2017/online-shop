<x-front-layout title="{{$title}}">
    <style>
        .features_items:nth-child(1) {
            margin-bottom: 0 !important;
        }

        /* Тень для текста */
        .intro-content h3,
        .intro-content h1,
        .banner-content h4,
        .banner-content h3 {
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }
    </style>
    <div class="page-wrapper">

        <main class="main">
            <div class="intro-section bg-lighter pt-5 pb-6">
                <div class="container">
                    @if($banners)
                        <div class="row g-3">
                            <div class="col-lg-8">
                                <div class="swiper main-swiper h-80">
                                    <div class="swiper-wrapper">
                                        @foreach($banners as $banner)
                                            <div class="swiper-slide" style="position: relative;">
                                                @if($banner->photos)
                                                    <img src="{{ asset('storage/' . $banner->photos->path) }}"
                                                         class="w-100 object-fit-cover" style="height:580px"
                                                         alt="Slide">
                                                @endif

                                                <!-- Блок с текстом -->
                                                <div class="slide-content" style="
                                                                                position: absolute;
                                                                                top: 28%;
                                                                                left: 65%;
                                                                                width:100%;
                                                                                transform: translate(-50%, 50%);">
                                                    <h2>{{ $banner->title ?? 'Заголовок слайда' }}</h2>
                                                    <p style="margin:30px 0">{{ $banner->description ?? 'Описание слайда' }}</p>
                                                    <a href="{{ $banner->link ?? '#' }}" class="btn btn-primary">
                                                        {{ $banner->button_text ?? 'Подробнее' }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="d-flex flex-column h-80">
                                    <div class="row g-3">

                                        @if($features)
                                            @foreach($features as $feature)
                                                <div class="col-12 mb-1" style="height: calc(33.333% - 0.5rem);">
                                                    <div class="banner position-relative h-100">
                                                        @if($feature->photos)
                                                            <img src="{{ asset('storage/' .  $feature->photos->path) }}"
                                                                 class="w-100 object-fit-cover rounded" alt=""
                                                                 style="height: 275px">
                                                        @endif
                                                        <div
                                                            class="banner-content position-absolute top-50 start-0 translate-middle-y p-4 text-white">
                                                            <h4 class="banner-subtitle text-uppercase mb-1">
                                                                Clearance</h4>
                                                            <h3 class="banner-title h5 mb-3">Chairs & Chaises<br>Up to
                                                                40%
                                                                off
                                                            </h3>
                                                            <a href="#" class="btn btn-outline-light btn-sm">Shop
                                                                Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Swiper настройки -->
                    <div class="swiper brand-swapper mt-6">
                        <div class="swiper-wrapper">
                            @foreach($brands as $brand)
                                <div class="swiper-slide">
                                    <a href="{{$brand->name}}" class=" brand" style="width: 100px; height:100px">
                                        @if($brand->photos)
                                            <img src="{{ asset('storage/' . $brand->photos->path) }}"
                                                 alt="{{$brand->name}}">
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div><!-- End .container -->


            </div><!-- End .bg-lighter -->

            <div class="mb-6"></div><!-- End .mb-6 -->

            <div class="container categories pt-6">
                <h2 class="title-lg text-center mb-4">Shop by Categories</h2><!-- End .title-lg text-center -->
                <div class="swiper category-swapper mt-6">
                    <div class="swiper-wrapper">
                        @foreach($categories as $category)
                            <div class="swiper-slide">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body text-center bg-dark text-white p-4">
                                        <h5>
                                            <a href=""
                                               class="text-white text-decoration-none">{{ __($category->name) }}</a>
                                        </h5>
                                        <p class="card-text">{{ __($category->description) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div><!-- End .container -->

            <div class="mb-5"></div><!-- End .mb-6 -->

            <div class="container">
                <div class="heading heading-center mb-6">
                    <h2 class="title">Category with products</h2>

                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab"
                               role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                        </li>
                        @foreach($categoryProduct as $category)
                            <li class="nav-item">
                                <a class="nav-link" id="category-{{ $category->id }}-link" data-toggle="tab"
                                   href="#category-{{ $category->id }}-tab" role="tab"
                                   aria-controls="category-{{ $category->id }}-tab" aria-selected="false">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="tab-content">
                    <!-- Вкладка для всех категорий -->
                    <div class="tab-pane fade show active" id="top-all-tab" role="tabpanel"
                         aria-labelledby="top-all-link">
                        <div class="products">
                            <div class="row justify-content-center">
                                @foreach($categoryProduct as $category)
                                    @foreach($category->products as $product)
                                        @include('front-end.templates.product-card', ['product' => $product])
                                    @endforeach
                                    @foreach($category->children as $childCategory)
                                        @foreach($childCategory->products as $product)
                                            @include('front-end.templates.product-card', ['product' => $product])
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Вкладки для каждой категории -->
                    @foreach($categoryProduct as $category)
                        <div class="tab-pane fade" id="category-{{ $category->id }}-tab" role="tabpanel"
                             aria-labelledby="category-{{ $category->id }}-link">
                            <div class="products">
                                <div class="row justify-content-center">
                                    @foreach($category->products as $product)
                                        @include('front-end.templates.product-card', ['product' => $product])
                                    @endforeach
                                    @foreach($category->children as $childCategory)
                                        @foreach($childCategory->products as $product)
                                            @include('front-end.templates.product-card', ['product' => $product])
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <!-- End .container -->

        </main><!-- End .main -->

        <footer class="footer footer-dark">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="widget widget-about">
                                <img src="{{asset('frontend/assets/images/logo-footer.png')}}}" alt=""
                                     class="footer-logo" width="105" height="25">

                                <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate
                                    magna eros eu erat. </p>

                                <div class="social-icons">
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                            class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                            class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                            class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Youtube" target="_blank"><i
                                            class="icon-youtube"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                            class="icon-pinterest"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="about.html">About Molla</a></li>
                                    <li><a href="#">How to shop on Molla</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                    <li><a href="login.html">Log in</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">Payment Methods</a></li>
                                    <li><a href="#">Money-back guarantee!</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Terms and conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">Sign In</a></li>
                                    <li><a href="cart.html">View Cart</a></li>
                                    <li><a href="#">My Wishlist</a></li>
                                    <li><a href="#">Track My Order</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->

            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">Copyright © 2019 Molla Store. All Rights Reserved.</p>
                    <!-- End .footer-copyright -->
                    <figure class="footer-payments">
                        <img src="{{asset('frontend/assets/images/payments.png')}}" alt="Payment methods" width="272"
                             height="20">
                    </figure><!-- End .footer-payments -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    @section('script')

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                new Swiper('.main-swiper', {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    }
                });

                new Swiper(".brand-swapper", {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                    },
                    slidesPerView: 5,
                    slidesPerGroup: 1,
                    spaceBetween: 20,
                    breakpoints: {
                        768: {
                            slidesPerView: 3,
                        },
                        480: {
                            slidesPerView: 2,
                        },
                        320: {
                            slidesPerView: 1,
                        }
                    }
                });

                new Swiper(".category-swapper", {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    slidesPerView: 4,
                    slidesPerGroup: 1,
                    spaceBetween: 20,
                    breakpoints: {
                        1024: {
                            slidesPerView: 4,
                        },
                        768: {
                            slidesPerView: 3,
                        },
                        480: {
                            slidesPerView: 2,
                            320: {
                                slidesPerView: 1,
                            },
                        }
                    }
                });

            })

        </script>

    @endsection
</x-front-layout>
