<x-front-layout title={{$title}}>
    <main class="main">
        <div class="page-header text-center"
             style="background-image: url({{asset('frontend/assets/images/page-header-bg.jpg')}})">
            <div class="container">
                <h1 class="page-title">{{__('Products')}}<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('shop.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('product')}}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">

                                    Showing
                                    {{count($products)}}
                                    {{--                                to--}}

                                    {{--                                @if (($products->currentPage() * $products->perPage()) > $products->total())--}}
                                    {{--                                    {{$products->total()}}--}}
                                    {{--                                @else--}}
                                    {{--                                    {{$products->currentPage() * $products->perPage()}}--}}
                                    {{--                                @endif--}}
                                    of {{$products->total()}} products


                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div><!-- End .toolbox-sort -->
                                <!-- End .toolbox-layout -->
                            </div><!-- End .toolbox-right -->
                        </div><!-- End .toolbox -->

                        <div class="products mb-3">
                            {{$products->withQueryString()->links()}}
                            <div class="row justify-content-center">
                                @foreach($products as $product)
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-new">{{$product->name}}</span>
                                                <a href="">
                                                    <img
                                                        src="{{asset('frontend/assets/images/products/product-4.jpg')}}"
                                                        alt="Product image"
                                                        class="product-image">
                                                </a>
                                                <form action="{{route('shop.wishlist.store')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <div class="product-action-vertical">
                                                        <button type="submit"
                                                                class="btn-product-icon btn-wishlist btn-expandable">
                                                            <span>add to wishlist</span></button>
                                                        <a href=""
                                                           class="btn-product-icon btn-quickview"
                                                           title="Quick view"><span>Quick view</span></a>
                                                        <a href="#" class="btn-product-icon btn-compare"
                                                           title="Compare"><span>Compare</span></a>
                                                    </div><!-- End .product-action-vertical -->
                                                </form>

                                                <form action="{{route('shop.cart.store')}}" method="POST"
                                                      class="mt-auto">
                                                    <div class="product-action">

                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                               value="{{ $product->id }}">
                                                        <button type="submit" class="btn btn-primary w-100">
                                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                                        </button>
                                                    </div><!-- End .product-action -->
                                                </form>

                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="{{route('shop.category.show', $product->category->slug)}}">{{$product->category->name}}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="">{{$product->name}}</a></h3>
                                                <!-- End .product-title -->
                                                <div class="product-price">
                                                    {{$product->price}}
                                                </div><!-- End .product-price -->
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 20%;"></div>
                                                        <!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                    <span class="ratings-text">( 2 Reviews )</span>
                                                </div><!-- End .rating-container -->

                                                <div class="product-nav product-nav-thumbs">
                                                    <a href="#" class="active">
                                                        <img
                                                            src="{{asset('frontend/assets/images/products/product-4-thumb.jpg')}}"
                                                            alt="product desc">
                                                    </a>
                                                    <a href="#">
                                                        <img
                                                            src="{{asset('frontend/assets/images/products/product-4-2-thumb.jpg')}}"
                                                            alt="product desc">
                                                    </a>

                                                    <a href="#">
                                                        <img
                                                            src="{{asset('frontend/assets/images/products/product-4-3-thumb.jpg')}}"
                                                            alt="product desc">
                                                    </a>
                                                </div><!-- End .product-nav -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div>
                                @endforeach
                                <!-- End .col-sm-6 col-lg-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .products -->

                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="{{ route('shop.products') }}">Clean All</a>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                       aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3><!-- End .widget-title -->

                                <form action="{{route('shop.products')}}" method="GET">
                                    <div class="collapse show" id="widget-1">
                                        <div class="widget-body">
                                            <div class="filter-items filter-items-count">
                                                @foreach($categories as $category)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="cat-{{$category->id}}" name="categories[]"
                                                                   @checked(in_array($category->name, $data['categories'] ?? []))
                                                                   value="{{$category->name}}">
                                                            <label class="custom-control-label"
                                                                   for="cat-{{$category->id}}">
                                                                {{$category->name}}
                                                            </label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
                                                    <div class="child-categories" style="margin-left: 20px;">
                                                        @include('front-end.templates.checkbox-children', ['children' => $category->children])
                                                    </div>
                                                @endforeach

                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->

                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-2" role="button"
                                               aria-expanded="true"
                                               aria-controls="widget-2">
                                                Size
                                            </a>
                                        </h3><!-- End .widget-title -->

                                        <div class="collapse show" id="widget-2">
                                            <div class="widget-body">
                                                <div class="filter-items">
                                                    @foreach($sizes as $size)
                                                        <div class="filter-item">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="sizes[]"
                                                                       @checked(in_array($size->name, $data['sizes'] ?? []))
                                                                       value="{{$size->name}}"
                                                                       class="custom-control-input"
                                                                       id="size-{{$size->id}}">
                                                                <label class="custom-control-label"
                                                                       for="size-{{$size->id}}">{{$size->name}}</label>
                                                            </div><!-- End .custom-checkbox -->
                                                        </div><!-- End .filter-item -->

                                                    @endforeach
                                                </div><!-- End .filter-items -->
                                            </div><!-- End .widget-body -->
                                        </div><!-- End .collapse -->
                                    </div>

                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-3" role="button"
                                               aria-expanded="true" aria-controls="widget-3">
                                                Colour
                                            </a>
                                        </h3>
                                        <style>
                                            /* Стили для выбранного состояния */
                                            input[type="checkbox"]:checked + .span-border {
                                                border: 1px solid #1c1616;
                                            }
                                        </style>
                                        <div class="collapse show" id="widget-3">
                                            <div class="widget-body">
                                                <div class="filter-colors">
                                                    @foreach($colors as $color)
                                                        <label
                                                            style="cursor: pointer; margin-right: 10px; display: inline-block;">
                                                            <!-- Скрытый чекбокс -->
                                                            <input type="checkbox" name="colors[]"
                                                                   @checked(in_array($color->name, $data['colors'] ?? []))
                                                                   value="{{$color->name}}" style="display: none;">
                                                            <span class="span-border" style="
                                                                display: inline-block;
                                                                width: 30px;
                                                                height: 30px;
                                                                background: {{$color->name}};
                                                                border-radius: 50%;
                                                                transition: all 0.3s ease;
                                                            "></span>
                                                        </label>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-4" role="button"
                                               aria-expanded="true"
                                               aria-controls="widget-4">
                                                Brand
                                            </a>
                                        </h3><!-- End .widget-title -->

                                        <div class="collapse show" id="widget-4">
                                            <div class="widget-body">
                                                <div class="filter-items">
                                                    @foreach($brands as $brand)
                                                        <div class="filter-item">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="brands[]"
                                                                       @checked(in_array($brand->name, $data['brands'] ?? []))
                                                                       value="{{$brand->name}}"
                                                                       class="custom-control-input"
                                                                       id="brand-{{$brand->id}}">
                                                                <label class="custom-control-label"
                                                                       for="brand-{{$brand->id}}">{{$brand->name}}</label>
                                                            </div><!-- End .custom-checkbox -->
                                                        </div>
                                                    @endforeach
                                                </div><!-- End .filter-items -->
                                            </div><!-- End .widget-body -->
                                        </div><!-- End .collapse -->
                                    </div>

                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-5" role="button"
                                               aria-expanded="true" aria-controls="widget-5">
                                                Price
                                            </a>
                                        </h3><!-- End .widget-title -->

                                        <div class="collapse show" id="widget-5">
                                            <div class="widget-body">
                                                <div class="filter-price">
                                                    <div class="mt-3">
                                                        <div class="form-row">
                                                            <div class="col-6">
                                                                <label for="min-price" class="form-label">Min
                                                                    Price</label>
                                                                <input type="number" name="min_price"
                                                                       value="{{$data['min_price'] ?? '100'}}"
                                                                       class="form-control" id="min-price"
                                                                       placeholder="Min Price" min="0">
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="max-price" class="form-label">Max
                                                                    Price</label>
                                                                <input type="number" name="max_price"
                                                                       value="{{$data['max_price'] ?? '3000'}}"
                                                                       class="form-control" id="max-price"
                                                                       placeholder="Max Price">
                                                            </div>
                                                        </div>
                                                    </div><!-- End .mt-3 -->
                                                </div><!-- End .filter-price -->
                                            </div><!-- End .widget-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .widget -->

                                    <button class="btn btn-primary" type="submit">Search</button>
                                </form>
                            </div><!-- End .widget -->
                            <!-- End .widget -->
                        </div><!-- End .sidebar sidebar-shop -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
</x-front-layout>
