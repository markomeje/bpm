@set('status', strtolower($advert->status ?? 'Nill'))
<div class="card bg-transparent p-0 border-0">
	<div class="card-body py-0 px-4 bg-white rounded-0 position-relative">
		<div class="position-relative icon-raduis" style="height: 140px; top: -18px;">
			<img src="{{ empty($advert->banner) ? '/images/banners/placeholder.png' : $advert->banner }}" class="img-fluid w-100 h-100 card-raduis">
			<a href="{{ route('admin.user.profile', ['id' => $advert->user->id]) }}" class="md-circle mb-3 rounded-circle text-center bg-white d-block text-decoration-none position-absolute" style="top: -14px; left: 10px; border: 2px solid #F0F2E3;">
				@if(empty($advert->user->profile->image))
                    <div class="w-100 h-100 rounded-circle" style="background-color: {{ randomrgba() }}; top: 2px;">
                        <small class="text-main-dark">
                            {{ substr(strtoupper($advert->user->name), 0, 1) }}
                        </small>
                    </div>
                @else
                    <img src="{{ $advert->user->profile->image }}" class="img-fluid object-cover rounded-circle w-100 h-100">
                @endif
	        </a>
		</div>
		@set('ad_state', ($status == 'paused' || $status == 'cancelled') ? $advert->paused_at : $advert->expiry)
		@set('timing', \App\Helpers\Timing::calculate((int)$advert->duration, $ad_state, $advert->started))
		<div class="d-flex align-items-center justify-content-between mb-2">
			<div class="text-main-dark">
				{{ $advert->clicks }} clicks
			</div>
			<div class="text-main-dark">
				{{ $timing->progress() }}%
			</div>
		</div>
		<div class="progress progress-bar-height mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar m-0" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
        </div>
        <div class="d-flex align-items-center justify-content-between position-relative pb-3">
        	<div class="">
        		{{ $timing->daysleft() }} days left
        	</div>
			<div class="text-main-dark">
				{{ $advert->created_at->diffForHumans() }}
			</div>
		</div>
	</div>
</div>