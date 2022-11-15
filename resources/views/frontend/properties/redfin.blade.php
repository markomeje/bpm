@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="property-banner">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-lg-9">
						<div class="mb-4">
							<?php $listingId = request()->get('listingId'); $region_type = request()->get('region_type'); $region_id = request()->get('region_id'); $status = request()->get('status'); $limit = request()->get('limit'); $redfinProperties = \App\Helpers\Redfin::properties(['region_id' => $region_id, 'region_type' => $region_type, 'status' => $status, 'num_homes' => $limit]); ?>
							@if(empty($redfinProperties['properties']))
								<div class="alert alert-danger mb-4">Property Not Found</div>
							@else
								<?php $singleProperty = array_filter($redfinProperties['properties'], function ($property) use($propertyId, $listingId) {
									$property = $property['homeData'] ?? [];
							    	return ($propertyId == $property['propertyId'] ?? 0) && ($property['listingId']['value'] == $listingId ?? 0);
								}); ?>
                                @if(empty($singleProperty))
                                	<div class="alert alert-danger mb-4">The requested Property Not Found</div>
                               	@else
                                	<?php $property = array_values($singleProperty); $property = $property[0] ? ($property[0]['homeData'] ?? []) : []; $type = $property['propertyType']; ?>
                                	@if(($propertyId == $property['propertyId'] ?? 0) && ($listingId == $listingId ?? 0))
                                		<?php $formattedType = strtolower(implode(' ', explode('_', $type))); ?>
                                        <div class="mb-4">
                                            <?php $address = $property['addressInfo'] ?? []; $type = $property['propertyType']; $photos = $property['photosInfo']; ?>
                                            <h3 class="mb-4">
                                            	{{ (ucwords($formattedType).' Located at '.$address['city'].' '.$address['state']).' '.str_replace('_', ' ', $address['countryCode']) }}
                                            </h3>
                                            <a href="{{ $photos['scanUrl'] }}" class="shadow d-block border mb-4" style="height: 380px;">
                                            	<img src="{{ $photos['posterFrameUrl'] }}" class="img-fluid h-100 w-100 object-cover">
                                            </a>
                                            <div class="row">
                                            	<div class="col-12 col-lg-7">
                                            		<h3 class="text-theme-color mb-3">
                                            			Price ${{ number_format($property['priceInfo']['homePrice']['int64Value']) }}
                                            		</h3>
                                            		<div class="bg-white mb-3 p-4">
                                            			Address: {{ ucwords('Located At '.$address['city'].' '.$address['state']) }}
                                            		</div>
                                            		<?php $propertyMainInfo = \App\Helpers\Redfin::property($propertyId, $listingId); $mainHouseInfo = (array)$propertyMainInfo['property']['mainHouseInfo'] ?>
                                            		<div class="mb-3">
                                            			{{ $property['beds']['value'] }} Bedrooms, {{ $property['baths']['value'] }} Bathrooms. Built {{ $property['yearBuilt']['yearBuilt']['value'] }}
                                            		</div>
                                            		<div class="mb-4 text-dark">
                                            			{{ $mainHouseInfo['marketingRemarks'][0]['marketingRemark'] }}
                                            		</div>
                                            	</div>
                                            	<div class="col-12 col-lg-5">
                                            		<div class="p-4 card-raduis bg-white">
	                                            		<?php $agentData = \App\Helpers\Redfin::agent($propertyId, $listingId); ?>
													    @if(!empty($agentData['agent']))
													        <?php $agent = (array)$agentData['agent']; $personalData = $agent['agent'] ?? []; ?>
													        <div class="">
													        	<h4 class="text-dark">Agent Details</h4>
													        </div>
													        <div class="mb-3">
													        	{{ ucwords($personalData['displayName']) }} from {{ ucwords($agent['city']) }}
													        </div>
												            <div class="d-flex align-items-center">
												                <a href="tel:{{ $agent['phoneNumber'] }}" class="text-decoration-none position-relative d-block md-circle rounded-circle border border-success text-center mr-3">
												                    <div class="text-success " style="margin-top: 3px;">
												                        <i class="icofont-phone"></i>
												                    </div>
												                </a>
												                <a href="tel:{{ $agent['profilePhoneNumber'] }}" class="text-decoration-none d-block md-circle rounded-circle border border-secondary text-center">
												                    <div class="text-dark" style="margin-top: 3px;">
												                        <i class="icofont-phone"></i>
												                    </div>
												                </a>
												            </div>
													    @endif
												    </div>
                                            	</div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="mt-2">
                                	<div class="alert alert-info mb-4">Related Properties</div>
	                                <div class="row">
	                            		@foreach($redfinProperties['properties'] as $property)
	                            			<?php $property = $property['homeData']; $photos = $property['photosInfo'] ?? []; ?>
	                            			@if(!empty($photos['posterFrameUrl']))
		                                		@if($property['propertyId'] !== $propertyId)
		                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
		                                                <?php $address = $property['addressInfo'] ?? []; $listingId = $property['listingId']['value'] ?? 0; ?>
		                                                @include('frontend.properties.partials.redfin')
		                                            </div>
		                                        @endif
	                                        @endif
	                            		@endforeach
	                                </div>
                                </div>
                            @endif	
						</div>
					</div>
					<div class="col-12 col-lg-3">
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