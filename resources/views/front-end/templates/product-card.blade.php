<div class="col-6 col-md-4 col-lg-3">
    <div class="card shadow-sm border-0 h-100 text-center">
        <!-- Product Image -->
        <div class="card-img-top position-relative">
            {{--            TODO ADD SHOW FOR PRODUCTS--}}
            <a href="#" class="d-block">
                <img src="https://picsum.photos/500/150"
                     alt="{{ $product->name }}"
                     class="img-fluid rounded-top">
            </a>
        </div>
        <!-- Product Body -->
        <div class="card-body">
            <h5 class="mb-2">
                {{--                todo add show product --}}
                <a href="" class="text-dark text-decoration-none">{{ $product->name }}</a>
            </h5>
            <p class="card-text text-muted fw-bold">${{ $product->price }}</p>
        </div>
        <!-- Add to Cart Form -->
        <div class="card-footer bg-white border-0">
            <form action="{{ route('shop.cart.store') }}" method="POST" class="d-flex flex-column align-items-center">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <div class="mb-2 w-75">
                    <input type="number" name="quantity" placeholder="Quantity"
                           class="form-control form-control-sm text-center"
                    >
                </div>
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
