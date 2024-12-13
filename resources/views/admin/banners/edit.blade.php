<x-admin-layout title="{{$title}}">
    <div class="main-wrapper bg-dark text-light">
        <div class="page-wrapper">
            <div class="page-content">
                <!-- Page Title and Return Button -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="mb-0">{{ __($title) }} | Page</h2>
                    <a class="btn btn-primary" href="{{ route('admin.brands.index') }}">
                        <i class="fas fa-arrow-left me-2"></i> Return Back
                    </a>
                </div>

                <!-- Create New Category Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('admin.components.errors')
                        <form action="{{ route('admin.brands.update', $brand->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Category Details Section -->
                            <div class="form-group mb-4 mt-1">
                                <label for="categoryName" class="form-label">Brand Name</label>
                                <input type="text" name="name" id="categoryName"
                                       class="form-control" value="{{$brand->name}}" placeholder="Enter category name">
                            </div>

                            <div class="form-group mb-4">
                                <label for="brand" class="form-label">Description</label>
                                <textarea name="description" id="brand" rows="3"
                                          class="form-control"  placeholder="Enter brand description">{{__($brand->description)}}</textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="brandPhoto" class="form-label">Brand Photo</label>
                                <input type="file" name="photo" id="brandPhoto"
                                       class="form-control" accept="image/*" >
                            </div>
                            @if($brand->photos)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $brand->photos->path) }}" alt="Brand Photo" class="img-fluid" width="150">
                                </div>
                            @endif

                            <div class="form-group mb-4">
                                <label for="brandActive" class="form-label">Status</label>
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" id="brandActive" class="form-check-input" value="1" @checked($brand->status == true)>
                                <br>
                                <small class="form-check-label">Check if the brand is active</small>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Update Brand
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
