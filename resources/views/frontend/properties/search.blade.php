@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
        <div class="properties-banner position-relative">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <h1 class="text-white">Search Properties</h1>
                        </div>
                        <div class="property-search p-3 icon-raduis border" style="background-color: rgba(255, 255, 255, 0.2);">
                            <div>
                                <form method="get" action="{{ route('properties.search') }}">
                                    <div class="form-row m-0 no-gutters">
                                        <div class="form-group input-group-lg col-12 col-md-11 m-md-0 mb-sm-4">
                                            <input type="text" class="form-control query icon-raduis" placeholder="Search property" required value="{{ request()->get('query') }}" name="query">
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <button class="btn btn-lg icon-raduis btn-block btn-info" type="submit">
                                                <small>
                                                    <i class="icofont-search"></i>
                                                </small>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative" style="top: -150px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-9">
                        @if(empty($properties->count()))
                            <div class="alert-info alert mb-4">No Properties Found for ({{ request()->get('query') }})</div>
                            <?php $properties = \App\Models\Property::where('action', '!=', 'sold')->inRandomOrder('id')->paginate(25); ?>
                            <div class="row">
                                @foreach($properties as $property)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                                        @include('frontend.properties.partials.card')
                                    </div>
                                @endforeach
                            </div> 
                            {{ $properties->appends(request()->query())->links('vendor.pagination.default') }}
                        @else
                            <div class="alert alert-info mb-4"> ({{ $properties->total() }}) Propertie(s) found</div>
                            <div class="row">
                                @foreach($properties as $property)
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        @include('frontend.properties.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            {{ $properties->appends(request()->query())->links('vendor.pagination.default') }}
                        @endif
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-4">
                            @include('frontend.properties.partials.categories')
                        </div>
                        <div class="">
                            @include('frontend.adverts.partials.sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.bottom')
@include('layouts.footer')