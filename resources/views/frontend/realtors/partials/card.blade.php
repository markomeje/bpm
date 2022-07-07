<div class="card p-0 border-0 shadow-sm position-relative">
	@set('username', empty($realtor->user) ? 'no-name' : $realtor->user->name)
	<div class="position-relative" style="height: 240px;">
		<a href="{{ route('account.profile', ['id' => $realtor->id, 'name' => \Str::slug($username)]) }}" class="text-decoration-none w-100 h-100 d-block">
			<img src="{{ empty($realtor->image) ? '/images/assets/avatar.png' : $realtor->image->link }}" class="img-fluid object-cover h-100 w-100">
		</a>
		<div class="position-absolute w-100 px-4" style="top: 20px; z-index: 2;">
			<div class="d-flex justify-content-between">
				<div class="">
					@if(empty($realtor->user))
						<div class="px-3 py-1 bg-theme-color">
							<small class="text-white">
								No listings
							</small>
						</div>
					@else
						@if($realtor->user->properties()->exists())
							<div class="px-3 py-1 bg-success">
								<small class="text-white counter">
									{{ $realtor->user->properties()->count() }} listing(s)
								</small>
							</div>
						@else
							<div class="px-3 py-1 bg-theme-color">
								<small class="text-white">
									No listings
								</small>
							</div>
						@endif
					@endif
				</div>
				@if(!empty($realtor->user))
					@if($realtor->user->socials()->exists())
	                    <div class="">
	                        @foreach($realtor->user->socials->take(4) as $social)
	                            <a href="{{ ($social->company == 'whatsapp' || $social->company == 'telegram') ? "tel:{$social->phone}" : $social->link }}" class="text-decoration-none sm-circle bg-theme-color text-center d-block mb-3">
	                                <small class="text-white tiny-font">
	                                    <i class="icofont-{{ $social->company }}"></i>
	                                </small>
	                            </a>
	                        @endforeach
	                    </div>
                    @endif
                @endif
			</div>
		</div>
		<div class="position-absolute px-4 py-2 w-100" style="bottom: 0; background-color: rgba(160, 15, 15, 0.5); z-index: 2;">
			<div class="d-flex justify-content-between align-items-center">
				<div class="d-flex align-items-center">
					<div class="text-main-dark mr-2">
						<i class="icofont-location-pin"></i>
					</div>
					<div class="text-white">
						{{ \Str::limit(ucwords($realtor->city), 10) }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body bg-transparent">
		<div class="d-flex align-items-center mb-2">
			<div class="text-center rounded-circle {{ $realtor->certified ? 'bg-success' : 'bg-secondary' }} mr-2 sm-circle">
				<div class="text-white tiny-font mt-1">
					<i class="icofont-tick-mark"></i>
				</div>
			</div>
			<div class="">
				<a href="{{ route('account.profile', ['id' => $realtor->id, 'name' => \Str::slug($username)]) }}" class="text-main-dark">
					{{ \Str::limit(ucwords($username), 14) }}
				</a>
			</div>
		</div>
		<div class="">
			<a href="{{ route('account.profile', ['id' => $realtor->id, 'name' => \Str::slug($username)]) }}">
				<small class="text-main-dark text-underline">
					{{ \Str::limit(ucfirst($realtor->description), 34) }}
				</small>
			</a>
		</div>
	</div>
	<div class="card-footer d-flex justify-content-between bg-white">
		<div class="d-flex align-items-center">
			<a href="{{ empty($realtor->email) ? 'javascript:;' : "mailto:{$realtor->email}" }}" class="text-center mr-2 text-decoration-none sm-circle border text-center rounded-circle">
				<small class="text-success">
					<i class="icofont-email"></i>
				</small>
			</a>
			<a href="{{ empty($realtor->phone) ? 'javascript:;' : "tel:{$realtor->phone}" }}" class="text-center mr-2 text-decoration-none sm-circle border text-center rounded-circle">
				<small class="text-success">
					<i class="icofont-phone"></i>
				</small>
			</a>
			<a href="{{ empty($realtor->website) ? 'javascript:;' : $realtor->website }}" class="text-center mr-2 text-decoration-none sm-circle border text-center rounded-circle" target="_blank">
				<small class="text-success">
					<i class="icofont-web"></i>
				</small>
			</a>
		</div>
		<div>
			<a href="{{ route('account.profile', ['id' => $realtor->id, 'name' => \Str::slug($username)]) }}" class="text-theme-color text-decoration-none">
				<i class="icofont-long-arrow-right"></i>
			</a>
		</div>
	</div>
</div>	