<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">Usd</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Eur</a></li>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->

                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                            <li><a href="wishlist.html"><i class="icon-heart-o"></i>My Wishlist <span>(3)</span></a>
                            </li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            @auth
                                <li><a href="#signin-modal" data-toggle="modal"><i
                                            class="icon-user"></i>{{auth()->user()->name}}</a>
                                </li>
                            @endauth

                            @guest
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a>
                                </li>
                            @endguest

                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{route('shop.home')}}" class="logo">
                    <img src="{{asset('frontend/assets/images/logo.png')}}" alt="Molla Logo" width="105"
                         height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li>
                            <a href="{{route('shop.category')}}" class="sf-with-ul">Categories</a>
                            <div class="megamenu megamenu-sm">
                                <div class="row no-gutters">
                                    @foreach ($categories as $category)
                                        <div class="col-md-4">
                                            <div class="menu-col">
                                                <div class="menu-title">

                                                    <a href="{{route('shop.category.show', $category->slug)}}">{{ $category->name }}</a>
                                                </div>
                                                @if ($category->children->isNotEmpty())
                                                    <ul>
                                                        <li>
                                                            @include('front-end.templates.category-submenu', ['children' => $category->children])
                                                        </li>
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li><a href="{{route('shop.products')}}">Product</a></li>
                    </ul>
                    </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i
                            class="icon-search"></i></a>
                    <form action="{{ route('shop.products') }}" method="get">

                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" value="{{ request('search') }}" name="search"
                                   id="q" placeholder="Search in..."
                            >
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">{{count($carts)}}</span>
                    </a>

                    @include('front-end.cart.cart')
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header>
