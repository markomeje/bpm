@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="realtors-banner" style="padding: 140px 0;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="mb-4">
							<h3 class="text-main-dark">Our Realtors</h3>
							<div class="text-main-dark mb-4">The work of an agent or realtor is to help prospect buy or sell property. Internet on the other hand paves way for users to connect with more people in a split of seconds. So, as a real estate agent, broker , realtor, World Best Property Market, creates the avenue for you to market your property. Maximizing our platform gives you the room to connect with more prospects on a global scale by listing your property either as an individual or a corporate entity.</div> 

							<div class="text-main-dark">Our platform is termed Global Market Square for property listing. Just as we take consideration to agents/ realtors, our platform also presents users plethora of opportunities for choosing the best properties to buy as there are thousands of houses displayed on our online market. We encourage you to join us and market your property for free.</div>
						</div>
					</div>
				</div>
				@if(empty($realtors->count()))
					<div class="alert alert-info">No realtors listed</div>
				@else
					<div class="row">
						@foreach ($realtors as $realtor)
							<div class="col-12 col-md-4 col-lg-3 mb-4">
								@include('frontend.realtors.partials.card')	
							</div>
						@endforeach
					</div>
					{{ $realtors->appends(request()->query())->links('vendor.pagination.default') }}
				@endif
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')