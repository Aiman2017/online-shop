<x-admin-layout title="{{ __($title) }}">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="page-content m-0">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="display-4">{{ $banner->name }}</h1>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Назад к списку
                        </a>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Информация о баннере</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Описание</th>
                                        <td>{{ $banner->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>link</th>
                                        <td><a href="{{$banner->link}}">Go to</a></td>
                                    </tr>
                                    <tr>
                                        <th>is featured</th>
                                        <td><span class="{{$banner->is_featured ? 'text-success' : 'text-danger'}}">
                                                {{ $banner->is_featured ? 'Да' : 'нет' }}
                                            </span></td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>

                                        <td>
                                            <span
                                                class="{{ $banner->status ? 'text-success' : 'text-danger' }}">
                                                 {{ $banner->status ? 'Активный' : 'Неактивный' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Дата создания</th>
                                        <td>{{ $banner->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Фото</th>
                                        <td>
                                            @if($banner->photos && !empty($banner->photos))
                                                <div class="d-flex">
                                                    <img style="width:70px; height:70px"
                                                         src="{{ asset('storage/' . $banner->photos->path) }}"
                                                         alt="{{ $banner->name }}" class=" me-2">
                                                </div>
                                            @else
                                                <span>Нет изображений</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
