<x-admin-layout title="{{$title}}">
    <div class="main-wrapper bg-dark text-light">
        <div class="page-wrapper">
            <div class="page-content">
                <!-- Page Title and Return Button -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="mb-0">{{ __('Create Brand') }} | Page</h2>
                    <a class="btn btn-primary" href="{{ route('admin.brands.index') }}">
                        <i class="fas fa-arrow-left me-2"></i> Return Back
                    </a>
                </div>
                <!-- Create New Brand Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('admin.components.errors')
                        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Brand Details Section -->
                            <div class="form-group mb-4 mt-1">
                                <label for="brandName" class="form-label">Brand Name</label>
                                <input type="text" name="name" id="brandName"
                                       class="form-control" placeholder="Enter brand name" >
                            </div>

                            <div class="form-group mb-4">
                                <label for="brandDescription" class="form-label">Description</label>
                                <textarea name="description" id="brandDescription" rows="3"
                                          class="form-control" placeholder="Enter brand description" ></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="brandPhoto" class="form-label">Brand Photo</label>
                                <input type="file" name="photo" id="brandPhoto"
                                       class="form-control" accept="image/*" >
                            </div>

                            <!-- Active Status Section -->
                            <div class="form-group mb-4">
                                <label for="brandActive" class="form-label">Status</label>
                                <input type="checkbox" name="status" id="brandActive" class="form-check-input" value="1" checked>
                                <br>
                                <small class="form-check-label">Check if the brand is active</small>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Create Brand
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
