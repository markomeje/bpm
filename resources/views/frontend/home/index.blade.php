@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
        <div class="home-banner position-relative">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-6">
                        <div class="mb-4">
                            <p class="text-white">Global Properties Listing</p>
                            <h1 class="text-white font-weight-bolder shadow-sm">Buy<span class="text-theme-color">,</span> Rent <span class="font-weight-bolder text-theme-color">or</span> Sell Real Estate Properties<span class="text-theme-color font-weight-bolder">.</span></h1>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <a href="{{ route('properties') }}" class="btn text-white btn-block bg-theme-color icon-raduis btn-lg">Find Properties</a>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <a href="{{ route('signup') }}" class="btn text-white btn-block bg-main-dark icon-raduis btn-lg">List Properties</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-properties">
            <div class="container-fluid">
                <div class="">
                    <h4 class="text-main-dark">Global Properties</h4>
                    <div class="text-main-dark mb-4 w-75">Find your dream property from our global list of lands, commercial, residential and industrial properties. To see more, <a href="">Click here</a> or to speak to with us, <a href="tel:{{ env('OFFICE_PHONE') }}">contact us</a> immediately.</div>
                    <div class="bg-transparent">
                        @set('actions', \App\Models\Property::distinct()->pluck('action'))
                        @if(!empty($actions))
                            <div class="d-flex align-items-center flex-wrap">
                                @foreach($actions as $key => $action)
                                    @if($action !== 'sold')
                                        <a href="{{ route('properties.action', ['action' => $action]) }}" class="btn border-theme-color mr-3 mb-4 py-1 text-main-dark px-4" target="_blank">
                                            {{ ucwords(\App\Models\Property::$actions[$action]) }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="home-listing">
                        @if(empty($properties->count()))
                            <div class="alert-info alert">No Properties Yet</div>
                        @else
                            <div class="row">
                                @foreach($properties->take(4) as $property)
                                    <div class="col-12 col-md-4 col-lg-3 mb-4">
                                        @include('frontend.properties.partials.card')
                                    </div>
                                @endforeach
                                <div class="w-100 d-block">
                                    @include('frontend.adverts.partials.fullwidth')
                                </div>
                                @foreach($properties->skip(4)->take(4) as $property)
                                    <div class="col-12 col-md-4 col-lg-3 mb-4">
                                        @include('frontend.properties.partials.card')
                                    </div>
                                @endforeach
                                <div class="w-100 d-block">
                                    @include('frontend.adverts.partials.fullwidth')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="w-100 d-block">
                    @include('frontend.adverts.partials.fullwidth')
                </div>
            </div>
        </div>
        <div class="bg-white" style="padding: 160px 0;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="mb-4">
                            <h2 class="text-main-dark">Why Choose Our Platform</h2>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-12 mb-4">
                                <div class="lg-circle text-center mb-3 rounded-circle bg-theme-color text-white">
                                    <div style="line-height: 50px;">01</div>
                                </div>
                                <div class="">
                                    <div class="text-main-dark">As a professional and non-professional service provider, we help you advertise your talent to the world by leveraging innovative technologies to get you connected in the market locally and globally.</div>
                                </div>      
                            </div>
                            <div class="col-12 col-md-6 col-lg-12 mb-4">
                                <div class="lg-circle text-center mb-3 rounded-circle bg-theme-color text-white">
                                    <div style="line-height: 50px;">02</div>
                                </div>
                                <div class="">
                                    <div class="text-main-dark">As a Provider of quality construction equipment and building materials, our platform gives you direct access to retailers, distributors, whole-sellers, factory producers and buyers.</div>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 h-100 mb-4">
                        <div class="position-relative">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-12 mb-4">
                                    <img src="/images/banners/rin.jpg" class="img-fluid w-100 h-100 border">
                                </div>
                            </div>
                        </div>    
                    </div>
                </div> 
            </div>  
        </div>
        <div class="home-agents">
            <div class="container-fluid">
                <div class="mb-3">
                    <h5 class="text-theme-color">Global Realtors</h5>
                    <h2 class="text-main-dark">Meet Our Realtors</h2>
                </div>
                @set('realtors', \App\Models\Profile::latest()->where(['role' => 'realtor'])->take(4)->get())
                @if(empty($realtors))
                    <div class="alert alert-danger">No Realtors Yet</div>
                @else
                    <div class="row">
                        @foreach($realtors as $realtor)
                            <div class="col-12 col-md-4 col-lg-3 mb-4">
                                @include('frontend.realtors.partials.card')
                            </div>
                        @endforeach
                    </div>  
                @endif
            </div>
        </div>
    </div>
    @include('frontend.layouts.bottom')
@include('layouts.footer')