<div class="card border-0 card-raduis">
	<div class="card-header py-5 text-center position-relative admin-pricing-card" style="background-image: url(https://picsum.photos/960/1024?random={{ rand(1234, 9075) }}) !important;"> 
		<div class="lg-circle bg-theme-color rounded-circle text-center">
			<div class="text-white position-relative" style="top: 5px;">
				<i class="icofont-server"></i>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="mb-4 d-flex justify-content-between align-items-center">
			<div>
				<div class="text-main-dark mb-3">
					{{ ucfirst($membership->name) }}
				</div>
				<h5 class="font-weight-bolder">
					{{ $membership->currency->symbol ?? 'NGN' }}{{ number_format($membership->price) }}
				</h5>
			</div>
			<small class="px-3 rounded-pill bg-warning">
				<small class="tiny-font">
					+{{ $membership->subscriptions->count() }} <i class="icofont-caret-down"></i>
				</small>
			</small>	
		</div>
		<div class="">
			<div class="d-flex align-items-center mb-4">
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
			<div class="d-flex align-items-center mb-4">
				<div class="sm-circle mr-2 bg-info text-center rounded-circle">
					<small class="text-white tiny-font">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
				<div class="mr-2">
					{{ $membership->freeboost }}days
				</div>
				<div class="">Free Boost</div>
			</div>
			<div class="d-flex align-items-center mb-4">
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