@include('layouts.header')
    <div class="min-vh-100 bg-main-ash">
        @include('admin.layouts.navbar')
        <div class="section-padding pb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <div class="alert alert-info m-0">
                            {{ number_format($adverts->total()) }} Advert(s)
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <div class="alert alert-info m-0">
                            <div class="dropdown">
                                <a href="javascript:;" class="
                                " id="advert-filter" data-toggle="dropdown">
                                    Filter <i class="icofont-filter"></i>
                                </a>
                                @set('states', \App\Models\Advert::distinct()->pluck('status')->toArray())
                                <div class="dropdown-menu border-0 shadow-sm dropdown-menu-right" aria-labelledby="advert-filter" style="width: 210px !important;">
                                    <div class="p-3">
                                        @if(!empty($states))
                                            @foreach($states as $state)
                                                <a href="{{ route('admin.adverts', ['status' => $state]) }}" class="d-block bg-main-ash mb-3 p-3">
                                                    <small>
                                                        {{ ucfirst($state) }}
                                                    </small>
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-4 position-relative" style="top: -22px;">
                    <div class="col-12">
                        @if(empty($adverts->count()))
                            <div class="alert-info alert">No adverts yet</div>
                        @else
                            <div class="row">
                                @foreach($adverts as $advert)
                                    <div class="col-12 col-md-6 col-lg-3 mt-5">
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