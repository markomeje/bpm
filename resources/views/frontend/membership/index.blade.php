@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
        <div class="membership-banner position-relative">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-8 col-lg-6">
						<h1 class="text-main-dark mb-4 text-shadow-white">Our Membership Plans</h1>
					</div>
				</div>
				@if(empty($packages->count()))
					<div class="alert alert-danger">No membership plans listed</div>
				@else
					<div class="row">
						@foreach($packages as $package)
							<div class="col-12">
								<div class="p-4 bg-main-dark text-white mb-4" role="alert">
                                    {{ ucwords($package->name) }} ({{ $package->memberships->count() }})
                                </div>
                                @if($package->memberships()->exists())
                                    <div class="row">
                                        @foreach($package->memberships as $plan)
                                            <div class="col-12 col-md-4 col-lg-3 mb-4">
                                                @include('frontend.membership.partials.plan')
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-danger mb-4" role="alert">No Plans Listed for {{ ucwords($package->name) }}.</div>
                                @endif
							</div>
						@endforeach
					</div>
				@endif
			</div>
		</div>
	</div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')