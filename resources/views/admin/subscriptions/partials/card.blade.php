@set('timing', \App\Helpers\Timing::calculate((int)$subscription->duration, $subscription->expiry, $subscription->started))
@set('status', strtolower($subscription->status ?? 'Nill'))
<div class="card border-0 shadow-sm pb-0 card-raduis position-relative">
	<div class="card-body pb-0">
		<div class="position-relative">
			<a href="{{ route('admin.user.profile', ['id' => $subscription->user->id]) }}" class="md-circle mb-3 rounded-circle text-center d-block text-decoration-none">
				@if(empty($subscription->user->profile->image))
                    <div class="w-100 h-100 rounded-circle border" style="background-color: {{ randomrgba() }}; top: 2px;">
                        <small class="text-main-dark">
                            {{ substr(strtoupper($subscription->user->name), 0, 1) }}
                        </small>
                    </div>
                @else
                    <img src="{{ $subscription->user->profile->image }}" class="img-fluid object-cover rounded-circle w-100 border h-100">
                @endif
	        </a>
	        <a href="{{ route('admin.subscriptions', ['status' => $status]) }}" class="text-center">
	        	<div class="px-3 text-white tiny-font rounded-pill bg-{{ ($status == 'active' || $status == 'renewed') ? 'success' : ($status == 'paused' ? 'info' : 'danger') }} position-absolute" style="top: 7.5px; left: 30px; border: 3px solid #fff;">
	            	{{ ucfirst($status) }}
	            </div>
	        </a>  
		</div>
		<div class="text-main-dark mb-3">
			({{ $timing->progress() }}%) Progress for {{ ucwords($subscription->membership->name ?? 'nill') }} Plan
		</div>
		<div class="progress progress-bar-height m-0 p-0">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar m-0" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
        </div>
        <div class="position-relative icon-raduis alert alert-info m-0" style="bottom: -24px">
			<small class="text-main-dark">
				{{ $subscription->created_at->diffForHumans() }}
			</small>
		</div>
	</div>
</div>