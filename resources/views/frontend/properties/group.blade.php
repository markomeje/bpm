@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="" style="padding: 140px 0;">
			<div class="container-fluid">
				@empty($properties->count())
					<div class="alert alert-info">No Properties Found</div>
				@else
					<div class="row">
						<div class="col-12 col-md-7 col-lg-9">
							<div class="alert alert-info mb-4">
								{{ ucwords($group) }} ({{ $properties->total() }})
							</div>
							<div class="row">
								@foreach($properties as $property)
									<div class="col-12 col-md-6 col-lg-4 mb-4">
										@include('frontend.properties.partials.card')
									</div>
								@endforeach
							</div>
							{{ $properties->appends(request()->query())->links('vendor.pagination.default') }}
						</div>
						<div class="col-12 col-md-5 col-lg-3">
							<div class="mb-4">
								@include('frontend.properties.partials.categories')
							</div>
							<div class="mb-4">
								@include('frontend.adverts.partials.sidebar')
							</div>
						</div>
					</div>
				@endempty
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')