<div class="dealer-col">
<div class="card rounded-0 border-0 position-relative shadow-sm">
	<div class="dealer-shape bg-theme-color position-relative">
		
	</div>
	<div class="position-absolute dealer-position">
		<a href="{{ route('account.profile', ['id' => $dealer->id, 'name' => \Str::slug($dealer->user->name)]) }}">
			<img src="{{ empty($dealer->image) ? '/images/banners/avatar.png' : $dealer->image }}" class="rounded-circle border" style="width: 130px; height: 130px; z-index: 3;" >
		</a>
	</div>
	<div class="card-body pt-0 bg-white">
		<div class="bg-white">
			<div class="mb-3">
				<i class="icofont-user text-theme-color"></i>
				<a href="{{ route('account.profile', ['id' => $dealer->id, 'name' => \Str::slug($dealer->user->name)]) }}" class="text-main-dark" style="color: #a00f0f; font-weight: bold;">
					{{ $dealer->user->name }}
				</a>
			</div>
			<div class="mb-3">
			 	<i class="fas fa-map-marker"></i>
				<a href="{{ route('account.profile', ['id' => $dealer->id, 'name' => \Str::slug($dealer->user->name)]) }}" class="text-main-dark">
					{{ \Str::limit(ucwords($dealer->city), 10) }}
				</a>	
			</div>
			<div class="mb-3">
				<div class="mb-3">
					<a href="{{ route('account.profile', ['id' => $dealer->id, 'name' => \Str::slug($dealer->user->name)]) }}" class="text-main-dark text-underline">
						{{ \Str::limit(ucwords($dealer->description), 26) }}
					</a>	
				</div>
				<a  href="{{ route('account.profile', ['id' => $dealer->id, 'name' => \Str::slug($dealer->user->name)]) }}" class="btn bg-theme-color mb-3 px-3 text-decoration-none text-white">View profile</a>
			</div>
		</div>
		@if($dealer->user->socials()->exists())
            <div class="d-flex align-items-center">
                @foreach($dealer->user->socials->take(4) as $social)
                    <a href="{{ ($social->company == 'whatsapp' || $social->company == 'telegram') ? "tel:{$social->phone}" : $social->link }}" class="text-decoration-none md-circle rounded-circle border-theme-color text-center mr-2 d-block mb-3">
                        <small class="text-main-dark tiny-font">
                            <i class="icofont-{{ $social->company }}"></i>
                        </small>
                    </a>
                @endforeach
            </div>
        @endif
		{{-- <div class="d-flex align-items-center social">
			<a href="javascript:;" class="text-center rounded-circle mr-2 text-decoration-none" style="height: 35px; width: 35px; line-height: 30px; border: 1px solid #a00f0f">
				<small class="text-main-dark">
					<i class="icofont-facebook"></i>
				</small>
			</a>
		</div> --}}
	</div>
</div>
</div>