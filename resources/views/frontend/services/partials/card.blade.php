<div class="border card card-raduis bg-white">
	<div class="card-body p-4">
		<div class="row d-flex">
			<div class="col-12 col-md-6 col-lg-6 mb-4">
				<div class="border" style="height: 180px;">
					<img src="{{ empty($service->image) ? '/images/banners/placeholder.png' : $service->image }}" class="img-fluid object-cover rounded w-100 h-100">
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-6 mb-4">
				<div class="">
					<h5 class="text-theme-color mb-2">
						Price {{ empty($service->price) ? 'Negotiable' : (empty($service->currency) ? 'NGN' : $service->currency->symbol).number_format($service->price) }}
					</h5>
					<div class="text-main-dark mb-3">
						{{ ucfirst($service->skill->name) }}
					</div>
					<div class="">
						<a href="tel:{{ $service->user->phone }}" class="bg-theme-color btn text-white px-4">
							<i class="icofont-phone"></i> Call Me
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="text-main-dark">
			{{ ucfirst($service->description) }}
		</div>
	</div>
</div>