<div class="card border-0 card-raduis">
	<div class="card-header py-4 bg-main-dark position-relative"> 
		<div class="text-white">
			{{ ucfirst($membership->name) }} {{ ucwords($membership->package ? $membership->package->name : 'Membership') }}
		</div>
        {{-- <h4 class="font-weight-bolder text-white">
            {{ $membership->currency->symbol ?? 'NGN' }}{{ number_format($membership->price) }}
        </h4> --}}
        <div class="rounded-pill position-absolute bg-warning px-3 py-1" style="bottom: -12px; right: 20px;">
			<div class="tiny-font">
				+{{ $membership->subscriptions->count() }} Subs
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="">
        <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
				<div class="sm-circle mr-2 bg-info text-center rounded-circle">
					<small class="text-white tiny-font">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
				<div class="mr-2">
					{{ $membership->currency ? $membership->currency->symbol : 'NGN' }}{{ number_format($membership->price) }}
				</div>
				<div class="">
                    {{ $membership->duration }}{{ $membership->duration > 1 ? 'days' : 'day' }}
                </div>
			</div>
			<div class="d-flex align-items-center mb-4 pb-4 border-bottom">
				<div class="sm-circle mr-2 bg-info text-center rounded-circle">
					<small class="text-white tiny-font">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
				<div class="mr-2">
					{{ $membership->paidlisting }}
				</div>
				<div class="">Paid Listing</div>
			</div>
			{{-- <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
				<div class="sm-circle mr-2 bg-info text-center rounded-circle">
					<small class="text-white tiny-font">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
				<div class="mr-2">
					{{ $membership->freeboost }}days
				</div>
				<div class="">Free Boost</div>
			</div> --}}
			<div class="d-flex align-items-center">
				<div class="sm-circle mr-2 bg-info text-center rounded-circle">
					<small class="text-white tiny-font">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
				<div class="mr-2">
					{{ $membership->freelisting }}
				</div>
				<div class="">Free Listing</div>
			</div>
		</div>
	</div>
	<div class="card-footer d-flex justify-content-between bg-theme-color border-0">
		<small class="text-white">
			{{ $membership->created_at->diffForHumans() }}
		</small>
		<div class="">
			<small class="text-warning cursor-pointer" data-toggle="modal" data-target="#edit-membership-{{ $membership->id }}">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>