@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            @can('view', ['properties'])
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="alert alert-info justify-content-between d-flex align-items-center mb-4">
                            <div class="mr-2">({{ \App\Models\Property::count() }}) Properties</div>
                            <a href="{{ route('admin.property.add') }}" class="text-decoration-none">
                                <i class="icofont-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="alert alert-info d-flex align-items-center">
                            <a class="text-underline" href="javascript:;" data-target="#search-properties" data-toggle="modal">
                                <i class="icofont-search"></i>
                            </a>
                            @include('admin.properties.forms.search')
                        </div>
                    </div>
                </div>
                <div class="">
                    @if(empty($properties->count()))
                        <div class="alert-info alert">No properties yet</div>
                    @else
                        <div class="row">
                            @foreach($properties as $property)
                                <div class="col-12 col-md-4 col-lg-3 mb-4">
                                    @include('admin.properties.partials.card')
                                </div>
                            @endforeach
                        </div>
                        {{ $properties->links('vendor.pagination.default') }}
                    @endif
                </div>
            @else
                <div class="alert alert-info">No Permission to view properties</div>
            @endcan
        </div>
    </div>
</div>
@include('layouts.footer')    