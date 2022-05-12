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
                                @include('admin.dashboard.partials.panels')
                            </div>
                        </div>
                    </div>
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
                <div class="col-12 col-md-4 col-lg-3">
                    @include('admin.dashboard.partials.sidebar')  
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')