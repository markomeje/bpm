@include('layouts.header')
    <div class="min-vh-100 bg-main-ash">
        @include('admin.layouts.navbar')
        <div class="section-padding pb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info m-0">
                            {{ $adverts->total() }} Advert(s)
                        </div>
                    </div>
                </div>
                <div class="row pb-4">
                    <div class="col-12">
                        @if(empty($adverts->count()))
                            <div class="alert-info alert">No adverts yet</div>
                        @else
                            <div class="row">
                                @foreach($adverts as $advert)
                                    <div class="col-12 col-md-4 col-lg-3 mt-5">
                                        @include('admin.adverts.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                {{ $adverts->onEachSide(1)->links('vendor.pagination.default') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')    