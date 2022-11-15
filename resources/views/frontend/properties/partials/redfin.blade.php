<div class="card border-0 bg-white w-100 card-raduis position-relative">
    <?php $propertyId = $property['propertyId'] ?? 0; $type = $property['propertyType']; $city = strtolower($address['city'] ?? ''); $state = strtolower($address['state'] ?? ''); $street = strtolower($address['formattedStreetLine'] ?? '') ?>
    <a href="{{ route('global.properties', ['propertyId' => $propertyId, 'region_id' => $region_id ?? 30749, 'region_type' => $region_type ?? 11, 'status' => $status ?? '1', 'limit' => $limit ?? 12, 'listingId' => $listingId ?? 0]) }}" class="card-img-top d-block position-relative" style="height: 280px;">
        <img src="{{ $photos['posterFrameUrl'] }}" class="img-fluid h-100 w-100 object-cover">
    </a>
    <div class="card-body">
        <div class="position-relative d-flex mb-3">
            <a href="{{ route('global.properties', ['propertyId' => $propertyId, 'region_id' => $region_id ?? 30749, 'region_type' => $region_type ?? 11, 'status' => $status ?? '1', 'limit' => $limit ?? 12, 'listingId' => $listingId ?? 0]) }}" class="text-main-dark text-underline font-weight-bolder">
                {{ \Str::limit((ucwords(strtolower(implode(' ', explode('_', $type)))).' Located at '.$address['formattedStreetLine'].' '.$address['city']), 45) }}
            </a>
        </div>
        <div class="d-flex justify-content-between">
            <h4 class="text-theme-color mb-2">
                ${{ number_format($property['priceInfo']['homePrice']['int64Value']) }}
            </h4>
        </div>
        <div class="d-flex align-items-center">
            <div class="text-theme-color">
                <i class="icofont-location-pin"></i>
            </div>
            <a href="{{ route('global.properties', ['propertyId' => $propertyId, 'region_id' => $region_id ?? 30749, 'region_type' => $region_type ?? 11, 'status' => $status ?? '1', 'limit' => $limit ?? 12, 'listingId' => $listingId ?? 0]) }}" class="text-underline text-main-dark">
                {{ ucwords($city) }}, {{ $address['countryCode'] ? str_replace('_', ' ', $address['countryCode']) : 'United States' }}
            </a>
        </div>
    </div>
    <?php $agentData = \App\Helpers\Redfin::agent($propertyId, $listingId); ?>
    @if(!empty($agentData['agent']))
        <?php $agent = (array)$agentData['agent']; ?>
        <div class="card-footer bg-dark d-flex justify-content-between align-items-center" style="border-radius: 0 0 15px 15px;">
            <div>
                <div class="rounded-circle lg-circle m-0 d-block">
                    <div class="p-1 m-0 border border-secondary rounded-circle w-100 h-100">
                        @if(empty($agent['agentHeroPhoto']))
                            <div class="w-100 h-100 border border-secondary rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                                <small class="text-white">
                                    {{ substr(strtoupper($agent['agent']['name']), 0, 1) }}
                                </small>
                            </div>
                        @else
                            <div class="w-100 h-100 border border-secondary rounded-circle text-center">
                                <img src="{{ $agent['agentHeroPhoto'] }}" class="img-fluid w-100 h-100 rounded-circle">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a href="tel:{{ $agent['phoneNumber'] }}" class="text-decoration-none position-relative d-block md-circle rounded-circle border text-center mr-3">
                    <div class="position-absolute rounded-circle bg-success" style="height: 18px; width: 18px; top: 2px; right: 80%;"></div>
                    <div class="text-success " style="margin-top: 2px;">
                        <i class="icofont-phone"></i>
                    </div>
                </a>
                <a href="tel:{{ $agent['profilePhoneNumber'] }}" class="text-decoration-none d-block md-circle rounded-circle border text-center">
                    <div class="text-white" style="margin-top: 2px;">
                        <i class="icofont-phone"></i>
                    </div>
                </a>
            </div>
        </div>
    @endif
</div>