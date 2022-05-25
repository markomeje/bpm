@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
    	<section class="" style="padding: 140px 0;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-8 col-lg-8">
						<div class="mb-4">
							@empty($blog)
								<div class="alert alert-danger">Post No Found</div>
							@else
								<?php $blog->views = $blog->views + 1; $blog->update(); ?>
								<div class="mb-4">
									<h3 class="text-main-dark mb-3">
										{{ ucfirst($blog->title) }}
									</h3>
									<div class="mb-4" style="height: 380px;">
										<img src="{{ empty($blog->image) ? '/images/banners/placeholder.png' : $blog->image->link }}" class="img-fluid border h-100 w-100 object-cover">
									</div>
									<div class="mb-4">
										<div class="text-main-dark">
											{!! $blog->description !!}
										</div>
									</div>
									<div class="p-3 rounded border">
										<div class="text-main-dark">By {{ $blog->user ? ucwords($blog->user->name) : 'Best Property Market' }}</div>
									</div>
								</div>
							@endempty
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-4">
                        <div class="mb-4">
                        	@include('frontend.blog.partials.categories')
						</div>
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')