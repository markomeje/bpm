<?php $category = strtolower($property->category); ?>
<div class="card border-0 position-relative">
	@set('promoted', !empty($property->promotion) && ($property->promotion->status ?? '') == 'active')
	<div class="position-absolute d-flex w-100" style="z-index: 2; top: 20px; left: 20px;">
		<div class="bg-{{ $property->status !== 'active' ? 'danger' : 'success' }} tiny-font px-3 py-1 text-white mr-3">
        	{{ ucfirst($property->status) }}
        </div>
        @if(auth()->id() == $property->user_id)
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
       	@else
       		@if($promoted)
				<div class="bg-success tiny-font px-3 py-1 text-white">Promoted</div>
        	@endif
	    @endif
	</div>
	<div class="position-relative" style="height: 160px; line-height: 160px;">
		@if($property->images()->exists())
			@foreach($property->images as $image)
				@if($image->role == 'main')
					<a href="{{ route('admin.property.edit', ['id' => $property->id, 'category' => $category]) }}" class="text-decoration-none">
						<img src="{{ $image->link }}" class="img-fluid border-0 w-100 h-100 object-cover">
					</a>
				@endif
			@endforeach
		@else
			<a href="{{ route('admin.property.edit', ['id' => $property->id, 'category' => $category]) }}" class="text-decoration-none">
				<img src="/images/banners/placeholder.png" class="img-fluid border-0 w-100 h-100 object-cover">
			</a>
		@endif
		<div class="position-absolute w-100 px-3 border-top d-flex align-items-center justify-content-between" style="height: 45px; line-height: 45px; bottom: 0; background-color: rgba(0, 0, 0, 0.75);">
			<a href="{{ route('admin.user.profile', ['id' => $property->user->id ?? 0]) }}" class="text-underline text-white">
				<small class="">
					By {{ \Str::limit($property->user->name ?? '', 6) }}
				</small>
			</a>
			<a href="{{ route('admin.properties.country', ['countryid' => $property->country->id ?? 0]) }}" class="text-underline text-white">
				<small class="text-white">
					{{ \Str::limit($property->country->name ?? '', 6) }}
				</small>
			</a>
		</div>
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
			<a href="{{ route('admin.properties.category', ['category' => $category]) }}" class="text-underline text-dark">
				<small class="">
					{{ \Str::limit(ucfirst($category), 6) }}
				</small>
			</a>
			@set('actions', \App\Models\Property::$actions)
			@set('action', strtolower($property->action ?? 'nill'))
			<small class="">
				<a href="{{ route('admin.properties.action', ['action' => $action]) }}" class="text-underline text-{{ $action === 'sold' ? 'danger' : 'info' }}">
					{{ ucwords($actions[$action]) }}
				</a>
			</small>
		</div>
		<div class="d-flex justify-content-between align-items-center">
			<a href="{{ route('admin.property.edit', ['category' => $category, 'id' => $property->id]) }}" class="text-underline text-main-dark">
				<small class="">
					{{ \Str::limit($property->address, 10) }}
				</small>
			</a>
			<div class="dropdown">
                <a href="javascript:;" class="text-main-dark text-underline" id="status-{{ $property->id }}" data-toggle="dropdown">
                    <small class="">
                    	<i class="icofont icofont-caret-down"></i>
                    </small>
                </a>
                <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="status-{{ $property->id }}">
                	<form method="post" class="p-4 w-100 change-property-action-form" action="javascript:;" style="width: 210px !important;" data-action="{{ route('admin.property.action.change', ['id' => $property->id]) }}">
					    <div class="form-group">
					      	<label class="text-muted">Change action</label>
					      	<select class="custom-select action" name="action">
					      		@if(empty($actions))
					      			<option value="">No action listed</option>
					      		@else
					      			<option value="">Select action</option>
					      			@foreach($actions as $key => $value)
					      				@if($key !== $action)
						      				<option value="{{ $key }}" {{ $action == $key ? 'selected' : '' }}>
						      					{{ ucwords($value) }}
						      				</option>
					      				@endif
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
	<div class="card-footer d-flex justify-content-between align-items-center bg-main-dark">
		<small class="text-white">
			{{ $property->created_at->diffForHumans() }}
		</small>
		<a href="{{ route('admin.property.edit', ['id' => $property->id, 'category' => $category]) }}">
			<small class="text-warning">
				<i class="icofont-edit"></i>
			</small>
		</a>
	</div>
</div>