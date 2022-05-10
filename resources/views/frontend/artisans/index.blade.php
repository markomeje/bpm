@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100 position-relative">
    	<section class="artisan-banner" style="padding: 140px 0;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="mb-4">
							<h4 class="text-main-dark">Global Services ({{ \App\Models\Profile::where(['role' => 'artisan'])->count() }})</h4>
							<div class="text-main-dark">Join us for free today, showcase and market your skill to the world. As a professional and non-professional service provider, we help you advertise your talent to the world by leveraging innovative technologies to get you connected in the market locally and globally.</div>
						</div>
					</div>
				</div>
				@if(empty($artisans->count()))
					<div class="alert alert-info">No services listed</div>
				@else
					<div class="row">
						@foreach ($artisans as $artisan)
							<div class="col-12 col-md-4 col-lg-3">
								@include('frontend.artisans.partials.card')	
							</div>
						@endforeach
					</div>
					{{ $artisans->appends(request()->query())->links('vendor.pagination.default') }}
				@endif
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')