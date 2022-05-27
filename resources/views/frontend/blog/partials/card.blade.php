<div class="card bg-transparent border-0 card-raduis">
    <div class="position-relative">
        <a href="{{ route('blog.read', ['id' => $blog->id, 'slug' => \Str::slug(strtolower($blog->title))]) }}" class="w-100">
            <div style="height: 180px !important;">
                <img src="{{ empty($blog->image) ? '/images/banners/placeholder.png' : $blog->image->link }}" class="img-fluid object-cover rounded border w-100 h-100" alt="{{ $blog['title'] }}">
            </div>
        </a>
        <a href="{{ route('blog', ['category' => strtolower(\Str::slug($blog->category))]) }}" class=" px-3 rounded-0 bg-theme-color position-absolute" style="top: 18px; left: 18px;">
            <small class="text-white">{{ ucwords($blog->category) }}</small>
        </a>
    </div>
    <div class="card-body px-0 pb-0">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <a href="{{ route('blog.read', ['id' => $blog->id, 'slug' => \Str::slug(strtolower($blog->title))]) }}" class="text-main-dark text-underline">
                {{ \Str::limit(ucwords($blog->title), 55) }}
            </a>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <small class="text-muted">
            Since {{ $blog->created_at->diffForHumans() }}
        </small>
    </div>
</div>