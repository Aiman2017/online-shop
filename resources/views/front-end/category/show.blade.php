<x-front-layout title="{{ $title }}">


    <div class="container">
        <!-- Секция отображения всех категорий -->
        <div class="categories mb-5">
            <nav>
                <h4> category {{ $title }}</h4>
            </nav>
            <div class="row justify-content-center mt-4">
                @foreach($category as $cat)
                    <a href="{{route('shop.category.show', $cat->slug)}}">
                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                            <div class="card category-card h-100 shadow-sm border-0 text-center">
                                <img src="https://picsum.photos/500/150"
                                     alt=""
                                     class="card-img-top rounded-top"
                                     style="height: 120px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $cat->name }}</h5>
                                    <p class="card-text text-muted">
                                        {{ $cat->description ?? 'No description available' }}
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <a href=""
                                       class="btn btn-primary btn-sm">
                                        View More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>

        <h4> Продукты у {{ $title }}</h4>
        <!-- Конец секции категорий -->
        <div class="products mb-3">
            <div class="row justify-content-center">
                @foreach($products as $product)

                    <div class="col-6 col-md-4 col-lg-4">
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <span class="product-label label-new">{{ $product->name }}</span>
                                <a href="{{route('shop.products')}}">
                                    @if($product->photos->isNotEmpty())
                                        <img style="width:150px; height:122px"
                                             src="{{ asset('storage/' . $product->photos->first()->path) }}"
                                             alt="{{ $product->name }}"
                                             class="product-image"/>

                                    @else
                                        <img src="https://picsum.photos/500/150"
                                             alt="{{ $product->name }}"
                                             class="product-image"/>
                                    @endif
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>Добавить в избранное</span></a>
                                    <a href="popup/quickView.html"
                                       class="btn-product-icon btn-quickview"
                                       title="Быстрый просмотр"><span>Быстрый просмотр</span></a>
                                    <a href="#" class="btn-product-icon btn-compare"
                                       title="Сравнить"><span>Сравнить</span></a>
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <a href="#"
                                       class="btn-product btn-cart"><span>Добавить в корзину</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="{{ route('shop.category.show', $product->category->slug) }}">{{ $product->category->name }}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title">
                                    <a href="">{{ $product->name }}</a>
                                </h3><!-- End .product-title -->
                                <div class="product-price">
                                    {{ number_format($product->price, 2, '.', ' ') }} ₽
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( отзывов)</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-thumbs">
                                    {{-- Вывод миниатюр, если потребуется --}}
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div>
                @endforeach
            </div>
            <!-- End .row -->
        </div><!-- End .products -->


    </div>
</x-front-layout>
