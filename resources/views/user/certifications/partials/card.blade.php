<div class="card border-0 shadow">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <a href="javascript:;" data-target="#edit-certification-{{ $certificate->id }}" data-toggle="modal">
                <small class="text-main-dark text-underline">
                    {{ \Str::limit($qualifications[$certificate->qualification], 14) }}
                </small>
            </a>
            <a href="javascript:;" data-target="#edit-certification-{{ $certificate->id }}" data-toggle="modal">
                <small class="text-main-dark text-underline">
                    {{ $certificate->year }}
                </small>
            </a>
        </div>
    </div>
    <div class="card-footer bg-main-dark d-flex align-items-center justify-content-between">
        <small class="text-white">
            {{ $certificate->created_at->diffForHumans() }}
        </small>
        <div class="d-flex align-items-center">
            <a href="javascript:;" data-target="#edit-certification-{{ $certificate->id }}" data-toggle="modal">
                <small class="mr-2 text-warning">
                    <i class="icofont-edit"></i>
                </small>
            </a>
            <a href="javascript:;" class="delete-certification" data-url="{{ route('user.certification.delete', ['id' => $certificate->id]) }}" data-message="Are you sure to delete your certification record?">
                <small class="text-danger">
                    <i class="icofont-trash"></i>
                </small>
            </a>
        </div>
    </div>
</div>