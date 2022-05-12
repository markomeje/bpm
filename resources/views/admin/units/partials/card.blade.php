<div class="card card-raduis border-0">
	<div class="card-header d-flex justify-content-between card-raduis pt-4 pb-3 bg-main-dark">
		<div>
			<div class="lg-circle position-relative shadow-sm rounded-circle text-center mb-3" style="background-color: rgba(23, 77, 163, 0.5)">
				<div class="position-relative" style="top: 7px;">
					{{ \Faker\Factory::create()->emoji() }}
				</div>
			</div>
			<h4 class="text-white cursor-pointer" data-toggle="modal" data-target="#edit-unit-{{ $unit->id }}">
				{{ $unit->currency->symbol ?? 'NGN' }}{{ $unit->price }}
			</h4>
		</div>
		<div class="d-flex flex-column">
			<a href="javascript:;" class="d-block sm-circle border border-warning rounded-circle mb-2 text-center text-decoration-none" data-toggle="modal" data-target="#edit-unit-{{ $unit->id }}">
				<small class="text-warning tiny-font">
					<i class="icofont-edit"></i>
				</small>
			</a>
			<a href="javascript:;" class="d-block sm-circle border border-danger rounded-circle mb-2 text-center text-decoration-none delete-unit" data-url="{{ route('admin.unit.delete', ['id' => $unit->id]) }}">
				<small class="text-danger tiny-font">
					<i class="icofont-trash"></i>
				</small>
			</a>
		</div>
	</div>
	<div class="card-body">
		<div class="mb-3">
			<div class="d-flex align-items-center mb-3">
				<div class="sm-circle mr-2 rounded-circle border-main-dark text-center">
					<small class="tiny-font text-main-dark">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
				<div class="text-main-dark">
					{{ $unit->units }} Units
				</div>
			</div>
			<div class="d-flex align-items-center mb-3">
				<div class="sm-circle mr-2 rounded-circle border-main-dark text-center">
					<small class="tiny-font text-main-dark">
						<i class="icofont-tick-mark"></i>
					</small>
				</div>
				<div class="text-main-dark">
					For {{ $unit->duration }} Days
				</div>
			</div>
			<div class="d-flex align-items-center justify-content-between bg-info rounded px-3 py-2">
				<div class="text-white">
					{{ $unit->credits()->exists() ? $unit->credits()->count() : 0 }} Sold
				</div>
				<small class="text-white">
					<i class="icofont-long-arrow-right"></i>
				</small>
			</div>
		</div>	
	</div>
</div>