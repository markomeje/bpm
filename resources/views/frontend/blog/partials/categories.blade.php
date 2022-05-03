<div class="alert alert-info mb-4">Blog Categories</div>
<div class="bg-white p-4">
    @set('categories', \App\Models\Blog::$categories)
    @if(!empty($categories))
        @foreach($categories as $category)
            <a class="text-decoration-none rounded bg-main-ash d-flex justify-content-between mb-4 p-4" href="{{ route('blog', ['category' => strtolower(\Str::slug($category))]) }}">
                <small class="text-main-dark">
                    {{ ucfirst($category) }}
                </small>
                <small class="">
                    ({{ \App\Models\Blog::where(['category' => $category])->get()->count() }})
                </small>
            </a>
        @endforeach
    @else
        <div class="alert alert-danger">No Categories</div>
    @endif
</div>