@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
    	<section class="blog-banner">
			<div class="container-fluid">
				<div class="row mb-4">
					<div class="col-12 mb-4">
						@if(empty($category))
							<h1 class="text-white">Our Blogs</h1>
						@else
							<h1 class="text-white">{{ ucwords($category) }} Blogs</h1>
						@endif
						<div class="text-white p-0">Our blog page shares information on related topics both personal and non-personal. It contains discreet information about anything in the real estate industry which in many case, will benefit our users.</div>
					</div>
				</div>
			</div>
		</section>
		<section class="position-relative" style="top: -80px;">
			<div class="container-fluid">
				<div class="">
                        @if(empty($blogs->count()))
                            <div class="alert-info alert m-0">No Blogs Yet</div>
                        @else
                            <div class="row">
                                @foreach($blogs as $blog)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                                        @include('frontend.blog.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            {{ $blogs->appends(request()->query())->links('vendor.pagination.default') }}
                        @endif
                    </div>
                </div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')