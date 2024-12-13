<x-admin-layout title="{{ __($product->name) }}">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container mt-5">
                    <!-- Header Section -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="display-4">{{ $product->name }}</h1>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Назад к списку
                        </a>
                    </div>

                    @include('admin.components._messages')

                    <!-- Product Information Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Информация о продукте</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Описание</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Бренд</th>
                                        <td>{{ $product->brand ? $product->brand->name : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Категория</th>
                                        <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Product Variants Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Варианты продукта</h5>
                        </div>
                        <div class="card-body">
                            @if($product->variants->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Цвет</th>
                                            <th>Размер</th>
                                            <th>CODE</th>
                                            <th>Количество на складе</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->variants as $variant)
                                            <tr class="hover-row">
                                                <td>{{ $variant->color ? $variant->color->name : 'N/A' }}</td>
                                                <td>{{ $variant->size ? $variant->size->name : 'N/A' }}</td>
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $variant->stock }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-bloc">
                                        @if($product->photos->isNotEmpty())
                                            <div class="d-flex">
                                                <div class="my-3 me-3">
                                                    <form
                                                        action="{{ route('admin.images.delete.all', ['images' => 'product', 'id' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Are you sure for delete all the images?')"
                                                            class="btn btn-danger" type="submit">
                                                            <i class="fa-solid fa-trash me-2"></i>Delete all
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="my-3">
                                                    <form
                                                        action="{{ route('admin.images.download.all', ['images' => 'product', 'id' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button
                                                            class="btn btn-primary" type="submit">
                                                            <i class="fa-solid fa-download me-2"></i>Download
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="d-flex flex-wrap">
                                            @foreach($product->photos as $photo)
                                                <div class="p-1 sortable-item"
                                                     style="flex: 0 0 300px; position: relative;"
                                                     data-photo-id="{{ $photo->id }}">

                                                    <form action="{{ route('admin.images.delete', $photo->id) }}"
                                                          method="POST"
                                                          style="position: absolute; top: 10px; left: 10px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Are you sure?')" type="submit"
                                                                class="btn btn-danger"
                                                                style="padding: 5px 10px; font-size: 12px; display: flex; align-items: center; opacity:0.7">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>

                                                    <div class="sortable_image">
                                                        <img id="{{$photo->id}}" class="img-fluid sortable_image"
                                                             src="{{ asset('storage/' . $photo->path) }}"
                                                             alt="{{$product->name}}"
                                                             style="max-width: 300px; width: 100%; height: 200px; object-fit: cover;">

                                                        <!-- Download Button Overlay with Arrow Icon -->
                                                        <a href="{{ asset('storage/' . $photo->path) }}"
                                                           download="{{ basename($photo->path) }}"
                                                           class="btn btn-primary"
                                                           style="position: absolute; top: 10px; right: 10px; z-index: 10; opacity:0.7; padding: 5px 10px; font-size: 12px; display: flex; align-items: center;">
                                                            <i class="fa-solid fa-down-long"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            @else
                                <p class="text-center"><em>Нет доступных вариантов для этого продукта.</em></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $(document).ready(function () {
                $(".sortable-item").parent().sortable({
                    update: function (e, i) {
                        let photo_ids = [];
                        $('.sortable-item').each(function () {
                            let id = $(this).data('photo-id');
                            photo_ids.push(id);
                        })

                        $.ajax({
                            type: "PUT",
                            url: "{{url('admin/sortable')}}",
                            data: {
                                "photo_ids": photo_ids,
                                "_token": "{{csrf_token()}}",
                            },
                            dataType: "json",
                            success: function (data) {
                                console.log(data)
                            },
                            error: function (data) {

                            }
                        })

                    }
                });
            });
        </script>
    @endsection
</x-admin-layout>
