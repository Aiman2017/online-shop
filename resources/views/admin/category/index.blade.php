<x-admin-layout title="{{__($title)}}">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Список категорий</h1>
                        <a href="{{route('admin.categories.create')}}"
                           class="btn btn-primary">{{__('Create Category')}}</a>
                    </div>
                    @include('admin.components._messages')
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
                        @if(!$categories->isEmpty())
                            @foreach($categories as $key => $category)
                                <tr>
                                    <td>{{  $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->parent_id ? $category->parent->name : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                           class="btn btn-sm btn-warning">Редактировать</a>
                                        <a href="{{ route('admin.categories.show', $category->id) }}"
                                           class="btn btn-sm btn-warning">Details</a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Вы уверены?')">Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center"><em>No categories found</em></td>
                            </tr>
                        @endif
                        </tbody>

                    </table>
                    {{ $categories->withQueryString()->links() }}

                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
