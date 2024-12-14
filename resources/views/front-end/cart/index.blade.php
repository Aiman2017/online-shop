<x-front-layout title="Cart Page">
    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($carts->isNotEmpty())
                                @foreach($carts as $cart)
                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="assets/images/products/table/product-1.jpg"
                                                             alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="#">{{$cart->product->name}}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">{{$cart->product->price}}</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input type="number" class="form-control" name="quantity"
                                                       value="{{$cart->quantity}}" min="1" max="10"
                                                       step="1" data-decimals="0">
                                            </div><!-- End .cart-product-quantity -->
                                        </td>

                                        <td class="total-col">{{$cart->quantity * $cart->product->price}}</td>
                                        <td class="remove-col">
                                            <form action="{{route('shop.cart.destroy', $cart->uuid)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove"><i class="icon-close"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart-discount">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" required="" placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit"><i
                                                    class="icon-long-arrow-right"></i></button>
                                        </div><!-- .End .input-group-append -->
                                    </div><!-- End .input-group -->
                                </form>
                            </div><!-- End .cart-discount -->

                            <form action="{{ route('shop.cart.clear') }}" method="POST"
                                  onsubmit="return confirm('Are you sure, you want delete tbe cart')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <span>CLEAR CART</span>
                                </button>
                            </form>
                        </div><!-- End .cart-bottom -->

                        <!-- Кнопка для очистки корзины -->


                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td>{{$total}}</td>
                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-shipping">
                                    <td>Shipping:</td>
                                    <td>&nbsp;</td>
                                </tr>

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="free-shipping" name="shipping"
                                                   class="custom-control-input">
                                            <label class="custom-control-label" for="free-shipping">Free
                                                Shipping</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$0.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="standart-shipping" name="shipping"
                                                   class="custom-control-input">
                                            <label class="custom-control-label"
                                                   for="standart-shipping">Standart:</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$10.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="express-shipping" name="shipping"
                                                   class="custom-control-input">
                                            <label class="custom-control-label" for="express-shipping">Express:</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$20.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-estimate">
                                    <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                    <td>&nbsp;</td>
                                </tr><!-- End .summary-shipping-estimate -->

                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td>$160.00</td>
                                </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <a href="checkout.html" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO
                                CHECKOUT</a>
                        </div><!-- End .summary -->

                        <a href="category.html"
                           class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i
                                class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div>
</x-front-layout>
