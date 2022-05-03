<div class="card border-0 position-relative">
	<div class="position-relative">
		@set('promoted', !empty($material->promotion) && ($material->promotion->status ?? '') == 'active')
		<div class="position-absolute d-flex w-100" style="z-index: 2; top: 20px; left: 20px;">
			<div class="dropdown">
	            <a href="javascript:;" class="align-items-center d-flex text-decoration-none
	            " id="promote-{{ $material->id }}" data-toggle="dropdown">
	                <small class="{{ $promoted ? 'bg-success' : 'bg-main-dark' }} tiny-font px-3 py-1 text-white">
	                	{{ $promoted ? 'Promoted' : 'Promote' }}
	                	<i class="icofont icofont-caret-down"></i>
	                </small>
	            </a>
	            <div class="dropdown-menu border-0 shadow-sm dropdown-menu-left" aria-labelledby="promote-{{ $material->id }}" style="width: 210px !important;">
	            	@if($promoted)
	            		@set('timing', \App\Helpers\Timing::calculate($material->promotion->duration, $material->promotion->expiry, $material->promotion->started))
	            		<div class="px-3 py-1 w-100">
	            			<div class="d-flex">
	            				<div class="mr-2">
						            <small class="text-success">
						                ({{ $timing->progress() }}%)
						            </small>
						        </div>
		            	 		<div class="">
		            	 			<small class="">
					                    {{ $timing->daysleft() }} Day(s) Left
					                </small>
		            	 		</div>
	            			</div>
	            		</div>
	            	@else
	            		<div class="p-4 bg-white">
		            		@if($material->images()->exists())
			            		@set('params', ['model_id' => $material->id, 'type' => 'material'])
				            	@include('user.promotions.partials.promote')
				            @else
				            	<div class="alert alert-danger mb-0">Please upload image before promoting</div>
			            	@endif
			            </div>
					@endif
	            </div>
	        </div>
	        <div class="bg-{{ $material->status !== 'active' ? 'danger' : 'success' }} tiny-font px-3 py-1 text-white ml-3">
	        	{{ ucfirst($material->status) }}
	        </div>
		</div>
		<div style="height: 160px; line-height: 160px;">
			@if($material->images()->exists())
				@foreach($material->images as $image)
					@if($image->role == 'main')
						<a href="{{ route('user.material.edit', ['id' => $material->id]) }}" class="text-decoration-none">
							<img src="{{ $image->link }}" class="img-fluid border-0 w-100 h-100 object-cover">
						</a>
					@endif
				@endforeach
			@else
				<a href="javascript:;" class="text-decoration-none">
					<img src="/images/banners/placeholder.png" class="img-fluid border-0 w-100 h-100 object-cover">
				</a>
			@endif
		</div>
		<div class="position-absolute w-100 px-3 border-top d-flex align-items-center justify-content-between" style="height: 45px; line-height: 45px; bottom: 0; background-color: rgba(0, 0, 0, 0.8);">
			<small class="text-white">
				{{ \Str::limit(ucwords($material->city), 8) }}
			</small>
			<small class="text-white">
				{{ \Str::limit(ucwords($material->country->name), 8) }}
			</small>
		</div>
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between align-items-center">
			<a href="{{ route('user.material.edit', ['id' => $material->id]) }}" class="text-underline text-main-dark">
				<div class="">
					{{ \Str::limit($material->name, 14) }}
				</div>
			</a>
			<div class="text-main-dark">
				{{ $material->currency->symbol ?? 'USD' }}{{ number_format($material->price) }}
			</div>
		</div>
	</div>
	<div class="card-footer bg-theme-color d-flex justify-content-between">
		<small class="text-white">
			{{ $material->created_at->diffForHumans() }}
		</small>
		<a href="{{ route('user.material.edit', ['id' => $material->id]) }}">
			<small class="text-warning">
				<i class="icofont-edit"></i>
			</small>
		</a>
	</div>
</div>