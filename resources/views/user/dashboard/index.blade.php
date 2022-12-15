@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content pb-4">
        <div class="container">
            @if(!empty($reference))
                @if(isset($verify['status']))
                    <a href="{{ route('user.dashboard') }}" class="alert mb-4 text-decoration-none d-block alert-{{ $verify['status'] === 0 ? 'danger' : 'success' }}">
                        {{ $verify['info'] }} 
                    </a>
                @endif
            @endif
            <?php $user = auth()->user(); ?>
            @if(!empty($user->name))
                <div class="alert-info alert mb-4 d-flex justify-content-between al;align-items-center">
                    <div class="">
                        <span class="mr-2">Welcome</span>
                        <a href="{{ route('user.profile') }}">
                            {{ ucwords(auth()->user()->name) }}
                        </a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        @include('user.dashboard.partials.panels')
                    </div>
                    @if(empty($user->subscription))
                    @include('user.subscriptions.partials.subscribe')
                        <div class="alert alert-danger">No Subscription. <a href="javascript:;" data-toggle="modal" data-target="#membership-subscription">Subscribe Here</a></div>
                    @else
                        <?php $subscription = $user->subscription; $timing = \App\Helpers\Timing::calculate($subscription->duration, $subscription->expiry, $subscription->started); ?>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="icon-raduis alert bg-info position-relative m-0 py-4">
                                    <div class="mb-3">
                                        <h5 class="text-white">{{ ucfirst($subscription->membership->name) }} Membership</h5>
                                    </div>
                                    <div class="p-2 border mb-3">
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar m-0 bg-{{ $timing->progress() >= 90 ? 'danger' : 'dark' }}"  role="progressbar" style="width: {{ $timing->progress() }}%;" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="text-white">
                                            {{ $timing->daysleft() }} Days Left
                                        </div>
                                        <div class="text-white">
                                            {{ $timing->progress() }}% Progress
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- Advert section starts --}}
                    {{-- <div class="">
                        <div class="d-flex justify-content-between align-items-center alert alert-info mb-4 icon-raduis">
                            <span class="">Recent Adverts</span>
                            <small class="">
                                <a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#post-advert">
                                    <i class="icofont-plus"></i>
                                </a>
                            </small>
                            @include('user.adverts.partials.post')
                        </div>
                        <?php $adverts = \App\Models\Advert::latest()->where(['user_id' => auth()->id()])->get(); ?>
                        @if(empty($adverts->count()))
                            <div class="alert alert-danger">You have no adverts. Click (+) to post an advert.</div>
                        @else
                             <div class="row">
                                @foreach($adverts as $advert)
                                    <div class="col-12 mb-4">
                                        @include('user.adverts.partials.card')
                                    </div>
                                    @include('user.adverts.partials.edit')
                                @endforeach
                            </div>
                        @endif
                    </div>  --}}  
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card position-relative shadow-sm border-0 user-payments-card">
                                <div class="card-header py-5">
                                    <h5 class="text-white">Total Payments</h5>
                                    <h4 class="text-white m-0">
                                        NGN{{ number_format(\App\Models\Payment::where(['user_id' => auth()->id(), 'status' => 'paid'])->sum('amount')) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="alert alert-info mb-4 d-flex justify-content-between align-items-center">
                            <div class="">Recent properties</div>
                            <small>
                                <a href="{{ route('user.property.add') }}" class="text-primary text-decoration-none">
                                    <i class="icofont-plus"></i>
                                </a>
                            </small>
                        </div>
                        @if(empty($properties->count()))
                            <div class="alert alert-warning mb-4">No properties listed yet</div>
                        @else
                            <div class="row">
                                @foreach($properties->take(4) as $property)
                                    <div class="col-12 col-md-4 col-lg-6 mb-4">
                                        @include('user.properties.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            <div class="alert alert-info mb-4">
                                <a href="{{ route('user.properties') }}" class="d-block">See All Your Properties</a>
                            </div>
                        @endif
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    