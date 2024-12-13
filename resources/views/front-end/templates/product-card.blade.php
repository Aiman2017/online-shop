<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-11 mt-v3 text-center">
        <figure class="product-media">

            <a href="#">
                <img src="https://picsum.photos/500/150"
                     alt="{{ $product->name }}" class="product-image">
            </a>

        </figure>

        <div class="product-body">
            <h3 class="product-title">
                <a href="#">{{ $product->name }}</a>
            </h3>
            <div class="product-price">
                ${{ $product->price }}
            </div>
        </div>

        <div class="product-action">
            <a href="#" class="btn-product btn-cart">
                <span>Add to cart</span>
            </a>
        </div>
    </div>
</div>
