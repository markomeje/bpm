<div class="col-12 col-md-6 mb-4">
    <div class="card position-relative card-raduis border-0" >
        <div class="card-header pt-5 bg-blue card-raduis" style="padding-bottom: 90px !important;">
            <h4 class="text-white">
                <a href="{{ route('admin.users') }}" class="text-decoration-none text-white">Users</a>
            </h4>
            <div class="d-flex justify-content-between">
                <div class="">
                    {{ number_format(\App\Models\User::count()) }}
                </div>
                <small class="tiny-font px-3 py-1 bg-pink rounded-pill">
                    <a href="{{ route('admin.users') }}" class="text-white text-decoration-none">0%</a>
                </small>
            </div>
        </div>
        <div class="card-body py-0 position-relative" style="top: -64px;">
            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <div class="alert alert-info icon-raduis m-0 p-4">
                        <div class="alert alert-warning rounded-circle p-0 m-0 mb-3 text-center border-white" style="height: 40px; width: 40px; line-height: 35px;">
                            <small class="">
                                <i class="icofont-users"></i>
                            </small>
                        </div>
                        <a href="{{ route('admin.users', ['query' => 'corporate']) }}" class="text-decoration-none">Corporate</a>
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                {{ number_format(\App\Models\Profile::where(['designation' => 'corporate'])->get()->count()) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="alert alert-warning icon-raduis m-0 p-4">
                        <div class="alert alert-info rounded-circle p-0 m-0 mb-3 text-center border-white" style="height: 40px; width: 40px; line-height: 35px;">
                            <small class="">
                                <i class="icofont-user-alt-3"></i>
                            </small>
                        </div>
                        <a href="{{ route('admin.users', ['query' => 'individual']) }}" class="text-decoration-none">Individual</a>
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                {{ number_format(\App\Models\Profile::where(['designation' => 'individual'])->get()->count()) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<div class="col-12 col-md-6 mb-4">
    <div class="card position-relative card-raduis border-0" >
        <div class="card-header pt-5 bg-pink card-raduis" style="padding-bottom: 90px !important;">
            <h4 class="text-white">
                <a href="{{ route('admin.payments') }}" class="text-decoration-none text-white">Payments</a>
            </h4>
            <div class="d-flex justify-content-between">
                <div class="">
                    NGN{{ number_format(\App\Models\Payment::where(['status' => 'paid'])->get()->sum('amount')) }}
                </div>
                <small class="tiny-font px-3 py-1 bg-blue rounded-pill">0%</small>
            </div>
        </div>
        <div class="card-body py-0 position-relative" style="top: -64px;">
            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <div class="alert alert-success icon-raduis m-0 p-4">
                        <div class="alert alert-primary rounded-circle p-0 m-0 mb-3 text-center border-white" style="height: 40px; width: 40px; line-height: 35px;">
                            <small class="">
                                <i class="icofont-users"></i>
                            </small>
                        </div>
                        <a href="{{ route('admin.payments', ['type' => 'advert']) }}" class="text-decoration-none d-block">Advert</a>
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                NGN{{ number_format(\App\Models\Payment::where(['status' => 'paid', 'type' => 'advert'])->get()->sum('amount')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="alert alert-primary icon-raduis m-0 p-4">
                        <div class="alert alert-success rounded-circle p-0 m-0 mb-3 text-center border-white" style="height: 40px; width: 40px; line-height: 35px;">
                            <small class="">
                                <i class="icofont-user-alt-3"></i>
                            </small>
                        </div>
                        <a href="{{ route('admin.payments', ['type' => 'subscription']) }}" class="text-decoration-none d-block">Subscription</a>
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                NGN{{ number_format(\App\Models\Payment::where(['status' => 'paid', 'type' => 'subscription'])->get()->sum('amount')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<div class="col-12 col-md-6 col-lg-3 mb-4">
    <div class="card card-raduis border-0 shadow-sm" >
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <small class="px-3 tiny-font py-1 bg-danger rounded-pill">
                    <small class="text-white">+{{ \App\Models\Blog::all()->pluck('views')->sum() }} views</small> 
                </small>
            </div>
            <div class="">
                <div class="text-main-dark">
                    <span>
                        {{ number_format(\App\Models\Blog::count()) }}
                    </span>
                    <small class="text-danger">
                        <i class="icofont-long-arrow-down"></i>
                    </small>
                </div>
                <a href="{{ route('admin.blogs') }}" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">Blogs</a>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-3 mb-4">
    <div class="card card-raduis border-0 shadow-sm" >
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <small class="px-3 tiny-font py-1 bg-success rounded-pill">
                    <small class="text-white">+{{ number_format(\App\Models\Credit::count()) }} sold</small> 
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
<div class="col-12 col-md-6 col-lg-3 mb-4">
    <div class="card card-raduis border-0 shadow-sm" >
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <small class="px-3 tiny-font py-1 bg-success rounded-pill">
                    <small class="text-white">0 views</small> 
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
<div class="col-12 col-md-6 col-lg-3 mb-4">
    <div class="card card-raduis border-0 shadow-sm" >
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <small class="px-3 tiny-font py-1 bg-success rounded-pill">
                    <small class="text-white">0 active</small> 
                </small>
            </div>
            <div class="">
                <div class="text-main-dark">
                    <span>
                        {{ number_format(\App\Models\Staff::count()) }}
                    </span>
                </div>
                <a href="{{ route('admin.staff') }}" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">Staff</a>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-3 mb-4">
    <div class="card card-raduis border-0 shadow-sm" >
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <small class="px-3 tiny-font py-1 bg-danger rounded-pill">
                    <small class="text-white">-04%</small>
                </small>
            </div>
            <div class="">
                <div class="text-main-dark">
                    {{ number_format(\App\Models\Membership::count()) }}
                </div>
                <a href="{{ route('admin.memberships') }}" class="d-flex justify-content-between align-items-center text-main-dark text-decoration-none">Memberships</a>
            </div>
        </div>
    </div>
</div>

