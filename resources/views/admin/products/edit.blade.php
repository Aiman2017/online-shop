<x-admin-layout title="{{$title}}">
    <div class="main-wrapper bg-dark text-light">
        <div class="page-wrapper">
            <div class="page-content">
                <!-- Page Title and Return Button -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="mb-0">{{ __('Create Product') }} | Page</h2>
                    <a class="btn btn-primary" href="{{ route('admin.products.index') }}">
                        <i class="fas fa-arrow-left me-2"></i> Return Back
                    </a>
                </div>

                <!-- Create New Product Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('admin.components.errors')
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Product Name -->
                            <div class="form-group mb-4 mt-1">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" name="name" id="productName" class="form-control"
                                       placeholder="Enter product name">
                            </div>

                            <!-- Product Description -->
                            <div class="form-group mb-4">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea name="description" id="productDescription" rows="3" class="form-control"
                                          placeholder="Enter product description"></textarea>
                            </div>

                            <!-- Additional Info -->
                            <div class="form-group mb-4">
                                <label for="additionalInfo" class="form-label">Additional Info</label>
                                <textarea name="additional_info" id="additionalInfo" rows="3" class="form-control"
                                          placeholder="Enter Additional Info"></textarea>
                            </div>

                            <!-- Price -->
                            <div class="form-group mb-4 mt-1">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" id="price" class="form-control"
                                       placeholder="Enter price">
                            </div>

                            <!-- Old Price -->
                            <div class="form-group mb-4 mt-1">
                                <label for="old_price" class="form-label">Old Price</label>
                                <input type="number" name="old_price" id="old_price" class="form-control"
                                       placeholder="Enter old price">
                            </div>

                            <!-- Brand Selection -->


                            <!-- Category Selection -->


                            <div class="col-md-6">
                                <label for="productCategory" class="form-label">sub categories</label>
                                <select name="category_id" id="getSubCategory" class="form-control">
                                    <option value="" disabled selected>Select sub Category</option>
                                </select>
                            </div>
                    </div>
                </div>

                <!-- Color Selection -->
                {{--                            <div class="form-group mb-4">--}}
                {{--                                <div class="row">--}}
                {{--                                    <div class="col-md-6">--}}
                {{--                                        <label for="productSize" class="form-label">Color Name</label>--}}
                {{--                                        <input type="text" class="form-control" name="color_name[]" placeholder="Name">--}}
                {{--                                    </div>--}}
                {{--                                    <div class="col-md-6">--}}
                {{--                                        <label for="price_color" class="form-label">Price</label>--}}
                {{--                                        <input type="text" class="form-control" id="price_color" name="price_color[]" placeholder="Price">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                <!-- Size Selection -->
                {{--                            <div class="form-group mb-4">--}}
                {{--                                <div class="row">--}}
                {{--                                    <div class="col-md-6">--}}
                {{--                                        <label for="productSize" class="form-label">Size Name</label>--}}
                {{--                                        <input type="text" class="form-control" name="name[]" placeholder="Name">--}}
                {{--                                    </div>--}}
                {{--                                    <div class="col-md-6">--}}
                {{--                                        <label for="size_price" class="form-label">Price</label>--}}
                {{--                                        <input type="text" class="form-control" id="size_price" name="size_price[]" placeholder="Price">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="form-group mb-4">--}}
                {{--                                <label for="stock-quantity" class="form-label">Stock Quantity</label>--}}
                {{--                                <div class="row align-items-center">--}}
                {{--                                    <div class="col-md-6">--}}
                {{--                                        <input type="number" name="stock[]" id="stock-quantity" class="form-control stock-input"--}}
                {{--                                               placeholder="Enter stock quantity" min="1">--}}
                {{--                                    </div>--}}
                {{--                                    <div class="col-md-6">--}}
                {{--                                        <button type="button" class="btn btn-primary addStock">Add</button>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div id="stockContainer" class="mt-3 row"></div>--}}
                {{--                            </div>--}}

                <div class="form-group mb-4">
                    <label for="image" class="form-label btn btn-primary px-lg-5">Upload images</label>
                    <input type="file" name="images[]" multiple id="image" style="display: none">
                </div>

                <!-- Product Status -->
                <div class="form-group mb-4">
                    <label for="status" class="form-label">Status</label>
                    <input type="checkbox" name="status" id="status" class="form-check-input" value="1">
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Create Product
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>


</x-admin-layout>
