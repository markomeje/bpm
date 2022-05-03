@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="alert alert-info justify-content-between d-flex align-items-center mb-4">
                        <div class="mr-2">({{ \App\Models\Unit::count() }}) Units</div>
                        <a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#add-unit">
                            <i class="icofont-plus"></i>
                        </a>
                    </div>
                    @include('admin.units.partials.add')
                </div>
                <div class="col-12 col-md-6">
                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <a class="text-underline" href="javascript:;" data-target="#filter-units" data-toggle="modal">
                            <i class="icofont-listing-box"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="">
                @if(empty($units->count()))
                    <div class="alert-danger alert">No units yet</div>
                @else
                    <div class="row">
                        @foreach($units as $unit)
                            <div class="col-12 col-md-4 col-lg-2 mb-4">
                                @include('admin.units.partials.card')
                            </div>
                            @include('admin.units.partials.edit')
                        @endforeach
                    </div>
                    {{ $units->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    