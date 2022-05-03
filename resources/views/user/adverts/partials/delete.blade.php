<div class="dropdown">
    <a href="javascript:;" class="btn btn-block btn-sm bg-theme-color text-white" id="toggle-advert-status-{{ $advert->id }}" data-toggle="dropdown">
        <small class="mr-1">
			<i class="icofont-rewind"></i>
		</small>
		<small>Delete</small>
    </a>
    <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="toggle-advert-status-{{ $advert->id }}" style="width: 260px !important;">
    	<form method="post" class="delete-advert-form p-4" action="javascript:;" data-action="{{ route('user.advert.delete', ['id' => $advert->id]) }}">
    		<div class="alert alert-danger mb-4">This advert will be deleted permanently.</div>
    		<input type="hidden" name="status" value="active">
    		<div class="alert mb-3 delete-advert-message d-none"></div>
    		<button type="submit" class="btn bg-theme-color text-white btn-block delete-advert-button">
    			<img src="/images/spinner.svg" class="mr-2 d-none delete-advert-spinner mb-1">Delete
    		</button>
    	</form>
    </div>
</div>