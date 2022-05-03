<div class="card border-0 bg-white position-relative icon-raduis shadow-sm">
    <div class="card-body">
       <a href="{{ ($social->company == 'whatsapp' || $social->company == 'telegram') ? "tel:{$social->phone}" : $social->link }}" class="text-center bg-theme-color rounded-circle d-block md-circle text-decoration-none">
            <small class="text-white tiny-font">
                <i class="icofont-{{ $social->company }}"></i>
            </small>
        </a> 
    </div>
    <div class="card-footer d-flex align-items-center">
        <small class="text-warning mr-2 cursor-pointer" data-toggle="modal" data-target="#edit-social-{{ $social->id }}">
            <i class="icofont-edit"></i>
        </small>
        <small class="text-danger cursor-pointer delete-social" data-url="{{ route('user.social.delete', ['id' => $social->id]) }}" data-message="Delete your social media handle?">
            <i class="icofont-trash"></i>
        </small>
    </div>  
</div>