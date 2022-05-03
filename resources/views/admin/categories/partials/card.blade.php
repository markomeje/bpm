<div class="card border-0 shadow">
	<div class="card-body d-flex align-items-center">
		<a href="javascript:;" class="mr-2" data-toggle="modal" data-target="#edit-category-{{ $category->id }}">
			{{ ucwords($category->name) }}
		</a>
		<span class="text-muted">({{ ucfirst($category->type ?? '') }})</span>
	</div>
	<div class="card-footer d-flex justify-content-between bg-main-dark">
		<small class="text-white">
			{{ $category->created_at->diffForHumans() }}
		</small>
		<div class="d-flex">
			<small class="text-danger mr-2 cursor-pointer">
				<i class="icofont-trash"></i>
			</small>
			<small class="text-warning cursor-pointer">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>