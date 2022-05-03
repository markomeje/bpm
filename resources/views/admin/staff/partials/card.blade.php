<div class="card border-0 shadow-sm position-relative rounded-0">
    @set('status', strtolower($staff->status ?? ''))
    <div class="card-body d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="rounded-circle lg-circle mr-2">
                <a href="javascript:;" class="w-100 h-100 d-block border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                    <small class="text-main-dark position-relative" style="top: 5px;">
                        {{ substr(strtoupper($staff->user->name), 0, 1) }}
                    </small>
                </a>
            </div>
            <div class="">
                <a href="javascript:;" class="text-main-dark d-block text-underline" data-toggle="modal" data-target="#edit-staff-{{ $staff->id }}">
                    {{ \Str::limit(ucfirst($staff->user->name), 12) }}
                </a>
                <small class="">
                    {{ \Str::limit(ucfirst($staff->role), 12) }}
                </small>
            </div>
        </div>
        @if($staff->verified === true)
            <div class="rounded-circle text-center sm-circle bg-success bg-success">
                <small class="tiny-font text-white position-relative" style="top: 2px;">
                    <i class="icofont-verification-check"></i>      
                </small>
            </div>
        @else
            <div class="rounded-circle text-center sm-circle bg-success bg-danger">
                <small class="tiny-font text-white position-relative" style="top: 2px;">
                    <i class="icofont-error"></i>      
                </small>
            </div>
        @endif
    </div>
    <div class="card-footer bg-white pt-4 d-flex justify-content-between rounded-0">
        <small class="text-main-dark">
            {{ $staff->created_at->diffForHumans() }}
        </small>
        <form class="d-inline" action="javascript:;" method="post">
            <div class="form-group">
                <div class="custom-control custom-switch m-0">
                    <input type="checkbox" value="{{ $staff->status }}" name="status" class="custom-control-input status toggle-staff-status" id="status" {{ $staff->status == 'active' ? 'checked' : '' }} data-url="{{ route('admin.staff.toggle.status', ['id' => $staff->id, 'status' => $staff->status == 'active' ? 'inactive' : 'active']) }}">
                    <label class="custom-control-label text-main-dark cursor-pointer" for="status"></label>
                </div>
            </div>
        </form>
    </div>
</div>