<div class="bg-transparent p-0 card-raduis border-0 m-0 position-relative">
	<div class="position-relative" style="height: 160px;">
		<a href="{{ route('account.profile', ['id' => $artisan->id, 'name' => \Str::slug($artisan->user->name)]) }}">
			<img src="{{ empty($artisan->image) ? '/images/banners/avatar.png' : $artisan->image }}" class="img-fluid border object-cover h-100 w-100">
		</a>
	</div>
	<div class="position-relative card-body py-0" style="top: -40px">
		<div class="{{ $artisan->certified ? 'bg-success' : 'bg-secondary' }} text-center rounded-circle sm-circle position-absolute" style="top: -10px; right: 38px; z-index: 2;">
			<div class="text-white tiny-font mt-1">
				<i class="icofont-tick-mark"></i>
			</div>
		</div>
		<div class="bg-white p-4 shadow-sm">
			<div class="mb-2">
				<a href="{{ route('account.profile', ['id' => $artisan->id, 'name' => \Str::slug($artisan->user->name)]) }}" class="text-main-dark">
					{{ \Str::limit(ucwords($artisan->user->name), 16) }}
				</a>
			</div>
			<div class="d-flex">
				@for ($rate = 1; $rate < 5; $rate++)
					<div class="mr-3 text-warning">
						<i class="icofont-ui-rating"></i>
					</div>
				@endfor
			</div>
			<div class="mb-3">
				<div class="mb-3">
					<a href="{{ route('account.profile', ['id' => $artisan->id, 'name' => \Str::slug($artisan->user->name)]) }}">
						<small class="text-main-dark text-underline">
							{{ \Str::limit(ucwords($artisan->description), 24) }}
						</small>
					</a>	
				</div>
				<div class="d-flex justify-content-between">
					<div class="">
						@if($artisan->user->services()->exists())
							@foreach($artisan->user->services->take(1) as $service)
								<div class="px-3 py-1 bg-success text-white tiny-font rounded-pill">
									{{ \Str::limit(ucwords($service->skill->name ?? 'Nill'), 10) }}
								</div>
							@endforeach
						@else
							<div class="px-3 py-1 bg-dark d-inline text-white tiny-font rounded-pill">No Services</div>
						@endif
					</div>
					<a href="{{ route('account.profile', ['id' => $artisan->id, 'name' => \Str::slug($artisan->user->name)]) }}" class="text-theme-color text-decoration-none">
						<i class="icofont-long-arrow-right"></i>
					</a>	
				</div>
			</div>
		</div>
	</div>
</div>	