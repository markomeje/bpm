<div class="card border-0 position-relative">
	@set('promoted', !empty($property->promotion) && ($property->promotion->status ?? '') == 'active')
	<div class="position-absolute d-flex w-100" style="z-index: 2; top: 20px; left: 20px;">
		<div class="dropdown">
            <a href="javascript:;" class="align-items-center d-flex text-decoration-none
            " id="promote-{{ $property->id }}" data-toggle="dropdown">
                <small class="{{ $promoted ? 'bg-success' : 'bg-main-dark' }} tiny-font px-3 py-1 text-white">
                	{{ $promoted ? 'Promoted' : 'Promote' }}
                	<i class="icofont icofont-caret-down"></i>
                </small>
            </a>
            <div class="dropdown-menu border-0 shadow-sm dropdown-menu-left" aria-labelledby="promote-{{ $property->id }}" style="width: 210px !important;">
            	@if($promoted)
            		@set('timing', \App\Helpers\Timing::calculate($property->promotion->duration, $property->promotion->expiry, $property->promotion->started))
            		<div class="px-3 py-1 w-100">
            			<div class="d-flex">
            				<div class="mr-2">
					            <small class="text-{{ $timing->progress() <= 90 ? 'success' : 'danger' }}">
					                ({{ $timing->progress() <= 0 ? 1 : $timing->progress() }}%)
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
	            		@if($property->images()->exists() && $property->status == 'active')
		            		@set('params', ['model_id' => $property->id, 'type' => 'property'])
			            	@include('user.promotions.partials.promote')
			            @else
			            	<div class="alert alert-danger mb-0">Please to promote, you have to upload an image and activate.</div>
		            	@endif
		            </div>
				@endif
            </div>
        </div>
        <div class="bg-{{ $property->status !== 'active' ? 'danger' : 'success' }} tiny-font px-3 py-1 text-white ml-3">
        	{{ ucfirst($property->status) }}
        </div>
	</div>
	<div class="position-relative" style="height: 160px; line-height: 160px;">
		@if($property->images()->exists())
			@foreach($property->images()->where(['role' => 'main'])->take(1)->get() as $image)
				<a href="{{ route('user.property.edit', ['category' => $property->category, 'id' => $property->id]) }}" class="text-decoration-none">
					<img src="{{ $image->link }}" class="img-fluid border-0 w-100 h-100 object-cover">
				</a>
			@endforeach
		@else
			<a href="{{ route('user.property.edit', ['category' => $property->category, 'id' => $property->id]) }}" class="text-decoration-none">
				<img src="/images/banners/placeholder.png" class="img-fluid border-0 w-100 h-100 object-cover">
			</a>
		@endif
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
			<a href="{{ route('user.property.edit', ['category' => $property->category, 'id' => $property->id]) }}">
				<small class="text-main-dark text-underline">
					NGN{{ number_format($property->price) }}
				</small>
			</a>
			<a href="{{ route('user.property.edit', ['category' => $property->category, 'id' => $property->id]) }}">
				<small class="text-main-dark text-underline">
					{{ ucwords($property->category) }}
				</small>
			</a>	
		</div>
		<div class="d-flex justify-content-between align-items-center">
			<a href="{{ route('user.property.edit', ['category' => $property->category, 'id' => $property->id]) }}" class="text-underline text-main-dark">
				<small class="">
					{{ \Str::limit($property->address, 12) }}
				</small>
			</a>
			<?php $action = strtolower($property->action ?? 'nill'); $actions = \App\Models\Property::$actions; ?>
			<div class="dropdown">
                <small id="change-action-{{ $property->id }}" data-toggle="dropdown" class="{{ $action === 'sold' ? 'text-danger' : 'text-info' }} cursor-pointer text-underline">
					{{ ucwords($actions[$action] ?? 'nill') }} <i class="icofont icofont-caret-down position-relative"></i>
				</small>
                <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="change-action-{{ $property->id }}">
                	<form method="post" class="p-4 w-100 change-property-action-form" action="javascript:;" style="width: 210px !important;" data-action="{{ route('user.property.action.change', ['id' => $property->id]) }}">
					    <div class="form-group">
					      	<label class="text-muted">Change action</label>
					      	<select class="custom-select action" name="action">
					      		@if(empty($actions))
					      			<option value="">No action listed</option>
					      		@else
					      			<?php unset($actions[$action]); ?>
					      			<option value="">Select action</option>
					      			@foreach($actions as $key => $value)
					      				<option value="{{ $key }}">
					      					{{ ucwords($value) }}
					      				</option>
					      			@endforeach
					      		@endif
					      	</select>
					      	<span class="invalid-feedback action-error"></span>
					    </div>
					    <div class="alert mb-3 tiny-font change-property-action-message d-none"></div>
	                    <div class="d-flex justify-content-right mb-3 mt-1">
	                        <button type="submit" class="btn btn-info btn-lg btn-block change-property-action-button">
	                            <img src="/images/spinner.svg" class="mr-2 d-none change-property-action-spinner mb-1">
	                            Save
	                        </button>
	                    </div>
					</form>
                </div>
            </div>
		</div>
	</div>
	<div class="card-footer bg-main-dark d-flex justify-content-between">
		<small class="text-white">
			{{ $property->created_at->diffForHumans() }}
		</small>
		<div class="d-flex align-items-center">
			<small class="text-danger cursor-pointer mr-2 delete-property" data-url="{{ route('user.property.delete', ['id' => $property->id]) }}" data-message="Are you sure to permanently delete this property?">
				<i class="icofont-trash"></i>
			</small>
			<a href="{{ route('user.property.edit', ['category' => $property->category, 'id' => $property->id]) }}">
				<small class="text-warning">
					<i class="icofont-edit"></i>
				</small>
			</a>
		</div>
			
	</div>
</div>