@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="dealers-banner" style="padding: 140px 0;">
			<div class="container-fluid">
				<div class="row">
					<div class="dealer-col col-12">
						<div class="mb-4">
							<h3 class="text-main-dark">Building Materials Dealers</h3>
							<div class="text-main-dark">As a Provider of quality construction equipment and building materials, our platform gives you direct access to retailers, distributors, whole-sellers, factory producers and buyers etc. Our platform grants you free, and unlimited opportunities to be seen both locally and in the worldwide market.</div>
						</div>
					</div>
				</div>
				@if(empty($dealers->count()))
					<div class="alert alert-info">No dealers listed</div>
				@else
					<div class="row">
						@foreach ($dealers as $dealer)
							<div class="dealer-c col-12  col-sm-4 col-md-4 col-lg-3 mb-4">
								@include('frontend.dealers.partials.card')	
							</div>
						@endforeach
					</div>
					{{ $dealers->appends(request()->query())->links('vendor.pagination.default') }}
				@endif
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')