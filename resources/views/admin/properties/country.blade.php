@include('layouts.header')
<div class="bg-main-ash min-vh-100">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info m-0 d-flex align-items-center justify-content-between">
                        <div class="mr-2">({{ $properties->total() }}) {{ ucwords($properties[0]->country->name ?? '') }} Properties</div>
                        <a href="{{ route('admin.property.add') }}" class="text-decoration-none">
                            <i class="icofont-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info m-0 d-flex align-items-center">
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
                            <div class="col-12 col-md-4 col-lg-2 mb-4">
                                @include('admin.properties.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $properties->links('vendor.pagination.links') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    