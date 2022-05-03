<div class="fixed-top bg-white">
	<div class="container">
        <div class="d-flex py-3 align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a href="{{ route('user.dashboard') }}" class="text-decoration-none d-block rounded-circle cursor-pointer bg-theme-color text-center mr-2" style="width: 30px; height: 30px; line-height: 30px;">
                    <small class="text-white">
                        <i class="icofont-home"></i>
                    </small>
                </a>
                {{-- <h5 class="m-0 mr-2">
                	<a href="{{ route('user.dashboard') }}" class="text-main-dark text-decoration-none">Dashboard</a>
                </h5> --}}
                <a href="{{ env('APP_URL') }}" class="text-decoration-none d-block rounded-circle cursor-pointer bg-theme-color text-center mr-2" style="width: 30px; height: 30px; line-height: 30px;" target="_blank">
                    <small class="text-white">
                        <i class="icofont-web"></i>
                    </small>
                </a>
            </div>
        	<div class="d-flex align-items-center">
                <div class="dropdown mr-2">
                    <a href="javascript:;" class="text-decoration-none d-block rounded-circle cursor-pointer bg-theme-color text-center" id="user-{{ auth()->id() }}" data-toggle="dropdown" data-offset="35, 15" style="width: 30px; height: 30px; line-height: 25px;">
                        <small class="text-white">
                            <small>
                                <i class="icofont-ui-user"></i>
                            </small>
                        </small>
                    </a>
                    <div class="dropdown-menu border-0 icon-raduis shadow dropdown-menu-right" aria-labelledby="user-{{ auth()->id() }}" style="width: 210px !important;">
                        <a href="{{ route('user.profile') }}" class="dropdown-item">
                            <small class="text-main-dark mr-1">
                                <i class="icofont-ui-user"></i>
                            </small>
                            <small class="text-main-dark">My Profile</small>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <small class="text-danger mr-1">
                                <i class="icofont-power"></i>
                            </small>
                            <small class="text-danger">Logout</small>
                        </a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="javascript:;" class="text-decoration-none d-block rounded-circle cursor-pointer bg-theme-color text-center" id="user-{{ auth()->id() }}" data-toggle="dropdown" data-offset="0, 15" style="width: 30px; height: 30px; line-height: 25px;">
                        <small class="text-white">
                            <small>
                                <i class="icofont-navigation-menu"></i>
                            </small>
                        </small>
                    </a>
                    <div class="dropdown-menu border-0 icon-raduis shadow dropdown-menu-right" aria-labelledby="user-{{ auth()->id() }}" style="width: 210px !important;">
                        <a href="{{ route('user.reviews') }}" class="dropdown-item">
                            <small class="text-main-dark">My Reviews</small>
                        </a>
                        @if(auth()->user()->profile)
                            @set('profile', auth()->user()->profile)
                            <div class="dropdown-divider"></div>
                            @if($profile->role == 'artisan')
                                <a href="{{ route('user.services') }}" class="dropdown-item">
                                    <small class="text-main-dark">My Services</small>
                                </a>
                            @elseif($profile->role == 'dealer')
                                <a href="{{ route('user.materials') }}" class="dropdown-item">
                                    <small class="text-main-dark">My Materials</small>
                                </a>
                            @elseif($profile->role == 'realtor')
                                <a href="{{ route('user.properties') }}" class="dropdown-item">
                                    <small class="text-main-dark">My Properties</small>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
        	</div>
        </div>
    </div>
</div>

