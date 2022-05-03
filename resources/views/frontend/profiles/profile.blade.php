@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="position-relative" style="padding: 140px 0;">
			<div class="container-fluid">
				@if(empty($profile))
					<div class="alert alert-info">Profile Not Found</div>
				@else
					<div class="row">
						<div class="col-12 col-md-4 col-lg-3">
							<div class="mb-4 p-sm-5 p-lg-5 p-md-4 rounded icon-raduis bg-white shadow-sm text-center">
								<div class="bg-main-ash" style="height: 160px;">
									<img src="{{ empty($profile->image) ? '/images/avatar.jpg' : $profile->image->link }}" class="img-fluid w-100 h-100 rounded border object-cover">
								</div>
							</div>
							<div class="mb-4">
								<div class="d-flex align-items-center mb-4 pb-3 border-bottom">
									<div class="">
										<h5 class="text-main-dark mb-0">
											{{ ucwords($profile->user->name) }} 
											@set('roles', \App\Models\Profile::$roles)
											@if(!empty($roles))
												@foreach($roles as $role => $description)
													@foreach($description as $key => $value)
														@if($profile->role == $role && $profile->code == $value['code'])
																({{ ucwords($value['name']) }})
														@endif
													@endforeach
												@endforeach
											@endif
										</h5>
									</div>
								</div>
								@if($profile->role == 'artisan')
									@if($profile->user->services()->exists())
										@foreach($profile->user->services->take(5) as $service)
											<div class="d-flex flex-wrap">
												<small class="px-3 py-1 bg-success text-white rounded-pill mb-4 mr-2">
													{{ $service->skill->name ?? '' }}
												</small>
											</div>
										@endforeach
									@endif
								@endif
								<div class="text-main-dark mb-4">
									{{ ucfirst($profile->description) }}
								</div>
								<div class="">
									<div class="row">
										<div class="col-4 mb-3">
											<a href="{{ empty($profile->phone) ? 'javascript:;' : 'tel:'.$profile->phone }}" class="btn border-theme-color text-theme-color btn-block">
												<small class="">
													<i class="icofont-phone"></i>
												</small>
											</a>
										</div>
										<div class="col-4 mb-3">
											<a href="{{ empty($profile->email) ? 'javascript:;' : 'mailto:'.$profile->email }}" class="btn border-theme-color text-theme-color btn-block">
												<span class="">
													<i class="icofont-send-mail"></i>
												</span>
											</a>
										</div>
										<div class="col-4 mb-3">
											<a href="{{ empty($profile->website) ? 'javascript:;' : $profile->website }}" class="btn border-theme-color text-theme-color btn-block" target="_blank">
												<small class="">
													<i class="icofont-web"></i>
												</small>
											</a>
										</div>
									</div>
									<p class="">
										<small class="text-theme-color">
											<i class="icofont-location-pin"></i>
										</small>
										<small class="text-main-dark">
											{{ ucwords($profile->city).', '.ucwords($profile->state) }}
										</small>
									</p>
									@if($profile->user->socials()->exists())
										<div class="d-flex align-items-center justify-content-between icon-raduis bg-white shadow-sm w-100 p-3">
											@foreach($profile->user->socials->take(5) as $social)
												<a href="{{ ($social->company == 'whatsapp' || $social->company == 'telegram') ? "tel:{$social->phone}" : $social->link }}" class="text-center bg-theme-color rounded-circle border text-decoration-none" style="height: 35px; width: 35px; line-height: 30px;">
													<small class="text-white">
														<i class="icofont-{{ $social->company }}"></i>
													</small>
												</a>
											@endforeach
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="col-12 col-md-8 col-lg-6">
							@if($profile->role == 'artisan')
								@if($profile->user->services()->exists())
									@set('services', $profile->user->services->take(5))
									<div class="alert alert-info mb-4">My Services</div>
									<div class="row">
										@foreach($services as $service)
											<div class="col-12 mb-4">
												@include('frontend.services.partials.card')
											</div>
										@endforeach
									</div>
								@else
									<div class="alert alert-danger">No Services Available</div>
								@endif
							@elseif($profile->role == 'realtor')
								@if($profile->user->properties()->exists())
									@set('properties', $profile->user->properties)
									<div class="alert alert-info mb-4">
										{{ $properties->count() }} Properties Listed
									</div>
									<div class="row">
										@foreach($properties as $property)
											<div class="col-12 col-md-6 col-lg-6 mb-4">
												@include('frontend.properties.partials.card')
											</div>
										@endforeach
									</div>
								@else
									<div class="alert alert-danger">No Properties Available</div>
								@endif
							@elseif($profile->role == 'dealer')
								@if($profile->user->materials()->exists())
									@set('materials', $profile->user->materials->take(5))
									<div class="alert alert-info mb-4">
										{{ $materials->count() }} Materials Listed
									</div>
									<div class="row">
										@foreach($materials as $material)
											<div class="col-6 col-md-6 col-lg-4 mb-4">
												@include('frontend.materials.partials.card')
											</div>
										@endforeach
									</div>
								@else
									<div class="alert alert-danger">No Materials Available</div>
								@endif
							@endif
						</div>
						<div class="col-12 col-md-12 col-lg-3">
							<div class="">
								<div class="alert alert-info d-flex justify-content-between mb-4">
									<div class="">Recent Reviews ({{ $profile->reviews()->count() }})</div>
									<a class="text-decoration-none" href="javascript:;" data-toggle="modal" aria-haspopup="true" aria-expanded="false" data-target="#add-review">
			                           <small class="">
			                                <i class="icofont-plus"></i>
			                            </small>
			                        </a>
			                        @include('frontend.reviews.partials.add')
								</div>
								@if(!auth()->check())
									<div class="alert alert-danger mb-4">Please login to review this profile.</div>
								@endif
								<div class="">
									@if(empty($profile->reviews()->count()))
										<div class="alert alert-danger mb-4">No reviews yet</div>
									@else
										@set('reviews', $profile->reviews->shuffle()->take(5))
										<div class="row">
											@foreach($reviews as $review)
												<div class="col-12 mb-4">
													@include('frontend.reviews.partials.card')
												</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')