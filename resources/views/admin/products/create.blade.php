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
                                <label for="mytextarea" class="form-label">Additional Info</label>
                                <textarea name="additional_info" id="mytextarea" rows="3"
                                          class="form-control"
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
                            <div class="form-group mb-4">
                                <label for="productBrand" class="form-label">Brand</label>
                                <select name="brand_id" id="productBrand" class="form-control">
                                    <option value="" disabled selected>Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Category Selection -->
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="productCategory" class="form-label">Category</label>

                                        <select name="category_id" id="productCategory" class="form-control">
                                            <option value="" disabled selected>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="productCategory" class="form-label">sub categories</label>
                                        <select name="category_id" id="getSubCategory" class="form-control">
                                            <option value="" disabled selected>Select sub Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4" id="appendColors">
                                <label class="form-label">Color Options</label>
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <label for="color_name" class="form-label">Color Name</label>
                                        <input type="text" class="form-control" name="color_name[]"
                                               placeholder="e.g., Red, Blue" aria-label="Color Name">
                                    </div>

                                    <div class="col-md-5">
                                        <label for="price_color" class="form-label">Price</label>
                                        <input type="text" class="form-control" name="color_price[]"
                                               placeholder="e.g., 10.99" aria-label="Color Price">
                                    </div>

                                    <div class="col-md-2 d-flex align-items-end">
                                        <button class="btn btn-primary" id="addColor" type="button"
                                                title="Add a new color option">Add Color
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <!-- Size Selection -->
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="productSize" class="form-label">Size Name</label>
                                        <input type="text" class="form-control" name="size_name[]" placeholder="Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="size_price" class="form-label">Price</label>
                                        <input type="text" class="form-control" id="size_price[]" name="size_price[]"
                                               placeholder="Price">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mb-4">
                                <label for="stock-quantity" class="form-label">Stock Quantity</label>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <input type="number" name="stock"
                                               class="form-control stock-input"
                                               placeholder="Enter stock quantity" min="1">
                                    </div>


                                </div>
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="image" class="form-label btn btn-primary px-lg-5">Upload
                                    images</label>
                                <input type="file" name="images[]" multiple id="image" style="display: none">
                            </div>

                            <div id="image-preview" class="mt-3">

                            </div>

                            <!-- Product Status -->
                            <div class="form-group mb-4">
                                <input type="checkbox" name="status" id="status" class="form-check-input" value="1">
                                <label for="status" class="form-label">Status</label>
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
    @section('script')

        <script>
            $(document).ready(function () {
                let colorCount = 1;
                const maxColors = 5;

                // Function to add a new color row
                function addColorRow() {
                    if (colorCount < maxColors) {
                        const newRow = `
                    <div class="row g-3 mt-2 color-row">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="color_name[]" placeholder="e.g., Red, Blue" aria-label="Color Name">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="color_price[]" placeholder="e.g., 10.99" aria-label="Color Price">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-danger deleteColor" type="button" title="Delete this color option">Delete</button>
                        </div>
                    </div>`;

                        $('#appendColors').append(newRow);
                        colorCount++;
                    } else {
                        alert('You have reached the maximum number of color options.');
                    }
                }

                function removeColorRow(button) {
                    $(button).closest('.color-row').remove();
                    colorCount--;
                }

                $('#addColor').on('click', function () {
                    addColorRow();
                });

                $('#appendColors').on('click', '.deleteColor', function () {
                    removeColorRow(this);
                });
            });


            // getSubCategory
            $('body').delegate('#productCategory', 'change', function (e) {
                let id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/dashboard/sub-category') }}",
                    data: {
                        id: id,
                        '_token': "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#getSubCategory').empty();
                        $.each(data[0], function (key, subCategory) {
                            $('#getSubCategory').append('<option value="' + subCategory.id + '">' + subCategory.name + '</option>');
                        })
                    },
                    error: function (data) {
                        console.error("Error:", data);
                    }
                });
            });


            //upload images

            document.getElementById('image').addEventListener('change', function (event) {
                const previewContainer = document.getElementById('image-preview');
                previewContainer.innerHTML = '';

                const files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Create a container for the image and remove button
                            const previewWrapper = document.createElement('div');
                            previewWrapper.style.display = 'inline-block';
                            previewWrapper.style.position = 'relative';
                            previewWrapper.style.marginRight = '10px';
                            previewWrapper.style.marginBottom = '10px';

                            // Create image element
                            const imgElement = document.createElement('img');
                            imgElement.src = e.target.result;
                            imgElement.style.width = '100px';  // You can adjust the size

                            // Create the remove button
                            const removeButton = document.createElement('button');
                            removeButton.textContent = 'X';
                            removeButton.style.position = 'absolute';
                            removeButton.style.top = '3px';
                            removeButton.style.right = '0px';
                            removeButton.style.background = 'transparent';
                            removeButton.style.color = 'red';
                            removeButton.style.border = 'none';

                            removeButton.style.fontSize = '12px';

                            // Append the image and remove button to the preview container
                            previewWrapper.appendChild(imgElement);
                            previewWrapper.appendChild(removeButton);
                            previewContainer.appendChild(previewWrapper);

                            // Add event listener to the remove button
                            removeButton.addEventListener('click', function () {
                                previewWrapper.remove();  // Remove the image and button wrapper
                            });
                        };

                        // Read the file as a data URL
                        reader.readAsDataURL(file);
                    }
                }
            });

        </script>

    @endsection


</x-admin-layout>
