@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="property-banner">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-8 col-lg-9">
						<div class="mb-4">
							@empty($property)
								<div class="alert alert-danger mb-4">Property Not Found</div>
							@endempty	
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-3">
						<div class="mb-4">
				            @include('frontend.properties.partials.categories')
			            </div>
			            <div class="">
			            	@include('frontend.adverts.partials.sidebar')
			            </div>
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')