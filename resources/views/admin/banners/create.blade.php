<x-admin-layout title="{{ $title }}">
    <div class="main-wrapper bg-dark text-light">
        <div class="page-wrapper">
            <div class="page-content">
                <!-- Page Title and Return Button -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="mb-0">{{ __('Создать Баннер') }}</h2>
                    <a class="btn btn-primary" href="{{ route('admin.banners.index') }}">
                        <i class="fas fa-arrow-left me-2"></i> Вернуться назад
                    </a>
                </div>
                <!-- Create New Banner Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('admin.components.errors')
                        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Banner Details Section -->
                            <div class="form-group mb-4 mt-1">
                                <label for="bannerTitle" class="form-label">Заголовок</label>
                                <input type="text" name="title" id="bannerTitle"
                                       class="form-control" placeholder="Введите заголовок баннера" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="bannerSubtitle" class="form-label">Подзаголовок</label>
                                <input type="text" name="subtitle" id="bannerSubtitle"
                                       class="form-control" placeholder="Введите подзаголовок баннера">
                            </div>

                            <div class="form-group mb-4">
                                <label for="bannerLink" class="form-label">Ссылка</label>
                                <input type="url" name="link" id="bannerLink"
                                       class="form-control" placeholder="Введите ссылку" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="bannerDescription" class="form-label">Описание</label>
                                <textarea name="description" id="bannerDescription" rows="3"
                                          class="form-control" placeholder="Введите описание баннера"></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="bannerPhoto" class="form-label">Фото Баннера</label>
                                <input type="file" name="photo" id="bannerPhoto"
                                       class="form-control" accept="image/*">
                            </div>

                            <!-- Featured Status Section -->
                            <div class="form-group mb-4">
                                <label for="bannerFeatured" class="form-label">Выделенный</label>
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" id="bannerFeatured" class="form-check-input"
                                       value="1" {{ old('is_featured', 0) ? 'checked' : '' }}>
                                <br>
                                <small class="form-check-label">Отметьте, если баннер является выделенным</small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="status" class="form-label">Status</label>
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" id="status"
                                       class="form-check-input" value="1" {{ old('status', 0) ? 'checked' : '' }}>
                                <br>
                                <small class="form-check-label">Отметьте, если нужно </small>
                            </div>


                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Создать Баннер
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
