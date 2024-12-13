<x-admin-layout title="{{__($title)}}">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Category Title -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h1 class="my-4">Category: {{ $category->name }}</h1>
                                <div class="mb-4">
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to
                                        Categories</a>
                                </div>
                            </div>
                            <!-- Subcategories Section -->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="mb-3">Subcategories</h3>
                                    {{--                                    <ul class="list-group">--}}
                                    {{--                                        @foreach($category->children as $cat)--}}
                                    {{--                                            @if(!empty($cat))--}}
                                    {{--                                                <li class="list-group-item"--}}
                                    {{--                                                    style="margin-left: 20px">--}}
                                    {{--                                                    {{ $cat->name }}--}}
                                    {{--                                                </li>--}}
                                    {{--                                    </ul>--}}
                                    {{--                                    @else--}}
                                    {{--                                        <p>No subcategories available for this category.</p>--}}
                                    {{--                                    @endif--}}
                                    {{--                                    @endforeach--}}

                                    @if(!empty($subcategories))
                                        <ul class="list-group">
                                            @foreach ($subcategories as $subcategory)
                                                <li class="list-group-item"
                                                    style="margin-left: {{ $subcategory->level * 20 }}px;">
                                                    {{ $subcategory->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No subcategories available for this category.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Category Details -->
                            <div class="card mt-4">
                                <div class="card-body">
                                    <p class="p-2"><strong>Description:</strong> {{ $category->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-admin-layout>
