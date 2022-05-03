@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100 position-relative">
    	<section class="artisan-banner" style="padding: 140px 0;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8">
						<div class="mb-3">
							<h4 class="text-main-dark">Global Artisans ({{ \App\Models\Profile::where(['role' => 'artisan'])->count() }})</h4>
							<div class="text-main-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod laboris nisi ut aliquip ex ea commodo  Duis aute irure dolor in</div>
						</div>
					</div>
				</div>
				@if(empty($artisans->count()))
					<div class="alert alert-info">No artisans listed</div>
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