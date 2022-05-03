<div class="card border-0 admin-card position-relative mb-4">
	<div class="card-body pt-0">
		<div class="rounded position-relative d-flex justify-content-between align-items-center p-3" style="top: -20px; background-color: {{ randomrgba(0.8) }};">
			<small class="text-white">
				{{ ucfirst($plan->duration) }}
			</small>
			<small class="bg-warning px-2 cursor-pointer rounded" data-toggle="modal" data-target="#edit-plan-{{ $plan->id }}">
				<small class="text-white">
					<i class="icofont-edit"></i>
				</small>
			</small>
		</div>
		<div class="d-flex justify-content-between mb-3">
			<small class="text-dark">
				{{ ucwords($plan->name ?? 'nill') }}
			</small>
			<small class="text-dark">
				${{ number_format($plan->price ?? 0) }}
			</small>
		</div>
		<div class="bg-main-ash rounded p-3 d-flex justify-content-between align-items-center">
			<small class="text-dark">
				{{ empty($plan->subscriptions) ? rand(23, 95) : $plan->subscriptions->count() }} Subs
			</small>
			<div class="dropdown">
                <div class="text-dark">
                	<div class="cursor-pointer" data-toggle="dropdown" id="plan-details-{{ $plan->id }}">
                		<small class="text-dark">
                			Details
                		</small>
	                    <small class="text-dark">
	                    	<i class="icofont icofont-caret-down"></i>
	                    </small>
                	</div>
	                <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="plan-details-{{ $plan->id }}" style="width: 240px; max-height: 320px; overflow-y: scroll;">
	                	<div class="p-3">
	                		<small class="text-dark">
	                			{{ ucfirst($plan->details ?? 'nill') }}
	                		</small>
	                	</div>
	                </div>
	            </div>
            </div>
		</div>
	</div>
</div>