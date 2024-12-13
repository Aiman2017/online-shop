<x-admin-layout title="{{ __($title) }}">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Список Продуктов</h1>
                        <a href="{{ route('admin.products.create') }}"
                           class="btn btn-primary">{{ __('Create product') }}</a>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Подкатегория</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$products->isEmpty())
                            @foreach($products as $key => $product)

                                <tr>
                                    <td>{{$products->firstItem() + $key }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                           class="btn btn-sm btn-warning">Редактировать</a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Вы уверены?')">Удалить
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                           class="btn btn-sm btn-warning">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center"><em>No Products found</em></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
