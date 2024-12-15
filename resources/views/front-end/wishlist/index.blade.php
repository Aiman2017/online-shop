<x-front-layout title="{{ $title }}">
    <div class="page-content">
        <div class="container my-5">
            <h1 class="text-center mb-4">My Wishlist</h1>

            @if($wishlists->isEmpty())
                <div class="alert alert-info text-center">
                    Your wishlist is currently empty. Add some products to your wishlist!
                </div>
            @else
                <div class="row">
                    @foreach($wishlists as $wishlist)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/200" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{$wishlist->product->name}}</h5>
                                    <p class="card-text">{{$wishlist->product->price}}</p>
                                    <form action="{{route('shop.wishlist.destroy', $wishlist->uuid)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100 mb-2">Remove</button>
                                    </form>
                                    <form action="{{route('shop.cart.store')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$wishlist->product->id}}">
                                        <button type="submit" class="btn btn-primary btn-sm w-100">Move to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-front-layout>
