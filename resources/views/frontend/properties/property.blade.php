@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="property-banner">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-8 col-lg-9">
						<div class="mb-4">
							@empty($property)
								<div class="alert alert-danger">Property No Found</div>
							@else
								<?php $property->views = $property->views + 1; $property->update(); ?>
								<div class="mb-4">
									<h3 class="text-main-dark mb-3">
										{{ retitle($property) }}
									</h3>
									<div class="mb-4 position-relative">
										<div class="position-absolute ml-4 mt-4" style="z-index: 2;">
								            <div class="d-flex align-items-center">
								                @if($property->promoted == true && $property->promotion->status ?? '' == 'active')
								                    <small class="bg-success text-white tiny-font px-3 py-1 mr-3">Promoted</small>
								                @endif
								                <small class="bg-info text-white tiny-font px-3 py-1 mr-3">
								                	{{ $property->views }} views
								                </small>
								                <?php $action = strtolower($property->action); $actions = \App\Models\Property::$actions; ?>
								                @if(isset($actions[$action]))
								                    <small class="bg-theme-color tiny-font text-white px-3 py-1 mr-3">{{ ucwords($actions[$action]) }}
								                        </small></small>
								                @endif
								                <div class="dropdown">
								                    <a href="javascript:;" class="d-block text-decoration-none" id="share-dropdown" data-toggle="dropdown" aria-expanded="false">
								                        <small class="bg-white border text-theme-color rounded cursor-pointer px-2 py-1">
								                            <i class="icofont-share"></i>
								                        </small>
								                    </a>
								                    <div class="dropdown-menu border-0 p-0 m-0 shadow-sm dropdown-menu-right" aria-labelledby="share-dropdown">
								                        @set('socials', ['twitter', 'facebook', 'linkedin', 'whatsapp', 'telegram'])
								                        <div class="d-flex align-items-center justify-content-between p-3 text-center">
								                            @if(empty($socials))
								                                <div class="alert alert-danger m-0">No social handles</div>
								                            @else
								                                @set('categories', \App\Models\Property::$categories)
                                								@set('last', array_values($socials))
								                                @foreach($socials as $social)
								                                    <div class="p-2 {{ end($last) == $social ? '' : 'mr-2' }} border-theme-color text-decoration-none  text-theme-color" data-sharer="{{ $social }}" data-title="Checkout this {{ $categories[$property->category]['name'] }}" data-hashtags="bestpropertymarket, realestate, globalproperties, lands, buildings" data-url="{{ route('property.category.id.slug', ['category' => $property->category, 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}">
								                                        <div class="tiny-font">
								                                            <i class="icofont-{{ $social }}"></i>
								                                        </div>
								                                    </div>
								                                @endforeach
								                            @endif 
								                        </div>
								                        
								                    </div>
								                </div>
								            </div>
								        </div>
								        @if($property->images()->exists())
									        @foreach($property->images()->where(['role' => 'main'])->take(1)->get() as $image)
										       <a href="{{ $image->link }}" class="mb-4 d-block">
													<img src="{{ $image->link }}" class="img-fluid w-100 border" data-role="{{ $image->role }}">
										        </a>
									        @endforeach
									    @else
									    	<a href="/images/banners/placeholder.png" style="height: 340px;" class="mb-4 d-block">
												<img src="/images/banners/placeholder.png" class="img-fluid w-100 h-100 border object-cover">
									        </a>
								        @endif
									</div>
									@if($property->images()->exists())
							        	<div class="row">
							        		@foreach($property->images()->where(['role' => 'others'])->take(4)->get() as $image)
							        			<div class="col-6 col-md-3 mb-4">
							        				<a href="{{ $image->link }}" style="height: 160px;">
							        					<img src="{{ $image->link }}" class="img-fluid w-100 h-100 border" data-role="{{ $image->role }}">
							        				</a>
							        			</div>
							        		@endforeach
							        	</div>
							        @endif
									<div class="row">
										<div class="col-12 col-md-6 mb-4">
							            	<div class="">
							            		<h4 class="text-theme-color mb-4 pb-3 border-bottom">
								                    Price {{ $property->currency ? $property->currency->symbol : 'NGN' }}{{ number_format($property->price) }}
								                </h4>
												<div class="text-main-dark d-block mb-4">
													Located at {{ ucwords($property->address) }}
												</div>
												<div class="text-main-dark d-block mb-4 p-3 bg-white">
													Listed By {{ ucwords($property->user->name) }}
												</div>
												@if($property->category !== 'land')
													<div class="d-flex align-items-center d-block mb-4">
														<div class="mr-3">
															<small class="text-theme-color">
																<i class="icofont-bucket text-theme-color"></i>
															</small>
															{{ empty($property->toilets) ? 0 : $property->toilets }} Toilets
														</div>
														<div class="mr-3">
															<span class="text-theme-color">
																<i class="icofont-bathtub"></i>
															</span>{{ empty($property->bathrooms) ? 0 : $property->bathrooms }} Bathrooms
														</div>
														<div class="">
															<span class="text-theme-color">
																<i class="icofont-cube"></i>
															</span>{{ empty($property->measurement) ? 0 : $property->measurement }}
														</div>
													</div>
												@endif
											</div>
											<div class="px-4 pt-4 bg-white border rounded">
							            		<div class="row">
								            		@if($property->user)
								            			<div class="col-3 col-md-4 col-lg-2 mb-4">
								            				<a href="tel:{{ $property->user->phone }}" class="text-center border-theme-color d-block py-2 text-theme-color text-decoration-none">
										            			<i class="icofont-phone"></i>
										            		</a>
								            			</div>
										            	<div class="col-3 col-md-4 col-lg-2 mb-4">	
										            		<a href="mailto:{{ $property->user->email }}" class="text-center border-theme-color d-block py-2 text-theme-color text-decoration-none rounded">
										            			<i class="icofont-email"></i>
										            		</a>
										            	</div>
										            	@if($property->user->socials()->exists())
										            		@foreach($property->user->socials as $social)
											            		<div class="col-3 col-md-4 col-lg-2 mb-4">
											            			<a href="{{ $social->company == 'whatsapp' ? "tel:$social->phone" : $social->link }}" class="text-center border-theme-color d-block py-2 text-theme-color text-decoration-none rounded">
												            			<i class="icofont-{{ $social->company }}"></i>
												            		</a>
												            	</div>
										            		@endforeach
										            	@endif
									            	@endif
								            	</div>
							            	</div>
							            </div>
							            <div class="col-12 col-md-6">
							            	<div class="mb-3">
									        	<p class="text-main-dark">Description</p>
												<div class="text-main-dark">
													{{ $property->additional }}
												</div>
									        </div>
							            </div>
							        </div>
								</div>
							@endempty
						</div>
						<div class="">
							<div class="alert alert-info mb-4">Related Properties</div>
							@empty($related->count())
								<div class="alert alert-danger">No Related Properties</div>
							@else
								<div class="row">
									@foreach($related as $property)
										<div class="col-12 col-md-6 col-lg-4 mb-4">
											@include('frontend.properties.partials.card')
										</div>
									@endforeach
								</div>
							@endempty
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-3">
						<div class="mb-4">
				            @include('frontend.properties.partials.categories')
			            </div>
			            <div class="">
			            	@include('frontend.adverts.partials.sidebar')
			            </div>
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')