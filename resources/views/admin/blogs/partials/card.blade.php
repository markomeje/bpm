<div class="card border-0">
    <div class="card-img position-relative">
        <div class="position-absolute border-top d-flex justify-content-between px-3 align-items-center" style="left: 0; bottom: 0; right: 0; z-index: 3; height: 50px; line-height: 50px; background-color: rgba(0, 0, 0, 0.7);">
            <small class="text-white">
                (1280 X 960)
            </small>
            <div class="d-flex position-relative">
                <small class="cursor-pointer text-white upload-image-{{ $blog->id }}" data-id="{{ $blog->id }}">
                    <i class="icofont-camera">
                    </i>
                </small>
            </div>
        </div>
        <div class="image-loader-{{ $blog->id }} bg-main-dark lg-circle text-center d-none position-absolute rounded-circle border" data-id="{{ $blog->id }}" style="top: 35%; left: 40%;">
            <div class="position-relative" style="top: 4px;">
                <img src="/images/spinner.svg">
            </div>
            
        </div>
        @if(empty($blog->image))
            <form action="javascript:;">
                <input type="file" name="image" accept="image/*" class="image-input-{{ $blog->id }}" data-url="{{ route('admin.image.upload', ['model_id' => $blog->id, 'type' => 'blog', 'folder' => 'blogs', 'role' => 'main', 'public_id' => '']) }}" style="display: none;">
            </form>
            <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}" style="height: 180px;" class="d-block">
                <img src="/images/banners/placeholder.png" class="img-fluid image-preview-{{ $blog->id }} h-100 w-100 object-cover">
            </a>
        @else
            @set('image', $blog->image)
            <form action="javascript:;">
                <input type="file" name="image" accept="image/*" class="image-input-{{ $blog->id }}" data-url="{{ route('admin.image.upload', ['model_id' => $image->model_id, 'type' => $image->type, 'folder' => 'blogs', 'role' => $image->role, 'public_id' => $image->public_id]) }}" style="display: none;">
            </form>
            <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}" style="height: 180px;" class="d-block">
                <img src="{{ $blog->image->link }}" class="img-fluid image-preview-{{ $blog->id }} h-100 w-100 object-cover">
            </a>
        @endif
    </div>
    <div class="card-body">
        <div class="pb-3 mb-3 border-bottom d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}" class="text-underline">
                {{ \Str::limit(strip_tags($blog->title), 10) }}
            </a>
            <div class="dropdown">
                <a href="javascript:;" class="rounded-circle d-block sm-circle bg-{{ $blog->published ? 'success' : 'danger' }} text-center" id="status-{{ $blog->id }}" data-toggle="dropdown">
                    <small class="text-white tiny-font position-relative" style="top: 2px;">
                        <i class="icofont-{{ $blog->published ? 'tick-mark' : 'close' }}"></i>
                    </small>
                </a>
                <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="status-{{ $blog->id }}">
                    <form method="post" class="p-4 w-100 update-blog-status-form" action="javascript:;" style="width: 210px !important;" data-action="{{ route('admin.blog.status.update', ['id' => $blog->id]) }}">
                        <div class="form-group">
                            <label class="form-label text-muted">Published?</label>
                            <select class="custom-select form-control status" name="status">
                                <?php $status = \App\Models\Blog::$publish; ?>
                                @empty($status)
                                    <option value="">No Status</option>
                                @else
                                    <option value="">Select option</option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ (boolean)$value }}" {{ (boolean)$blog->published == (boolean)$value ? 'selected' : '' }}>
                                            {{ ucfirst($key) }}
                                        </option>
                                    @endforeach
                                @endempty
                            </select>
                            <small class="invalid-feedback status-error"></small>
                        </div>
                        <div class="alert mb-3 update-blog-status-message d-none"></div>
                        <div class="d-flex justify-content-right mb-3 mt-1">
                            <button type="submit" class="btn btn-info btn-lg btn-block update-blog-status-button">
                                <img src="/images/spinner.svg" class="mr-2 d-none update-blog-status-spinner mb-1">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-main-dark">
                {{ number_format($blog->views ?? 0) }} views
            </small>
            <a href="{{ route('admin.blogs', ['category' => \Str::slug(strtolower($blog->category))]) }}" class="text-main-dark text-underline">
                {{ ucwords(\Str::limit($blog->category, 6) ?? 'Nill') }}
            </a>
        </div>
    </div>
    <div class="card-footer bg-main-dark d-flex justify-content-between">
        <small class="text-white">
            {{ $blog->created_at->diffForHumans() }}
        </small>
        <div class="d-flex">
            <small class="mr-2">
                <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}" class=" text-warning">
                    <i class="icofont-edit"></i>
                </a>
            </small>
            <small class="text-danger cursor-pointer" data-url="{{ route('admin.blog.delete', ['id' => $blog->id]) }}" data-message="Are you sure to delete post?">
                <i class="icofont-trash"></i>
            </small>
        </div>
    </div>
</div>