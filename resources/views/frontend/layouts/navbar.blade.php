<div class="fixed-top bg-white border-bottom">
    <div class="">
        <div class="container-fluid">
            <div class="navbar-items py-4 px-0 d-flex align-items-center justify-content-between">
                <a href="{{ route('home') }}" class="logo-wrapper">
                    <img src="/images/assets/logo.png" class="img-fluid object-cover" alt="Best Property Market">
                </a>
                <ul class="navbar-center d-flex align-items-center">
                  <?php $uri = str_replace('/', '', request()->route()->uri); ?>
                    <li class="mr-3">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <small class="text-main-dark">Home</small>
                        </a>
                    </li>
                    <li class="mr-3">
                        <a href="{{ route('about') }}" class="text-decoration-none">
                            <small class="text-main-dark">About</small>
                        </a>
                    </li>
                    <li class="dropdown mr-3">
                        <a class="text-decoration-none" href="javascript:;" id="nav-services" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0, 39">
                           <small class="">
                                <span class="text-main-dark">Services</span>
                                <span class="text-theme-color position-relative" style="top: 1px;">
                                    <i class="icofont-caret-down"></i>
                                </span>
                            </small>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="nav-services">
                            <a class="dropdown-item" href="{{ route('artisans') }}">
                                <small class="text-theme-color mr-1">
                                    <i class="icofont-users"></i>
                                </small>
                                <small class="text-main-dark">Services</small>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('realtors') }}">
                                <small class="text-theme-color mr-1">
                                    <i class="icofont-users"></i>
                                </small>
                                <small class="text-main-dark">Realtors</small>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('dealers') }}">
                                <small class="text-theme-color mr-1">
                                    <i class="icofont-users"></i>
                                </small>
                                <small class="text-main-dark">Building Materials</small>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown mr-3">
                        <a class="text-decoration-none" href="javascript:;" id="nav-products" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0, 39">
                           <small class="">
                                <span class="text-main-dark">Properties</span>
                                <span class="text-theme-color position-relative" style="top: 1px;">
                                    <i class="icofont-caret-down"></i>
                                </span>
                            </small>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="nav-products">
                            <a class="dropdown-item" href="{{ route('properties') }}">
                                <small class="text-theme-color mr-1">
                                    <i class="icofont-building-alt"></i>
                                </small>
                                <small class="text-main-dark">All Properties</small>
                            </a>
                            <div class="dropdown-divider"></div>
                            @set('groups', \App\Models\Property::where(['status' => 'active'])->distinct()->pluck('group'))
                            @if($groups->count() > 0)
                                @foreach($groups as $group)
                                    @if(is_string($group) && $group !== '')
                                        <a class="dropdown-item" href="{{ route('properties.group', ['group' => \Str::slug(strtolower($group))]) }}">
                                            <small class="text-theme-color mr-1">
                                                <i class="icofont-building-alt"></i>
                                            </small>
                                            <small class="text-main-dark">
                                                {{ \Str::plural(ucwords($group)) }}
                                            </small>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </li>
                    <li class="mr-3">
                        <a href="{{ route('blog') }}" class="text-decoration-none">
                            <small class="text-main-dark">Blog</small>
                        </a>
                    </li>
                    <li class="dropdown mr-3">
                        <a class="text-decoration-none" href="javascript:;" id="nav-products" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0, 39">
                           <small class="">
                                <span class="text-main-dark">Products</span>
                                <span class="text-theme-color position-relative" style="top: 1px;">
                                    <i class="icofont-caret-down"></i>
                                </span>
                            </small>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="nav-products">
                            <a class="dropdown-item" href="{{ route('materials') }}">
                                <small class="text-theme-color">
                                    <i class="icofont-building"></i>
                                </small>
                                <small class="text-main-dark">Building Materials</small>
                            </a>
                        </div>
                    </li>
                    <li class="mr-3">
                        <a href="{{ route('news') }}" class="text-decoration-none">
                            <small class="text-main-dark">News</small>
                        </a>
                    </li>
                    <li class="mr-3">
                        <a href="{{ route('contact') }}" class="text-decoration-none">
                            <small class="text-main-dark">Contact</small>
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center navbar-right">
                    <div class="dropdown text-main-ash cursor-pointer mr-3">
                        <?php $languages = config()->get('languages'); ?>
                        <div class="d-flex align-items-center" id="global-languages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0, 36">
                            <span class="mr-1 text-theme-color">
                                <img src="{{ env('COUNTRY_FLAG_URL') }}/{{ $languages[app()->getLocale()]['code'] }}.svg" height="13" width="20">
                                {{-- <i class="icofont-web"></i> --}}
                            </span> 
                            <small class="">
                                {{ $languages[app()->getLocale()]['name'] }}
                            </small>
                        </div>
                        <div class="dropdown-menu border-0 shadow-sm dropdown-menu-right" aria-labelledby="global-languages">
                            @foreach ($languages as $code => $language)
                                @if($language['code'] !== $languages[app()->getLocale()]['code'])
                                    <a class="dropdown-item" href="{{ route('translate', ['locale' => $code]) }}">
                                        <span>
                                            <img src="{{ env('COUNTRY_FLAG_URL') }}/{{ $language['code'] }}.svg" height="13" width="20">
                                        </span>
                                        <small class="text-main-dark">
                                            {{ $language['name'] }}
                                        </small>
                                    </a>
                                    @if($language !== end($languages))
                                        <div class="dropdown-divider"></div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @if(auth()->check())
                        <div class="dropdown cursor-pointer rounded-circle bg-theme-color" style="width: 30px; height: 30px; line-height: 30px;">
                            <div class="text-center" id="website-user-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0, 32">
                                <small class="text-white">
                                    @if(empty(auth()->user()->name))
                                        <i class="icofont-ui-user"></i>
                                    @else
                                        {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
                                    @endif
                                </small>
                            </div>
                            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="website-user-icon">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <small class="text-theme-color mr-1">
                                      <i class="icofont-login"></i>
                                    </small>
                                    <small class="text-main-dark">My Dashboard</small>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <small class="text-theme-color mr-1">
                                      <i class="icofont-ui-play"></i>
                                    </small>
                                    <small class="text-main-dark">Logout</small>
                                </a>
                            </div>
                        </div>
                    @else
                        <a class="d-flex mr-3" href="{{ route('login') }}">
                            <small class="text-main-dark">Login</small>
                        </a>
                        <div class="">
                            <a href="{{ route('signup') }}" class="btn px-4 text-white bg-theme-color">Signup</a>
                        </div>
                    @endif
                </div>
                <div class="hanburger-icon ml-3 position-relative justify-content-center m-0 p-0 align-items-center cursor-pointer">
                    <div class="icon-lines"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="navbar-menu no-gutters bg-white position-fixed vh-100">
    <div class="menu-content vh-100 pb-4">
        @if(auth()->check())
            <div class="bg-main-dark d-flex align-items-center justify-content-between px-3 py-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle text-center mr-2 lg-circle">
                        @if(empty(auth()->user()->profile))
                            <a href="{{ route('dashboard') }}" class="text-white d-block rounded-circle w-100 h-100 bg-theme-color">
                                <div class="position-relative" style="top: 5px;">
                                    {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            </a>
                        @else
                            <div class="rounded-circle w-100 h-100">
                                @if(empty(auth()->user()->profile->image))
                                    <a href="{{ route('dashboard') }}" class="text-white d-block rounded-circle w-100 h-100 bg-theme-color">
                                        <div class="position-relative" style="top: 5px;">
                                            {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                    </a>
                                @else
                                    <img src="{{ auth()->user()->profile->image->link }}" class="img-fluid object-cover rounded-circle w-100 h-100 border">
                                @endif
                            </div>
                        @endif 
                    </div>
                    <div class="">
                        <div class="text-white">
                            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">
                                {{ \Str::limit(ucwords(auth()->user()->name), 14) }}
                            </a>
                        </div>
                        <small class="text-muted">
                            {{ auth()->user()->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
                <div class="">
                    <a href="{{ route('dashboard') }}" class="text-white">
                        <i class="icofont-long-arrow-right"></i>
                    </a>
                </div> 
            </div>
        @endif
        <div class="px-3 py-4">
            <a href="{{ url('/') }}" class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis mb-3">
                <small class="text-main-dark">Home</small>
            </a>
            <a href="{{ url('/about') }}" class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis mb-3">
                <small class="text-main-dark">About</small>
            </a>
            <div class="mb-3">
                <div class="">
                    <a class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis d-flex justify-content-between align-items-center" data-toggle="collapse" href="#property-nav-collapse" aria-expanded="false" aria-controls="property-nav-collapse">
                        <small class="text-main-dark">Properties</small>
                        <span class="text-theme-color">
                            <i class="icofont-caret-down"></i>
                        </span>
                    </a>
                </div>
                <div class="collapse" id="property-nav-collapse">
                    <div class="card card-body">
                        <a href="{{ route('properties') }}" class="d-flex justify-content-between">
                            <small class="text-main-dark">All Properties</small>
                            <div class="bg-theme-color text-center rounded-pill" style="width: 60px">
                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
                                    +{{ \App\Models\Property::count() }}
                                </small>
                            </div>
                        </a>
                    </div>
                    @set('groups', \App\Models\Property::where(['status' => 'active'])->distinct()->pluck('group'))
                    @if($groups->count() > 0)
                        @foreach($groups as $group)
                            @if(is_string($group) && $group !== '')
                                <div class="card card-body">
                                    <a href="{{ route('properties.group', ['group' => \Str::slug(strtolower($group))]) }}" class="d-flex justify-content-between">
                                        <small class="text-main-dark">
                                            {{ \Str::plural(ucwords($group)) }}
                                        </small>
                                        <div class="bg-theme-color text-center rounded-pill" style="width: 60px">
                                            <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
                                                +{{ \App\Models\Property::where(['group' => $group])->count() }}
                                            </small>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <a href="{{ route('blog') }}" class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis mb-3">
                <small class="text-main-dark">Blog</small>
            </a>
            <div class="mb-3">
                <div class="">
                    <a class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis d-flex justify-content-between align-items-center" data-toggle="collapse" href="#services-nav-collapse" aria-expanded="false" aria-controls="services-nav-collapse">
                        <small class="text-main-dark">Services</small>
                        <span class="text-theme-color">
                            <i class="icofont-caret-down"></i>
                        </span>
                    </a>
                </div>
                <div class="collapse" id="services-nav-collapse">
                    <div class="card card-body">
                        <a href="{{ route('artisans') }}" class="d-flex justify-content-between">
                            <small class="text-main-dark">Services</small>
                            <small class="bg-theme-color text-center rounded-pill px-3">
                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
                                    +{{ \App\Models\Profile::where(['role' => 'artisan'])->count() }}
                                </small>
                            </small>
                        </a>
                    </div>
                    <div class="card card-body">
                        <a href="{{ route('realtors') }}" class="d-flex justify-content-between">
                            <small class="text-main-dark">Realtors</small>
                            <small class="bg-theme-color text-center rounded-pill px-3">
                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
                                    +{{ \App\Models\Profile::where(['role' => 'realtor'])->count() }}
                                </small>
                            </small>
                        </a>
                    </div>
                    <div class="card card-body">
                        <a href="{{ route('dealers') }}" class="d-flex justify-content-between">
                            <small class="text-main-dark">Building Materials</small>
                            <small class="bg-theme-color text-center rounded-pill px-3">
                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
                                    +{{ \App\Models\Profile::where(['role' => 'dealer'])->count() }}
                                </small>
                            </small>
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('news') }}" class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis mb-3">
                <small class="text-main-dark">News</small>
            </a>
            <div class="mb-3">
                <div class="">
                    <a class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis d-flex justify-content-between align-items-center" data-toggle="collapse" href="#products-nav-collapse" aria-expanded="false" aria-controls="products-nav-collapse">
                        <small class="text-main-dark">Products</small>
                        <span class="text-theme-color">
                            <i class="icofont-caret-down"></i>
                        </span>
                    </a>
                </div>
                <div class="collapse" id="products-nav-collapse">
                    <div class="card card-body">
                        <a href="{{ route('materials') }}" class="d-flex justify-content-between">
                            <small class="text-main-dark">Building Materials</small>
                            <small class="bg-theme-color text-center rounded-pill px-3">
                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
                                    +{{ \App\Models\Material::count() }}
                                </small>
                            </small>
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ url('/contact') }}" class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis mb-3">
                <small class="text-main-dark">Contact</small>
            </a>
            @if(!auth()->check())
                <a href="{{ route('login') }}" class="d-block bg-theme-color text-decoration-none px-3 py-3 icon-raduis mb-3">
                    <small class="text-white">Login</small>
                </a>
                <a href="{{ route('signup') }}" class="d-block bg-theme-color text-decoration-none px-3 py-3 icon-raduis mb-3">
                    <small class="text-white">Signup</small>
                </a>
            @endif 
        </div> 
    </div>
</div>