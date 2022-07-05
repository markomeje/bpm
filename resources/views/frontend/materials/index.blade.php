@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
        <div class="materials-banner position-relative">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <h1 class="text-white">Building Materials</h1>
                            <div class="text-white">As a Provider of quality construction equipment and building materials, our platform give you direct access to retailers, distributors, whole-sellers, factory producers and buyers etc. Our platform grant you free, and unlimited opportunities to be seen both locally and in the worldwide market.</div>
                        </div>
                        <div class="property-search p-3 icon-raduis border" style="background-color: rgba(255, 255, 255, 0.2);">
                            <div>
                                <form method="get" action="{{ route('materials') }}">
                                    <div class="form-row m-0 no-gutters">
                                        <div class="form-group input-group-lg col-12 col-md-11 m-md-0 mb-sm-4">
                                            <input type="text" class="form-control query icon-raduis" placeholder="Search material" required value="{{ request()->get('query') }}" name="query">
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
                <div class="">
                    @if(request()->query())
                        @if(empty($materials->count()))
                            <div class="alert-danger alert mb-4">No Materials Found for ({{ request()->get('query') }})</div>
                            <?php $materials = \App\Models\Material::inRandomOrder('id')->paginate(25); ?>
                            <div class="row">
                                @foreach($materials as $material)
                                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                                        @include('frontend.materials.partials.card')
                                    </div>
                                @endforeach
                            </div> 
                            {{ $materials->appends(request()->query())->links('vendor.pagination.default') }}
                        @else
                            <div class="alert alert-info mb-4"> ({{ $materials->total() }}) Materials(s) found</div>
                            <div class="row">
                                @foreach($materials as $material)
                                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                                        @include('frontend.materials.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            {{ $materials->appends(request()->query())->links('vendor.pagination.default') }}
                        @endif
                    @else
                        @if(empty($materials->count()))
                            <div class="alert-danger alert mb-4">No Materials Listed</div>
                        @else
                            <div class="alert alert-info mb-4">Building Materials</div>
                            <div class="row">
                                @foreach($materials as $material)
                                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                                        @include('frontend.materials.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            {{ $materials->appends(request()->query())->links('vendor.pagination.default') }}
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.bottom')
@include('layouts.footer')