<div class="card border-0 shadow-sm position-relative rounded-0">
    @set('status', strtolower($user->status ?? ''))
    <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="tel:{{ $user->phone }}" class="mr-2 text-decoration-none sm-circle text-center rounded-circle border border-secondary">
                <small class="text-secondary tiny-font">
                    <i class="icofont-phone"></i>
                </small>
            </a>
            <a href="mailto:{{ $user->email }}" class="text-decoration-none sm-circle text-center rounded-circle border border-secondary">
                <small class="text-secondary tiny-font">
                    <i class="icofont-email"></i>
                </small>
            </a>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.user.profile', ['id' => $user->id]) }}" class="mr-2 text-decoration-none sm-circle text-center rounded-circle border border-info">
                <small class="text-info tiny-font">
                    <i class="icofont-user"></i>
                </small>
            </a>
            <a href="javascript:;" class="text-decoration-none sm-circle text-center rounded-circle border border-danger">
                <small class="text-danger tiny-font">
                    <i class="icofont-trash"></i>
                </small>
            </a>
        </div>
    </div>
    <div class="bg-inverse w-100 p-1"></div>
    <div class="card-body shadow d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="rounded-circle lg-circle m-0">
                <div class="p-1 m-0 border border-{{ $status == 'active' ? 'success' : 'danger' }} rounded-circle w-100 h-100">
                    @if(empty($user->profile->image))
                        <div class="w-100 h-100 border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                            <small class="text-main-dark">
                                {{ substr(strtoupper($user->name), 0, 1) }}
                            </small>
                        </div>
                    @else
                        <img src="{{ $user->profile->image }}" class="img-fluid object-cover rounded-circle w-100 h-100 border">
                    @endif
                </div>
            </div>
            <div class="ml-3">
            	<a href="{{ route('admin.user.profile', ['id' => $user->id]) }}" class="d-flex align-items-center text-main-dark">
	                {{ \Str::limit(ucwords($user->name), 12) }}
            	</a>
                <a href="{{ route('admin.user.profile', ['id' => $user->id]) }}" class="">
                    <small class="text-muted">
                    	{{ empty($user->profile) ? 'No profile' : ucfirst($user->profile->role) }}
                    </small>
                </a>
            </div>
        </div>
        <div class="dropdown cursor-pointer">
        	<small class="text-white rounded-pill bg-success px-3 tiny-font py-1 bg-{{ $status == 'active' ? 'success' : 'danger' }}" data-toggle="dropdown" arealabelledby="user-designation">
        		<i class="icofont-caret-down"></i>
        	</small>
            <div class="dropdown-menu rounded-0 dropdown-menu-right border-0 shadow" id="user-designation">
                <div class="dropdown-item text-{{ $status == 'active' ? 'success' : 'danger' }}">
                    {{ ucfirst($status) }}
                </div>
            </div>
        </div>
    </div>
    <div class="bg-inverse w-100 p-1"></div>
    <div class="card-footer bg-white py-4 d-flex justify-content-between rounded-0">
        <small class="text-main-dark">
            {{ $user->created_at->diffForHumans() }}
        </small>
        <a href="{{ route('admin.user.profile', ['id' => $user->id]) }}">
            <small class="text-main-dark">
                {{ empty($user->profile) ? 'No Profile' : ucfirst($user->profile->designation) }}
            </small>
        </a>
            
    </div>
</div>