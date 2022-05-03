@include('layouts.header')
    <div class="min-vh-100 bg-main-ash">
        @include('admin.layouts.navbar')
        <div class="section-padding pb-4">
            <div class="container-fluid">
                @if(empty($blog))
                    <div class="alert alert-danger d-flex align-items-center justify-content-between mb-4">Blog Not Found</div>
                @else
                    @set('id', $blog->id)
                    <div class="row">
                        <div class="col-12 col-lg-9 mb-4">
                            <div class="alert alert-info d-flex align-items-center justify-content-between mb-4">Add Blog</div>
                            <div class="bg-white p-4 card-raduis shadow-sm">
                                <form method="post" action="javascript:;" class="edit-blog-form" data-action="{{ route('blog.edit', ['id' => $blog->id]) }}" autocomplete="off">
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label class="form-label text-muted">Title</label>
                                            <input type="text" name="title" class="form-control title" placeholder="e.g., How to buy a home" value="{{ $blog->title ?? '' }}">
                                            <small class="invalid-feedback title-error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label text-muted">Category</label>
                                            <select class="custom-select form-control category" name="category">
                                                <option value="">Select Category</option>
                                                @set('categories', \App\Models\Blog::$categories)
                                                @if(empty($categories))
                                                    <option value="">No Categories</option>
                                                @else
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category }}" {{ $category == $blog->category ? 'selected' : '' }}>
                                                            {{ ucwords($category) }}
                                                        </option>
                                                    @endforeach
                                                @endempty
                                            </select>
                                            <small class="invalid-feedback category-error"></small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label text-muted">Publish Now?</label>
                                            <select class="custom-select form-control status" name="status">
                                                <?php $status = \App\Models\Blog::$publish; ?>
                                                @empty($status)
                                                    <option value="">No Status</option>
                                                @else
                                                    @foreach ($status as $key => $value)
                                                        <option value="{{ (boolean)$value }}">
                                                            {{ ucfirst($key) }}
                                                        </option>
                                                    @endforeach
                                                @endempty
                                            </select>
                                            <small class="invalid-feedback status-error"></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted">Description</label>
                                        <textarea class="form-control description blog-description-{{ $blog->id }}" name="description" rows="4" placeholder="Add book description." id="description">{{ $blog->description ?? '' }}</textarea>
                                        <small class="invalid-feedback description-error"></small>
                                    </div>
                                    <div class="alert mb-3 edit-blog-message d-none"></div>
                                    <button type="submit" class="btn bg-theme-color text-white edit-blog-button mt-1 px-4 btn-lg">
                                        <img src="/images/spinner.svg" class="mr-2 d-none edit-blog-spinner mb-1">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="alert alert-info d-flex align-items-center justify-content-between mb-4">Recent Blogs</div>
                            <div class="rows">
                                @set('recents', \App\Models\Blog::latest('created_at')->take(3)->get())
                                @if(empty($recents->count()))
                                    <div class="alert alert-danger mb-4">No Recent Blogs</div>
                                @else
                                    <div class="row">
                                        @foreach($recents as $blog)
                                            @if($blog->id !== $id)
                                                <div class="col-12 col-md-4 col-lg-12 mb-4">
                                                    @include('admin.blogs.partials.card')
                                                </div>
                                            @endif
                                        @endforeach
                                    </div> 
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@include('layouts.footer')    