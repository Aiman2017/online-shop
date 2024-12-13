@foreach($children as $child)
    <div class="filter-item">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input"
                   @checked(in_array($child->name, $data['categories'] ?? []))
                   id="cat-{{$child->id}}" name="categories[]"
                   value="{{$child->name}}">
            <label class="custom-control-label" for="cat-{{$child->id}}">
                {{$child->name}}
            </label>
        </div><!-- End .custom-checkbox -->
    </div><!-- End .filter-item -->
    <div class="child-categories" style="margin-left: 20px;">
        @include('front-end.templates.checkbox-children', [
    'children' => $child->children,
    ])
    </div>
@endforeach

