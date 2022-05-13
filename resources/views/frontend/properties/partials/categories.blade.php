<div class="alert alert-info mb-4">All Categories</div>
<div class="bg-white p-4">
    @set('categories', \App\Models\Property::$categories)
    @if(!empty($categories))
        @foreach($categories as $category => $description)
            <a class="text-decoration-none rounded border-bottom d-flex justify-content-between mb-4 pb-4" href="{{ route('properties.category', ['category' => $category]) }}">
                <small class="text-main-dark">
                    {{ \Str::plural(ucfirst($category)) }}
                </small>
                <small class="">
                    ({{ \App\Models\Property::where(['category' => $category])->get()->count() }})
                </small>
            </a>
        @endforeach
    @else
        <div class="alert alert-danger">No Categories</div>
    @endif
</div>