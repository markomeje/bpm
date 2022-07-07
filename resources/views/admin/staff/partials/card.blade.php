<div class="card border-0 shadow-sm position-relative rounded-0">
    @set('status', strtolower($staff->status ?? ''))
    <div class="dropdown position-absolute" style="top: -10px; right: 20px;">
        <small href="javascript:;" class="rounded cursor-pointer text-white tiny-font py-1 d-block bg-{{ $status === 'active' ? 'success' : 'danger' }} text-center" id="status-{{ $staff->id }}" data-toggle="dropdown" style="width: 90px;">
            {{ ucfirst($status) }} <i class="icofont-caret-down"></i>
        </small>
        <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="promote-{{ $staff->id }}" style="width: 240px !important;">
            <div class="p-4 w-100">
                <p class="text-main-dark mb-3">Update Staff status</p>
                <form class="update-staff-status-form" method="post" action="javascript:;" data-action="{{ route('admin.staff.status.update', ['id' => $staff->id]) }}">
                    <div class="mb-4">
                        @set('statuses', \App\Models\Staff::$status)
                        <select class="form-control custom-select status" name="status">
                            <option value="">Select status</option>
                            @if(empty($statuses))
                                <option value="">No status found</option>
                            @else
                                @foreach($statuses as $state)
                                    <option value="{{ strtolower($state) }}" {{ strtolower($status) === $state ? 'selected' : '' }}>
                                        {{ ucwords($state) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <small class="invalid-feedback status-error"></small>
                    </div>
                    <div class="alert mb-4 add-staff-status-message d-none"></div>
                    <div class="">
                        <button type="submit" class="btn btn-info btn-block btn-lg text-white update-staff-status-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none update-staff-status-spinner mb-1">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body d-flex justify-content-between align-items-center">
        @set('staffname', strtolower($staff->name ?? ''))
        <div class="d-flex align-items-center">
            <div class="rounded-circle position-relative lg-circle mr-2">
                @if(!empty($staff->staff))
                    @if($staff->staff->created_by === auth()->id())
                        <div class="dropdown">
                            <div class="sm-circle cursor-pointer rounded-circle border border-white position-absolute text-center bg-success" style="top: -2px; left: -4px;" id="status-{{ $staff->created_at }}" data-toggle="dropdown">
                                <small class="position-relative text-white tiny-font">
                                    <i class="icofont-tick-mark"></i>
                                </small>
                            </div>
                            <div class="dropdown-menu border-0 py-2 px-3 shadow dropdown-menu-left" aria-labelledby="promote-{{ $staff->id }}">
                                <div class="text-main-dark">Created by you.</div>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="w-100 h-100 d-block border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                    <small class="text-main-dark position-relative" style="top: 5px;">
                        {{ substr(strtoupper($staff->name), 0, 1) }}
                    </small>
                </div>
            </div>
            <div class="">
                <a href="{{ route('admin.staff.edit', ['id' => $staff->id]) }}" class="text-main-dark d-block text-underline mb-2">
                    {{ \Str::limit(ucfirst($staffname), 12) }}
                </a>
                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        {{ \Str::limit(ucfirst($staff->role), 14) }}
                    </div>
                </div>
            </div>
        </div>     
    </div>
    <div class="card-footer bg-white pt-4 d-flex justify-content-between rounded-0">
        <small class="text-main-dark">
            {{ $staff->created_at->diffForHumans() }}
        </small>
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.staff.edit', ['id' => $staff->id]) }}" class="text-decoration-none">
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