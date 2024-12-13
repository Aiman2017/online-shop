<x-admin-layout title="{{$title}}">
    <div class="main-wrapper bg-dark text-light">
        <div class="page-wrapper">
            <div class="page-content">
                <!-- Page Title and Return Button -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="mb-0">{{ __('Create Category') }} | Page</h2>
                    <a class="btn btn-primary" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-arrow-left me-2"></i> Return Back
                    </a>
                </div>
                <!-- Create New Category Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('admin.components.errors')
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <!-- Category Details Section -->
                            <div class="form-group mb-4 mt-1">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" name="name" id="categoryName"
                                       class="form-control" placeholder="Enter category name">
                            </div>

                            <div class="form-group mb-4">
                                <label for="categoryDescription" class="form-label">Description</label>
                                <textarea name="description" id="categoryDescription" rows="3"
                                          class="form-control" placeholder="Enter category description"></textarea>
                            </div>

                            <!-- Subcategories Section -->
                            <div class="form-group mb-4">
                                <label for="parent_id" class="form-label">Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">{{__('select--category')}}</option>
                                    @foreach($categories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Create Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
