<div class="card border-0">
	<div class="card-body">
		<div class="mb-4 d-flex justify-content-between pb-4 border-bottom align-items-center">
			<div class="text-main-dark text-underline cursor-pointer" data-toggle="modal" data-target="#edit-content-{{ $content->id }}">
				{{ ucfirst(Str::limit($content->content, 18)) }}
			</div>
			<div class="text-main-dark">
				{{ ucfirst($content->status) }}
			</div>
		</div>
		<div class="d-flex justify-content-between align-items-center">
			<div class="text-main-dark">
				{{ ucfirst($content->page) }} page
			</div>
			<div class="text-main-dark">
				Section {{ ucfirst($content->section) }}
			</div>	
		</div>
	</div>
	<div class="card-footer d-flex justify-content-between bg-theme-color border-0">
		<small class="text-white">
			{{ $content->created_at->diffForHumans() }}
		</small>
		<div class="">
			<small class="text-warning cursor-pointer" data-toggle="modal" data-target="#edit-content-{{ $content->id }}">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>