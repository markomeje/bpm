@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <p class="m-0 text-main-dark">Welcome {{ ucwords(auth()->user()->name) }}</p>
                <div class="text-info">
                    {{ date("F j, Y") }}
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="row h-100">
                                @can('view', ['users'])
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="card position-relative card-raduis border-0">
                                            @set('users', \App\Models\User::where(['role' => 'user'])->get())
                                            <div class="card-header pt-5 bg-blue card-raduis" style="padding-bottom: 90px !important;">
                                                <h4 class="text-white">
                                                    <a href="{{ route('admin.users') }}" class="text-decoration-none text-white">Users</a>
                                                </h4>
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        {{ number_format($users->count()) }}
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
                                @endcan
                                @can('view', ['payments'])
                                    <!-- The current user can update the post... -->
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
                                                    {{-- <div class="col-12 col-lg-6 mb-4">
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
                                                    </div> --}}
                                                    <div class="col-12">
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
                                @endcan
                                @include('admin.dashboard.partials.panels')
                            </div>
                        </div>
                    </div>
                    {{-- @can('view', ['adverts'])
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="card-raduis alert alert-info">
                                    <div class="">
                                        @set('advertscount', \App\Models\Advert::count())
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div class="">
                                                <h4 class="text-main-dark">
                                                    {{ number_format($advertscount) }}
                                                </h4>
                                                <a href="{{ route('admin.adverts') }}" class="text-main-dark">Adverts</a>
                                            </div>
                                            <small class="px-3 bg-warning rounded-pill">
                                                <small class="tiny-font text-main-dark">0%</small>
                                            </small>
                                        </div>
                                        <?php $advertpercentages = [
                                            'active' => ['count' => \App\Models\Advert::where(['status' => 'active'])->count(), 'color' => 'success'],
                                            'cancelled' => ['count' => \App\Models\Advert::where(['status' => 'cancelled'])->count(), 'color' => 'warning'], 
                                            'expired' => ['count' => \App\Models\Advert::where(['status' => 'expired'])->count(), 'color' => 'danger'],
                                            'paused' => ['count' => \App\Models\Advert::where(['status' => 'paused'])->count(), 'color' => 'info']
                                        ]; ?>
                                        <div class="row">
                                            @foreach($advertpercentages as $name => $percentage)
                                                <div class="col-12 col-md-6 mb-4">
                                                    <div class="bg-white p-3 shadow-sm d-flex justify-content-between align-items-center icon-raduis">
                                                        <div class="">
                                                            <div class="">
                                                                {{ $percentage['count'] }}
                                                            </div>
                                                            <a href="{{ route('admin.adverts', ['status' => $name]) }}" class="text-decoration-none">
                                                                <small class="text-main-dark">
                                                                    {{ ucfirst($name) }}
                                                                </small>
                                                            </a>    
                                                        </div>
                                                        <div class="border lg-circle rounded-circle border-{{ $percentage['color'] }} text-center">
                                                            <small class="tiny-font position-relative" style="top: 4px;">
                                                                {{ round(($percentage['count']/($advertscount == 0 ? 1 : $advertscount)) * 100) }}%
                                                            </small>
                                                        </div>  
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan --}}
                    @can('view', ['properties'])
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-raduis bg-white shadow-sm mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <small class="text-main-dark">Property Listings</small>
                                            <div class="dropdown">
                                                <div class="text-main-dark d-flex align-items-center" type="button" id="properties-chart-filter" data-toggle="dropdown" aria-expanded="false">
                                                    <small class="position-relative" style="bottom: -2px;">
                                                        <i class="icofont-caret-down"></i>
                                                    </small>
                                                </div>
                                                <div class="dropdown-menu bg-info border-0 icon-raduis shadow-sm dropdown-menu-right" aria-labelledby="properties-chart-filter">
                                                    <form class="p-3" action="javascript:;">
                                                        <div class="form-group mb-0">
                                                            <select class="form-control custom-select" name="filter" id="properties-chart-year">
                                                                @if(empty($years))
                                                                    <option value="{{ date('Y') }}" data-url="{{ route('admin.properties.chart', ['year' => date('Y')]) }}">
                                                                        {{ date('Y') }}
                                                                    </option>
                                                                @else
                                                                    @foreach($years as $year)
                                                                        <option value="{{ $year }}" data-url="{{ route('admin.properties.chart', ['year' => $year]) }}" {{ $year == date('Y') ? 'selected' : date('Y') }}>
                                                                            -- {{ $year }} --
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative border-dark-500 property-chart-wrapper" style="width: 100%;">
                                            <div class="position-absolute text-center bg-dark w-100 h-100 center-absolute property-chart-spinner">
                                                <img src="/images/spinner.svg" class="pt-5">
                                            </div>
                                            <canvas class="h-100 w-100 text-white property-chart" id="property-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan    
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    @include('admin.dashboard.partials.sidebar')  
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')