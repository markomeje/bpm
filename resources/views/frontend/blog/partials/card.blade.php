<div class="card bg-transparent border-0 card-raduis">
    <div class="position-relative">
        <a href="{{ route('blog.read', ['id' => $blog->id, 'slug' => \Str::slug(strtolower($blog->title))]) }}" class="w-100">
            <div style="height: 160px !important;">
                <img src="{{ empty($blog->image) ? '/images/banners/placeholder.png' : $blog->image->link }}" class="img-fluid object-cover rounded border w-100 h-100" alt="{{ $blog['title'] }}">
            </div>
        </a>
    </div>
    <div class="card-body px-0 pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('blog.read', ['id' => $blog->id, 'slug' => \Str::slug(strtolower($blog->title))]) }}" class="text-main-dark text-underline">
                {{ \Str::limit(ucwords($blog->title), 55) }}
            </a>
        </div>
    </div>
    {{-- <div class="bg-transparent d-flex align-items-center justify-content-between">
        <div class="">
            <small class="text-muted">
                {{ $blog->created_at->diffForHumans() }}
            </small>
        </div>
        <small>
            <a href="{{ route('blog', ['category' => strtolower(\Str::slug($blog->category))]) }}" class="text-main-dark">
                {{ \Str::limit(ucwords($blog->category), 12) }}
            </a>
        </small>
    </div> --}}
</div>