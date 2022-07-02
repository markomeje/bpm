<div class="card border-0 shadow-sm position-relative rounded-0">
    @set('status', strtolower($staff->status ?? ''))
    <div class="card-body d-flex justify-content-between align-items-center">
        @set('staffname', strtolower($staff->name ?? ''))
        <div class="d-flex align-items-center">
            <div class="rounded-circle lg-circle mr-2">
                <a href="{{ route('admin.staff.edit', ['id' => $staff->id, 'name' => \Str::slug($staffname)]) }}" class="w-100 h-100 d-block border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                    <small class="text-main-dark position-relative" style="top: 5px;">
                        {{ substr(strtoupper($staff->name), 0, 1) }}
                    </small>
                </a>
            </div>
            <div class="">
                <a href="{{ route('admin.staff.edit', ['id' => $staff->id, 'name' => \Str::slug($staffname)]) }}" class="text-main-dark d-block text-underline">
                    {{ \Str::limit(ucfirst($staffname), 12) }}
                </a>
                <small class="">
                    {{ \Str::limit(ucfirst($staff->role), 12) }}
                </small>
            </div>
        </div>
        <form class="d-inline" action="javascript:;" method="post">
            <div class="form-group">
                <div class="custom-control custom-switch m-0">
                    <input type="checkbox" value="{{ $staff->status }}" name="status" class="custom-control-input" id="status-{{ $staff->id }}" {{ $staff->status == 'active' ? 'checked' : '' }} data-url="{{ route('admin.staff.status', ['id' => $staff->id]) }}">
                    <label class="custom-control-label text-main-dark cursor-pointer" for="status-{{ $staff->id }}"></label>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer bg-white pt-4 d-flex justify-content-between rounded-0">
        <small class="text-main-dark">
            {{ $staff->created_at->diffForHumans() }}
        </small>
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.staff.edit', ['id' => $staff->id, 'name' => \Str::slug($staffname)]) }}" class="text-decoration-none">
                <small class="text-warning mr-2 cursor-pointer">
                    <i class="icofont-edit"></i>
                </small>
            </a>
            <small class="text-danger delete-staff cursor-pointer" data-url="{{ route('admin.staff.delete', ['id' => $staff->id]) }}">
                <i class="icofont-trash"></i>
            </small>
        </div>
    </div>
</div>