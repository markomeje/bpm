<div class="card border-0 icon-raduis">
	<div class="card-body">
		<div class="dropdown">
			<a href="javascript:;" class="text-main-dark text-underline d-flex justify-content-between align-items-center" id="drop-review" data-toggle="dropdown" aria-expanded="false">
				<div class="">
					{{ ucfirst(\Str::limit($review->review, 20)) }}
				</div>
				<div class="text-success">
					<i class="icofont-caret-down"></i>
				</div>
			</a>
			<div class="dropdown-menu w-100 shadow icon-raduis" aria-labelledby="drop-review">
				<div class="p-4" style="height: 220px; overflow-y: scroll;">
					{{ ucfirst($review->review) }}
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer bg-theme-color d-flex align-items-center justify-content-between">
		<small class="text-white">
            By {{ \Str::limit($review->user->name, 12) }}
		</small>	
		<small class="text-white">
			{{ $review->created_at->diffForHumans() }}
		</small>
	</div>
</div>