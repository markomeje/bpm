@include('layouts.header')
    <div class="min-vh-100 bg-main-ash">
        @include('admin.layouts.navbar')
        <div class="section-padding pb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="alert alert-info d-flex mb-4 align-items-center justify-content-between mb-4">
                            @if(empty($category))
                                <div>{{ \App\Models\Blog::count() }} Blogs</div>
                            @else
                                @set('where', \App\Models\Blog::where(['category' => $category])->get())
                                <div>({{ $where->count()  }}) {{ ucwords($category) }} Blogs</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="alert alert-info d-flex mb-4 align-items-center justify-content-between mb-4">
                            <a href="{{ route('admin.blog.add') }}" class="text-decoration-none">
                                <i class="icofont-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>  
                <div class="">
                    @if(empty($blogs->count()))
                        <div class="alert-info alert">No blogs yet</div>
                    @else
                        <div class="row">
                            @foreach($blogs as $blog)
                                <div class="col-12 col-md-4 col-lg-3 mb-4">
                                    @include('admin.blogs.partials.card')
                                </div>
                            @endforeach
                        </div>
                        {{ $blogs->links('vendor.pagination.default') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')    