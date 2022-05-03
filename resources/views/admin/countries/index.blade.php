@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info m-0 d-flex align-items-center">
                        <span class="mr-2">All Countries ({{ \App\Models\Country::count() }})</span>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info m-0 d-flex align-items-center">
                        <a class="" href="javascript:;">
                            <small class="mr-2 font-weight-bold">
                                <i class="icofont-search"></i>
                            </small>
                        </a>
                    </div>
                </div>
            </div>
            <div class="">
                @if(empty($countries->count()))
                    <div class="alert-info alert">No countries yet</div>
                @else
                    <div class="row">
                        @foreach($countries as $country)
                            <div class="col-12 col-md-4 col-lg-2 mb-4">
                                @include('admin.countries.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $countries->onEachSide(1)->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    