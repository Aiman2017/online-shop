<x-front-layout title="{{ $title }}">


    <div class="container">
        <!-- Секция отображения всех категорий -->
        <div class="categories mb-5">
            <nav>
                <h4> All Category {{ $title }}</h4>
            </nav>
            <div class="row justify-content-center mt-4">
                @foreach($categories as $cat)
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
    </div>
</x-front-layout>
