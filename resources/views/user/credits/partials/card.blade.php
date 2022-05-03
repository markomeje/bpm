<div class="card rounded-0 shadow-sm border-0 position-relative">
	<?php $status = strtolower($credit->status ?? ''); ?>
	<div class="card-body p-0">
		<div class="row no-gutters text-center">
			<div class="col-6 border py-2">
				<small class="">
					{{ $credit->units }}units
				</small> 
			</div>
			<div class="col-6 border py-2">
				<div class="dropdown">
					<div class="cursor-pointer" id="credit-days-{{ $credit->id }}" data-toggle="dropdown" aria-expanded="false">
						<small class="text-underline text-main-dark">
							{{ $credit->duration ?? 0 }}days
						</small>
					</div>
					<div class="dropdown-menu border-0 dropdown-menu-right shadow" aria-labelledby="credit-days-{{ $credit->id }}">
						<div class="dropdown-item">
							<small>
								{{ $credit->duration }} days
							</small>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer bg-theme-color d-flex align-items-center justify-content-between">
		<small class="text-white">
			<small>
				{{ $credit->created_at->diffForHumans() }}
			</small>
		</small>
		<small>
			@if($credit->promotion !== null)
				@if($status === 'expired')
		    		<small class="text-danger">Used</small>
				@else
					<small class="text-success">Running</small>
		    	@endif
			@else
				<small class="{{ $status === 'expired' ? 'text-danger' : 'text-white' }}">
					{{ ucwords($credit->status ?? 'nill') }}
				</small>
			@endif
		</small>
	</div>
</div>