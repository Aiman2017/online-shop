<x-admin-layout title="{{ __($title) }}">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Список Brands</h1>
                        <a href="{{route('admin.brands.create')}}" class="btn btn-primary">{{__('Create brand')}}</a>
                    </div>


                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Описание</th>
                            <th scope="col">status</th>
                            <th scope="col">Изображение</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$brands->isEmpty())
                            @foreach($brands as $key => $brand)
                                <tr>
                                    <td>{{  $key + 1  }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->description }}</td>
                                    <td>{!! $brand->status ? "<a href='#' class='btn btn-primary'>Active</a>" : "<a href='#' class='btn btn-warning'>inactive</a>" !!}</td>
                                    <td>
                                        @if($brand->photos)
                                            <img src="{{ asset('storage/' . $brand->photos->path) }}" alt="{{ $brand->name }}" width="50" height="50">
                                        @else
                                            <span>Нет изображения</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5"><em>No Brands found</em></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $brands->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
