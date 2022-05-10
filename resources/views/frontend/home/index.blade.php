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
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="">
                            <h4 class="text-main-dark mb-4">Global Properties</h4>
                            <ul class="nav nav-pills " id="" role="tablist">
                                @set('actions', \App\Models\Property::distinct()->pluck('action'))
                                @if(!empty($actions))
                                    @foreach($actions as $key => $action)
                                        @if($action !== 'sold')
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link border-theme-color mr-3 mb-4 py-1 text-main-dark px-4 {{ $action == 'sale' ? 'active' : '' }}" id="pills-{{ $action }}-tab" data-toggle="pill" href="#pills-{{ $action }}" role="tab" aria-controls="pills-{{ $action }}" aria-selected="true">
                                                    <small class="position-relative">
                                                        {{ ucwords(\App\Models\Property::$actions[$action]) }}
                                                    </small>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div> 
                    <div class="tab-content" id="">
                        @if(empty($properties->count()))
                            <div class="alert-info alert">No Properties Yet</div>
                        @else
                            @if(!empty($actions))
                                @foreach($actions as $key => $action)
                                    @if($action !== 'sold')
                                        <div class="tab-pane fade show {{ $action == 'sale' ? 'active' : '' }}" id="pills-{{ $action }}" role="tabpanel" aria-labelledby="pills-{{ $action }}-tab">
                                            <div class="row">
                                                @foreach($properties as $property)
                                                    @if($property->action == $action)
                                                        <div class="col-12 col-md-4 col-lg-3 mb-4">
                                                            @include('frontend.properties.partials.card')
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>  
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="row">
                                    @foreach($properties as $property)
                                        <div class="col-12 col-md-4 col-lg-3 mb-4">
                                            @include('frontend.properties.partials.card')
                                        </div>
                                    @endforeach
                                </div>  
                            @endif
                        @endif
                    </div>
                </div>
                <div class="">
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