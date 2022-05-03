@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
    	<section class="country-banner" style="padding: 140px 0 120px">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-7 col-lg-9">
						@empty($countryProperties->count())
							<div class="alert alert-info">No Properties Found</div>
						@else
							<div class="p-3 mb-4 bg-white shadow-sm icon-raduis">
								<h5 class="m-0">
									{{ ucfirst($country->name) }} Properties ({{ $countryProperties->total() }})
								</h5>
							</div>
							<?php $image = 1; ?>
							<div class="row">
								@foreach($countryProperties as $property)
									<?php $image++; ?>
									<div class="col-12 col-md-6 col-lg-4 mb-4">
										@include('frontend.properties.partials.card')
									</div>
								@endforeach
							</div>
							{{ $properties->appends(request()->query())->links('vendor.pagination.default') }}
						@endempty
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
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')