<x-admin-layout title="{{ __('Список Баннеров') }}">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Список Баннеров</h1>
                        <a href="{{ route('admin.banners.create') }}"
                           class="btn btn-primary">{{ __('Создать Баннер') }}</a>
                    </div>
                    @include('admin.components._messages')

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Ссылка</th>
                            <th scope="col">featured</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($banners->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center"><em>Нет баннеров</em></td>
                            </tr>
                        @else
                            @foreach($banners as $key => $banner)
                                <tr>
                                    <td>{{ $banners->firstItem() + $key }}</td>
                                    <td>{{ $banner->title }}</td>
                                    <td><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></td>
                                    <td>{!! $banner->is_featured ? "<span class='badge bg-success'>Да</span>" : "<span class='badge bg-secondary'>Нет</span>" !!}</td>
                                    <td>
                                        <a href="{{ route('admin.banners.show', $banner->id) }}"
                                           class="btn btn-sm btn-warning">Details</a>
                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Вы уверены?')">Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        {{ $banners->withQueryString()->links() }}

                    </table>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
