@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            @if(empty($user->profile))
                <div class="alert alert-danger">No Profile yet</div>
            @else
                <div class="row">
                    @set('role', strtolower($user->profile->role ?? ''))
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="mb-4 icon-raduis bg-white shadow-sm text-center">
                            <div class="w-auto position-relative">
                                <div class="p-4 rounded">
                                    <div class="d-flex align-items-center mb-4 p-3 shadow-sm alert alert-info">
                                        <small class="text-main-dark mr-2">
                                            {{ ucfirst($user->profile->designation) }}
                                        </small>
                                        <small class="text-main-dark">
                                            {{ ucwords($user->profile->role) }}
                                        </small>
                                    </div>
                                    <div class="" style="height: 180px;">
                                        @if(empty($user->profile->image))
                                            <div class="w-100 h-100 text-center" style="background-color: {{ randomrgba() }}; line-height: 160px;">
                                                <small class="text-main-dark">
                                                    {{ substr(strtoupper($user->name), 0, 1) }}
                                                </small>
                                            </div>
                                        @else
                                            <img src="{{ $user->profile->image }}" class="img-fluid object-cover w-100 h-100">
                                        @endif
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success text-center rounded-circle sm-circle mr-2">
                                    <small class="text-white tiny-font">
                                        <i class="icofont-tick-mark"></i>
                                    </small>
                                </div>
                                <div class="">
                                    <h5 class="text-main-dark m-0">
                                        {{ ucwords($user->name) }}
                                    </h5>
                                </div>s
                            </div>
                            @if($role == 'artisan')
                                @if(empty($user->services))
                                    <div class="alert alert-danger">No services listed</div>
                                @else
                                    <div class="d-flex flex-wrap">
                                        @foreach($user->services as $service)
                                            <small class="px-3 py-1 bg-success rounded-pill mb-3 mr-2">
                                                <small class="text-white">
                                                    {{ ucwords($service->skill->name ?? '') }}
                                                </small>
                                            </small>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                            <div class="text-main-dark mb-4">
                                {{ ucfirst($user->profile->description) }}
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <a href="tel:{{ $user->phone }}" class="btn btn-info btn-block icon-raduis">
                                            <small class="">
                                                <i class="icofont-phone"></i>
                                            </small>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <a href="mailto:{{ $user->email }}" class="btn btn-info btn-block icon-raduis">
                                            <span class="">
                                                <i class="icofont-send-mail"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <a href="{{ empty($user->profile->website) ? 'javascript:;' : $user->profile->website }}" class="btn btn-info btn-block icon-raduis">
                                            <small class="">
                                                <i class="icofont-web"></i>
                                            </small>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex align-items-center">
                                    <div class="text-theme-color mr-2">
                                        <i class="icofont-location-pin"></i>
                                    </div>
                                    <div class="text-main-dark">
                                        {{ ucwords($user->profile->city).', '.ucwords($user->profile->state) }}
                                    </div>
                                </div>
                                @if($user->socials()->exists())
                                    <div class="d-flex align-items-center justify-content-between rounded-0 bg-white shadow-sm w-100 p-3">
                                        @foreach($user->socials->take(5) as $social)
                                            <a href="{{ $social->company == 'whatsapp' ? "tel:{$social->phone}" : $social->link }}" class="text-center bg-theme-color rounded-circle border text-decoration-none md-circle">
                                                <small class="text-white">
                                                    <i class="icofont-{{ $social->company }}"></i>
                                                </small>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-danger">No social links</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <div class="icon-raduis py-4 alert d-flex align-items-center justify-content-between bg-pink position-relative m-0">
                                    <div class="">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="text-main-dark text-shadow-white m-0">
                                                {{ number_format($user->reviews->count()) }}
                                            </h5>
                                        </div>
                                        <a href="{{ route('account.profile', ['id' => $user->profile->id, 'name' => \Str::slug($user->name)]) }}" class="text-white text-decoration-none">Reviews</a>
                                    </div>
                                    <div class="md-circle text-center bg-info rounded-circle position-relative">
                                        <small class="text-white h-100  position-relative tiny-font" style="top: 0px;">
                                            <i class="icofont-match-review"></i>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @if($role === 'realtor')
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="icon-raduis py-4 alert d-flex align-items-center justify-content-between bg-info position-relative m-0">
                                        <div class="">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="text-main-dark text-shadow-white m-0">
                                                    {{ number_format($user->properties->count()) }}
                                                </h5>
                                            </div>
                                            <a href="{{ route('account.profile', ['id' => $user->profile->id, 'name' => \Str::slug($user->name)]) }}" class="text-white" target="_blank">Properties</a>
                                        </div>
                                        <div class="md-circle text-center bg-pink rounded-circle position-relative">
                                            <small class="text-white h-100  position-relative tiny-font" style="top: 0px;">
                                                <i class="icofont-building-alt"></i>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($role === 'dealer')
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="icon-raduis py-4 alert d-flex align-items-center justify-content-between bg-info position-relative m-0">
                                        <div class="">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="text-main-dark text-shadow-white m-0">
                                                    {{ number_format($user->materials->count()) }}
                                                </h5>
                                            </div>
                                            <a href="{{ route('account.profile', ['id' => $user->profile->id, 'name' => \Str::slug($user->name)]) }}" class="text-white" target="_blank">Materials</a>
                                        </div>
                                        <div class="md-circle text-center bg-pink rounded-circle position-relative">
                                            <small class="text-white h-100  position-relative tiny-font" style="top: 0px;">
                                                <i class="icofont-building"></i>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($role === 'artisan')
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="icon-raduis py-4 alert d-flex align-items-center justify-content-between bg-info position-relative m-0">
                                        <div class="">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="text-main-dark text-shadow-white m-0">
                                                    {{ $user->services()->exists() ? number_format($user->services->count()) : 0 }}
                                                </h5>
                                            </div>
                                            <a href="{{ route('account.profile', ['id' => $user->profile->id, 'name' => \Str::slug($user->name)]) }}" class="text-white text-decoration-none" target="_blank">Services</a>
                                        </div>
                                        <div class="md-circle text-center bg-pink rounded-circle position-relative">
                                            <small class="text-white h-100  position-relative tiny-font" style="top: 0px;">
                                                <i class="icofont-worker"></i>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="">
                            @if(empty($user->subscription))
                                <div class="alert alert-danger mb-4">No subscription</div>
                            @else
                                @set('subscription', $user->subscription)
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="card card-raduis border-0 bg-orange shadow-sm">
                                            <div class="card-header d-flex justify-content-between">
                                                <div class="text-white">Subscription</div>
                                                <div class="text-white">
                                                    {{ ucfirst($subscription->status) }}
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @set('duration', (int)$subscription->duration)
                                                @set('timing', \App\Helpers\Timing::calculate($duration, $subscription->expiry, $subscription->started))
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <div class="text-warning">
                                                            ({{ $timing->progress() }}%)
                                                        </div>
                                                        <div class="text-main-dark">
                                                            {{ ucfirst($subscription->membership->name) }} Plan
                                                        </div>
                                                    </div>
                                                    <div class="progress progress-bar-height">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-main-dark" role="progressbar" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-main-dark">
                                                        {{ $duration }} days total
                                                    </div>
                                                    <div class="text-main-dark">
                                                        {{ $timing->daysleft }} days left
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <small class="text-white">
                                                    {{ $subscription->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="">
                            <div class="alert alert-info mb-4">
                                Posted Adverts
                            </div>
                            @if($user->adverts()->exists())
                                @set('adverts', $user->adverts)
                                <div class="row">
                                    @foreach($adverts as $advert)
                                        @set('status', strtolower($user->status) ?? '')
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="card shadow-sm bg-white mt-4 border-top border-0">
                                                <a href="{{ empty($advert->banner) ? 'javascript:;' : $advert->banner }}" class="position-relative px-4 d-block" style="height: 170px !important; top: -18px;">
                                                    <img src="{{ empty($advert->banner) ? '/images/banners/placeholder.png' : $advert->banner }}" class="img-fluid h-100 object-cover border w-100">
                                                </a>
                                                <div class="card-body pt-0">
                                                    <?php  $timing = \App\Helpers\Timing::calculate($advert->credit->duration, $advert->expiry, $advert->started); ?>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="">
                                                            {{ $timing->progress() }}%
                                                        </div>
                                                        <div class="text-{{ $status == 'active' ? 'success' : 'danger' }}">
                                                            {{ ucfirst($status) }}
                                                        </div>
                                                    </div>   
                                                </div>
                                                <div class="card-footer bg-info">
                                                    <div>
                                                        <small class="text-main-dark">
                                                            {{ $advert->created_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-danger mb-4">No adverts</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-12 col-lg-3">
                        <div class="alert alert-info mb-4">Recent users</div>
                        <div class="row">
                            @set('users', \App\Models\User::latest()->inRandomOrder()->take(4)->get())
                            @if(empty($users))
                                <div class="alert alert-danger">No recent users</div>
                            @else
                                @foreach($users as $user)
                                    <div class="col-12 col-md-6 col-lg-12 mb-4">
                                        @include('admin.users.partials.card')
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footer')    