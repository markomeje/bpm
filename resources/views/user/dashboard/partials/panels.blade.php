<?php $role = auth()->user()->profile ? auth()->user()->profile->role : null; ?>
<div class="col-6 mb-4">
    <div class="icon-raduis alert bg-pink position-relative m-0">
        <div class="py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-main-dark text-shadow-white m-0">
                    {{ number_format(auth()->user()->reviews->count()) }}
                </h5>
            </div>
            <a href="{{ route('user.reviews') }}" class="text-white">Reviews</a>
        </div>
    </div>
</div>
<div class="col-6 mb-4">
    <div class="icon-raduis alert bg-info m-0">
        <div class="py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-main-dark text-shadow-white m-0">
                    {{ number_format(auth()->user()->properties->count()) }}
                </h5>
            </div>
            <a href="{{ route('user.properties') }}" class="text-white">Properties</a>
        </div>
    </div>
</div>
<div class="col-6 mb-4">
    <div class="icon-raduis position-relative alert bg-info m-0">
        <div class="py-2">
            <div class="d-flex justify-content-between align-items-center align-items-center">
                <h5 class="text-main-dark text-shadow-white m-0">
                    {{ number_format(auth()->user()->materials->count()) }}
                </h5>
            </div>
            <a href="{{ route('user.materials') }}" class="text-white">Materials</a>
        </div>
    </div>
</div>
<div class="col-6 mb-4">
    <div class="icon-raduis position-relative alert bg-info m-0">
        <div class="py-2">
            <div class="d-flex justify-content-between align-items-center align-items-center">
                <h5 class="text-main-dark text-shadow-white m-0">
                    {{ number_format(auth()->user()->services->count()) }}
                </h5>
            </div>
            <a href="{{ route('user.services') }}" class="text-white">Services</a>
        </div>
    </div>
</div>
<div class="col-12 mb-4">
    <div class="icon-raduis bg-white shadow-sm p-4 border-0" >
        <div class="pb-0 position-relative">
            <div class="mb-3">
                <h5 class="text-main-dark">Total Credits</h5>
                <?php $credits = \App\Models\Credit::where(['user_id' => auth()->id()])->get(); ?>
                <h5 class="">
                    {{ empty($credits->count()) ? 0 : number_format($credits->sum('units')) }} Units
                </h5>
            </div>
            <div class="row">
                <div class="col-6 col-md-3 col-lg-4">
                    <a href="javascript:;" class="btn bg-theme-color btn-block text-white" data-toggle="modal" data-target="#buy-credit">Buy Credit</a>
                </div>
                <div class="col-6 col-md-3 col-lg-4">
                    @include('user.credits.partials.buy')
                    <a href="{{ route('user.credits') }}" class="btn bg-theme-color btn-block text-white">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>
