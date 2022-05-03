<div class="card rounded border-0">
	<div class="card-body">
		<div class="d-flex align-items-center justify-content-between">
            <a href="javascript:;" class="text-main-dark d-flex align-items-center text-underline" data-toggle="modal" data-target="#edit-skill-{{ $skill->id }}">
                <small class="text-dark">{{ ucwords($skill->name ?? 'Nill') }}</small>
            </a>
            {{-- <div class="custom-control custom-switch">
                <input class="custom-control-input skill-status" type="checkbox" data-url='{{ '' }}' id="status-{{ $skill->id }}" {{ $skill->status ? 'checked' : '' }} data-status="{{ $skill->status }}">
                <label class="custom-control-label" for="status-{{ $skill->id }}"></label>
            </div> --}}
           	<a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#edit-skill-{{ $skill->id }}">
				<small class="text-warning px-2 py-1 rounded-pill bg-main-ash">
					<i class="icofont-edit"></i>
				</small>
			</a>
		</div>
	</div>
</div>