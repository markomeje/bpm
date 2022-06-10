@set('status', strtolower($advert->status ?? 'Nill'))
<div class="card bg-transparent p-0 border-0">
	<div class="card-body py-0 px-4 bg-white rounded-0 position-relative">
		<div class="position-relative rounded" style="height: 180px; top: -18px;">
			<img src="{{ empty($advert->image->link) ? '/images/banners/placeholder.png' : $advert->image->link }}" class="img-fluid w-100 h-100 rounded border">
			<a href="{{ route('admin.user.profile', ['id' => $advert->user->id]) }}" class="md-circle mb-3 rounded-circle text-center bg-white d-block text-decoration-none position-absolute" style="top: -14px; left: 18px; border: 2px solid #F0F2E3;">
				@if(empty($advert->user->profile->image))
                    <div class="w-100 h-100 rounded-circle" style="background-color: {{ randomrgba() }}; top: 2px;">
                        <small class="text-main-dark">
                            {{ substr(strtoupper($advert->user->name), 0, 1) }}
                        </small>
                    </div>
                @else
                    <img src="{{ $advert->user->profile->image->link }}" class="img-fluid object-cover rounded-circle w-100 h-100">
                @endif
	        </a>
		</div>
		@set('timing', \App\Helpers\Timing::calculate((int)$advert->credit->duration, $advert->expiry, $advert->started))
		<div class="d-flex align-items-center justify-content-between mb-2">
			<small class="text-main-dark">
				{{ $timing->duration() - $timing->daysleft() }} of {{ $timing->duration() }} days
			</small>
			<small class="text-main-dark">
				{{ $timing->progress() }}%
			</small>
		</div>
		<div class="progress progress-bar-height mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar m-0" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
        </div>
        <div class="mb-4 d-flex justify-content-between align-items-center">
        	<small class="text-main-dark">
        		{{ ucfirst($advert->status) }}
        	</small>
        	<small class="text-main-dark">
        		Total of {{ $timing->duration }}days
        	</small>
        </div>
	</div>
	<div class="card-footer bg-theme-color border-0">
        <div class="d-flex align-items-center justify-content-between position-relative">
			<small class="text-white">
				{{ $advert->created_at->diffForHumans() }}
			</small>
			<div class="dropdown">
	            <a href="javascript:;" class="align-items-center d-flex text-decoration-none
	            " id="advert-{{ $advert->id }}" data-toggle="dropdown">
	                <small class="text-white">
	                	Extend <i class="icofont icofont-caret-down"></i>
	                </small>
	            </a>
	            <div class="dropdown-menu border-0 shadow-sm dropdown-menu-right" aria-labelledby="advert-{{ $advert->id }}" style="width: 210px !important;">
				    <form method="post" action="javascript:;" class="extend-advert-form w-100 p-3" data-action="{{ route('admin.advert.extend', ['id' => $advert->id]) }}" autocomplete="off">
			            <div class="form-row">
			                <div class="form-group col-12">
			                    <label class="text-smoky">Extend expiry</label>
			                    <input type="date" name="expiry" class="form-control expiry" placeholder="" value="{{ date('Y-m-d', strtotime($advert->expiry)) }}" min="{{ date('Y-m-d', strtotime($advert->expiry)) }}">
			                    <small class="invalid-feedback expiry-error"></small>
			                </div>
			            </div>
			            <div class="alert mb-3 extend-advert-message d-none tiny-font"></div>
			            <div class="d-flex justify-content-right mb-3 mt-1">
			                <button type="submit" class="btn bg-theme-color btn-block btn-lg text-white extend-advert-button px-4">
			                    <img src="/images/spinner.svg" class="mr-2 d-none extend-advert-spinner mb-1">
			                    Extend
			                </button>
			            </div>
				    </form>
	            </div>
	        </div>
		</div>
	</div>
</div>