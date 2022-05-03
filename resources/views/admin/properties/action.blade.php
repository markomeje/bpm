@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info d-flex justify-content-between align-items-center m-0">
                        <div class="mr-2">{{ ucfirst($action) }} ({{ $properties->total() }})</div>
                        <a href="{{ route('admin.property.add') }}" class="text-decoration-none">
                            <i class="icofont-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info d-flex align-items-center m-0">
                        <a class="text-decoration-none" href="javascript:;" data-target="#search-properties" data-toggle="modal">
                            <i class="icofont-search"></i>
                        </a>
                        @include('admin.properties.forms.search')
                    </div>
                </div>
            </div>
            <div class="mb-4">
                @if(empty($properties->count()))
                    <div class="alert-info alert">No properties yet</div>
                @else
                    <div class="row">
                        @foreach($properties as $property)
                            <div class="col-12 col-md-4 col-lg-2 mb-4">
                                @include('admin.properties.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $properties->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    