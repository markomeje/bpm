<div class="card card-raduis">
	<div style="height: 120px;">
		<img src="{{ env('COUNTRY_FLAG_URL') }}/h120/{{ strtolower($country->iso2 ?? 'ng') }}.png" class="img-fluid object-cover border h-100 w-100">
	</div>
	<div class="card-body">
		<div class="d-flex align-items-center justify-content-between">
			<div class="dropdown">
                <a href="javascript:;" class="d-flex align-items-center text-underline" data-toggle="dropdown">
                    <small class="text-dark">
                    	{{ ucwords(\Str::limit($country->name, 5) ?? 'Nill') }}
                    </small>
                    <small class="text-muted position-relative">
                    	<i class="icofont icofont-caret-down"></i>
                    </small>
                </a>
                <div class="dropdown-menu border-0 shadow dropdown-menu-left">
                	<div class="dropdown-item">
                		<small class="text-dark">
                			{{ ucwords($country->name) ?? 'Nill' }}
                		</small>
                	</div>
                </div>
            </div>
            <a href="{{ route('admin.properties.country', ['countryid' => strtolower($country->id)]) }}" class="text-underline text-dark">
				<small class="">
	            	({{ $country->properties->count() ?? '0' }}) listing
	            </small>
            </a>
		</div>
	</div>
</div>