@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
        <div class="position-relative">
            <div class="" style="padding: 120px 0;">
                <div class="container-fluid">
                    <div class="">
                        <div class="">
                            @if(empty($properties->count()))
                                <div class="alert-info alert mb-4">No Properties Found for ({{ request()->get('query') }})</div>
                                <?php $properties = \App\Models\Property::where('action', '!=', 'sold')->orderBy('id', 'desc')->take(400)->get()->random(25); ?>
                                <div class="row">
                                    @foreach($properties as $property)
                                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                                            @include('frontend.properties.partials.card')
                                        </div>
                                    @endforeach
                                </div> 
                            @else
                                <h4 class="text-main-dark mb-4"> ({{ $properties->total() }}) Propertie(s) found</h4>
                                <div class="row">
                                    @foreach($properties as $property)
                                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                                            @include('frontend.properties.partials.card')
                                        </div>
                                    @endforeach
                                </div> 
                                {{ $properties->appends(request()->query())->links('vendor.pagination.default') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.bottom')
@include('layouts.footer')