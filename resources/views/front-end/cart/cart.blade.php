<div class="dropdown-menu dropdown-menu-right">
    @if($carts->isNotEmpty())
        <div class="dropdown-cart-products">
            @foreach($carts as $cart)
                <div class="product">
                    <div class="product-cart-details">
                        <h4 class="product-title">
                            <a href="product.html">{{$cart->product->name}}</a>
                        </h4>

                        <span class="cart-product-info">
                                                <span class="cart-product-qty">{{$cart->quantity}}</span>
                                                x {{$cart->product->price}}
                                            </span>
                    </div><!-- End .product-cart-details -->

                    <figure class="product-image-container">
                        <a href="product.html" class="product-image">
                            <img src="assets/images/products/cart/product-1.jpg')}}" alt="product">
                        </a>
                    </figure>
                    <form action="{{route('shop.cart.destroy', $cart->uuid)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove" title="Remove Product"><i class="icon-close"></i>
                        </button>

                    </form>
                </div><!-- End .product -->
            @endforeach
        </div><!-- End .cart-product -->

        <div class="dropdown-cart-total">
            <span>Total</span>

            <span class="cart-total-price">{{$total}}</span>
        </div><!-- End .dropdown-cart-total -->

        <div class="dropdown-cart-action">
            <a href="{{route('shop.cart.index')}}" class="btn btn-primary">View Cart</a>
            <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i
                    class="icon-long-arrow-right"></i></a>
        </div><!-- End .dropdown-cart-total -->

    @else
        <div class="d-flex flex-column align-items-center">
            <p class="text-muted"><em><b>Your cart is empty</b></em></p>
            <img src="{{ asset('frontend/assets/images/empty-card.png') }}"
                 alt="Empty Cart"
                 class="img-fluid mb-2"
                 style="width: 70px;">

            <a href="{{ route('shop.products') }}" class="btn btn-primary btn-sm">
                Continue Shopping
            </a>
        </div>

    @endif
</div>
