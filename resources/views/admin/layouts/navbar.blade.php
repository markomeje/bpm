<div class="fixed-top bg-white">
	<div class="py-4">
		<div class="container-fluid">
			<div class="d-flex justify-content-between align-items-center">
				<div class="d-flex align-items-center">
					<div class="mr-3 cursor-pointer text-center">
				    	<a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-main-dark">Dashboard</a>
				    </div>
				    <div class="mr-3 cursor-pointer text-center">
				    	<a href="{{ route('home') }}" class="text-decoration-none text-theme-color" target="_blank">
				    		<i class="icofont-web"></i>
				    	</a>
				    </div>
				</div>
				<ul class="d-flex align-items-center">
					<a href="{{ route('admin.settings') }}" class="text-decoration-none text-center">
				    	<i class="icofont-settings text-success"></i>
				    </a>
				    <a href="{{ route('logout') }}" class="text-decoration-none text-center">
				    	<i class="icofont-power text-danger ml-3"></i>
				    </a>
				    <div class="dropdown ml-3">
	                    <a href="javascript:;" class="text-decoration-none d-block cursor-pointer" id="user-{{ auth()->id() }}" data-toggle="dropdown" data-offset="0, 15">
	                        <small class="text-main-dark">
	                            <i class="icofont-navigation-menu"></i>
	                        </small>
	                    </a>
	                    <div class="dropdown-menu border-0 icon-raduis shadow dropdown-menu-right" aria-labelledby="user-{{ auth()->id() }}" style="width: 280px !important; max-height: 480px; overflow-y: scroll;">
	                    	<a href="{{ route('admin.payments') }}" class="dropdown-item d-flex justify-content-between align-items-center">
	                            <span class="text-main-dark">Payments</span>
	                            <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
	                        </a>
	                        <div class="dropdown-divider"></div>
	                        <a href="{{ route('admin.countries') }}" class="dropdown-item d-flex justify-content-between align-items-center">
	                            <span class="text-main-dark">Countries</span>
	                            <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
	                        </a>
	                        <div class="dropdown-divider"></div>
	                        <a href="{{ route('admin.users') }}" class="dropdown-item d-flex justify-content-between align-items-center">
	                            <span class="text-main-dark">Users</span>
	                            <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
	                        </a>
	                        <div class="dropdown-divider"></div>
	                        <a href="{{ route('admin.properties') }}" class="dropdown-item d-flex justify-content-between align-items-center">
                                <span class="text-main-dark">Properties</span>
                                <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
                            </a>
	                    </div>
	                </div>
				</ul>
			</div>
		</div>
	</div>
</div>

