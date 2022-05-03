@include('layouts.header')
<div class="bg-main-ash min-vh-100">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info d-flex m-0 align-items-center justify-content-between">
                        <div class="mr-2">{{ number_format($properties->total()) }} {{ ucwords($properties[0]->category ?? 'Random') }} Properties</div>
                        <a href="{{ route('admin.property.add') }}" class="text-decoration-none">
                            <i class="icofont-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info d-flex m-0 align-items-center">
                        <a class="text-decoration-none" href="javascript:;" data-target="#search-properties" data-toggle="modal">
                            <i class="icofont-search"></i>
                        </a>
                        @include('admin.properties.forms.search')
                    </div>
                </div>
            </div>
            <div class="">
                @if(empty($properties->count()))
                    <div class="alert-warning alert">No properties found</div>
                @else
                    <div class="row">
                        @foreach($properties as $property)
                            <div class="col-12 col-md-3 col-lg-2 mb-4">
                                @include('admin.properties.partials.card')
                            </div>
                        @endforeach
                    </div>
                @endif
                {{ $properties->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    