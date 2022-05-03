<div class="card shadow-sm bg-transparent rounded-0 border-0">
	@set('status', strtolower($payment->status ?? ''))
	<div class="card-header border d-flex justify-content-between">
		<div class="d-flex justify-content-between">
			<div class="text-main-dark">
				{{ $payment->currency->symbol ?? 'NGN' }} {{ number_format($payment->amount) }}
			</div>
		</div>
		<div class="text-{{ $status == 'paid' ? 'success' : 'danger' }}">
			{{ ucfirst($status) }}
		</div>
	</div>
	<div class="card-body shadow-sm bg-white d-flex align-items-center justify-content-between">
		<div class="d-flex align-items-center">
			<div class="rounded-circle lg-circle mr-2">
	            <div class="bg-main-ash p-1 border border-info rounded-circle w-100 h-100">
	                @if(empty($payment->user->profile->image))
	                    <div class="w-100 h-100 border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
	                        <small class="text-main-dark">
	                            {{ substr(strtoupper($payment->user->name), 0, 1) }}
	                        </small>
	                    </div>
	                @else
	                    <img src="{{ $payment->user->profile->image->link }}" class="img-fluid object-cover rounded-circle w-100 h-100 border">
	                @endif
	            </div>
	        </div>
	        <div class="">
	        	<a href="{{ route('admin.user.profile', ['id' => $payment->user->id]) }}" class="text-main-dark d-block">
	        		{{ \Str::limit($payment->user->name, 10) }}
	        	</a>
	        	<small class="text-muted">
					{{ $payment->created_at->diffForHumans() }}
				</small>
	        </div>
		</div>
		<div class="text-center">
			@if($status == 'paid')
				<div class="sm-circle bg-success rounded-circle">
					<small class="text-white pt-1 d-block">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
			@else
				<div class="sm-circle border border-danger rounded-circle">
					<small class="text-danger position-relative" style="top: 1px;">
						<i class="icofont-close"></i>
					</small>
				</div>
			@endif
		</div>
	</div>
	<div class="card-footer border-0 d-flex align-items-center justify-content-between bg-white rounded-0 mt-2">
		<small class="text-main-dark">
			{{ $payment->created_at->diffForHumans() }}
		</small>
		@set('type', strtolower($payment->type ?? ''))
		<a href="{{ route('admin.payments', ['type' => $type]) }}" class="text-decoration-none">
			<small class="text-main-dark">
				{{ ucfirst($type) }}
			</small>
		</a>
	</div>
</div>