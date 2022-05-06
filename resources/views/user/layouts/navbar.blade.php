<div class="fixed-top bg-white">
    <div style="padding-right: 5px;">
        <div class="container">
            <div class="d-flex py-4 align-items-center justify-content-between">
                <a href="{{ route('dashboard') }}" class="logo-wrapper">
                    <img src="/images/assets/logo.png" class="img-fluid object-cover" alt="Best Property Market">
                </a>
                <div class="d-flex align-items-center">
                    <a href="{{ env('APP_URL') }}" class="text-decoration-none rounded-circle cursor-pointer bg-theme-color text-center" style="width: 25px; height: 25px; line-height: 22px;" target="_blank">
                        <small class="text-white tiny-font">
                            <i class="icofont-web"></i>
                        </small>
                    </a>
                    <div class="dropdown ml-2">
                        <div class="text-decoration-none rounded-circle cursor-pointer bg-theme-color text-center" id="user-{{ auth()->id() }}" data-toggle="dropdown" data-offset="35, 15" style="width: 25px; height: 25px; line-height: 20px;">
                            <small class="text-white tiny-font">
                                <i class="icofont-ui-user"></i>
                            </small>
                        </div>
                        <div class="dropdown-menu border-0 icon-raduis shadow dropdown-menu-right" aria-labelledby="user-{{ auth()->id() }}" style="width: 210px !important;">
                            <a href="{{ route('user.profile') }}" class="dropdown-item">
                                <small class="text-main-dark">My Profile</small>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.reviews') }}" class="dropdown-item">
                                <small class="text-main-dark">My Reviews</small>
                            </a>
                            <div class="dropdown-divider"></div>
                            @if(auth()->user()->profile)
                                @set('profile', auth()->user()->profile)
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
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item">
                                <small class="text-danger">Logout</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    	
</div>

