@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
        <div class="materials-banner position-relative">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <h1 class="text-white">Listed Materials</h1>
                        </div>
                        <div class="property-search p-3 icon-raduis border" style="background-color: rgba(255, 255, 255, 0.2);">
                            <div>
                                <form method="get" action="{{ route('materials.search') }}">
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
                    <div class="alert alert-info mb-4">Building Materials</div>
                    <div class="">
                        @if(empty($materials->count()))
                            <div class="alert-info alert">No Materials Yet</div>
                        @else
                            <div class="row">
                                @foreach($materials as $material)
                                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                                        @include('frontend.materials.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            {{ $materials->appends(request()->query())->links('vendor.pagination.default') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.bottom')
@include('layouts.footer')