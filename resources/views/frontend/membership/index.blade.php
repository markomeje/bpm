@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
        <div class="membership-banner position-relative">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-8 col-lg-6 mb-4">
						<h1 class="text-main-dark mb-4 text-shadow-white">Our Memberships</h1>
						<div class="text-white text-shadow-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</div>
					</div>
				</div>
				@if(empty($memberships->count()))
					<div class="alert alert-danger">No membership plans listed</div>
				@else
				{{-- {{ dd($memberships) }} --}}
					<div class="row">
						@foreach($memberships as $plan)
							<div class="col-12 col-md-4 col-lg-3 mb-4">
								<div class="card border-0 rounded-0">
									<div class="card-body">
										<h6 class="mb-3 text-main-dark">
											{{ ucwords($plan->name) }} ({{ $plan->duration }} {{ $plan->duration <= 1 ? 'Day' : 'Days' }})
										</h6>
										<h5 class="mb-4 text-main-dark">
											NGN{{ number_format($plan->price) }}
										</h5>
										<div class="mb-2">
				                            <a href="{{ auth()->check() ? route('user.dashboard') : route('signup') }}" class="btn bg-theme-color text-white px-4">Get Started</a>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@endif
			</div>
		</div>
	</div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')