<div class="card rounded-0 border-0 shadow">
	<div class="card-body">
		<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
			<small class="text-main-dark">
				{{ empty($service->price) ? 'Nill' : 'NGN'.number_format($service->price) }}
			</small>
			<small class="text-main-dark">
				{{ ucwords(\Str::limit($service->skill->name, 14)) }}
			</small>
		</div>
		<div class="d-flex justify-content-between align-items-center">
			<a class="text-underline text-main-dark" href="javascript:;" data-toggle="modal" data-target="#edit-service-{{ $service->id }}">
				<small class="">
					{{ ucfirst(\Str::limit($service->description, 28)) }}
				</small>
			</a>
			<small class="text-success">
				({{ $service->clicks ?? rand(4, 67) }} clicks)
			</small>
		</div>
			
	</div>
	<div class="card-footer bg-info d-flex justify-content-between">
		<small class="text-white">
			{{ $service->created_at->diffForHumans() }}
		</small>
		<div class="d-flex align-items-center">
			<small class="text-warning cursor-pointer" data-toggle="modal" data-target="#edit-service-{{ $service->id }}">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>