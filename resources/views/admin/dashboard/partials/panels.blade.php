@can('view', ['properties'])
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="card card-raduis border-0 shadow-sm" >
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <small class="px-3 mr-2 tiny-font py-1 bg-info rounded-pill">
                        <small class="text-white">0%</small>
                    </small>
                </div>
                <div class="">
                    <div class="text-main-dark">
                        <span class="">
                            {{ number_format(\App\Models\Property::count()) }}
                        </span>
                    </div>
                    <a href="{{ route('admin.properties') }}" class="text-main-dark text-decoration-none">Properties
                    </a>
                </div>
            </div>
        </div>
    </div>
@endcan
@can('view', ['countries'])
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="card card-raduis border-0 shadow-sm" >
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <small class="px-3 tiny-font py-1 bg-danger rounded-pill">
                        <small class="text-white">0%</small>
                    </small>
                </div>
                <div class="">
                    <div class="text-main-dark">
                        {{ number_format(\App\Models\Country::count()) }}
                    </div>
                    <a href="{{ route('admin.countries') }}" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">Countries</a>
                </div>
            </div>
        </div>
    </div>
@endcan
@can('view', ['blogs'])
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="card card-raduis border-0 shadow-sm" >
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <small class="px-3 tiny-font py-1 bg-danger rounded-pill">
                        <small class="text-white">+{{ number_format(\App\Models\Blog::latest()->take(5)->pluck('views')->sum()) }}</small> 
                    </small>
                </div>
                <div class="">
                    <div class="text-main-dark">
                        {{ number_format(\App\Models\Blog::count()) }}
                    </div>
                    <a href="{{ route('admin.blogs') }}" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">Blogs</a>
                </div>
            </div>
        </div>
    </div>
@endcan
@can('view', ['units'])
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="card card-raduis border-0 shadow-sm" >
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <small class="px-3 tiny-font py-1 bg-success rounded-pill">
                        <small class="text-white">+{{ number_format(\App\Models\Credit::count()) }}</small> 
                    </small>
                </div>
                <div class="">
                    <div class="text-main-dark">
                        <span>
                            {{ number_format(\App\Models\Unit::count()) }}
                        </span>
                    </div>
                    <a href="{{ route('admin.units') }}" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">Units</a>
                </div>
            </div>
        </div>
    </div>
@endcan
@can('view', ['news'])
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="card card-raduis border-0 shadow-sm" >
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <small class="px-3 tiny-font py-1 bg-success rounded-pill">
                        <small class="text-white">0</small> 
                    </small>
                </div>
                <div class="">
                    <div class="text-main-dark">
                        <span>
                            {{ number_format(\App\Models\News::count()) }}
                        </span>
                    </div>
                    <a href="javascipt:;" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">News</a>
                </div>
            </div>
        </div>
    </div>
@endcan
@can('view', ['staff'])
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="card card-raduis border-0 shadow-sm" >
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <small class="px-3 tiny-font py-1 bg-success rounded-pill">
                        <small class="text-white">0</small> 
                    </small>
                </div>
                <div class="">
                    <div class="text-main-dark">
                        <span>
                            {{ number_format(\App\Models\User::where('role', '!=', 'user')->where('role', '!=', 'superadmin')->get()->count()) }}
                        </span>
                    </div>
                    <a href="{{ route('admin.staff') }}" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">Staff</a>
                </div>
            </div>
        </div>
    </div>
@endcan

