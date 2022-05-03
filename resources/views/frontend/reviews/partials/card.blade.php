<div class="card border bg-transparent">
	<div class="card-body">
		<div class="d-flex justify-content-between">
			<div class="d-flex mb-2">
				@for ($rate = 1; $rate < 5; $rate++)
					<div class="mr-3 text-warning">
						<i class="icofont-ui-rating"></i>
					</div>
				@endfor
			</div>
		</div>
		<div class="">
			<div class="text-main-dark">
				{{ ucfirst($review->review) }}
			</div>
		</div>
	</div>
	<div class="card-footer bg-transparent d-flex justify-content-between">
		<small class="text-main-dark">
			<em>By</em> {{ \Str::limit(ucwords($review->user->name ?? 'Nill'), 12) }}
		</small>
		<small class="text-main-dark">
			{{ $review->created_at->diffForHumans() }}
		</small>
	</div>
</div>