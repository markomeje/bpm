@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content pb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="mb-3">
                    <h4 class="text-main-dark">My Services</h4>
                    <div class="text-muted">You listed services would show here.</div>
                </div>
                <div class="d-flex align-items-center flex-wrap">
                    <div class="d-flex align-items-center">
                        <a href="javascript:;" class="bg-theme-color btn px-4 text-white mb-4 text-decoration-none" data-toggle="modal" data-target="#create-service">
                            <small class="mr-1">
                                <i class="icofont-plus"></i>
                            </small>
                            <div class="d-inline">Create Service</div>
                        </a>
                    </div>
                    @include('user.services.partials.create')
                </div>
            </div>
            <div class="">
                @if(empty($services->count()))
                    <div class="alert-danger alert">You have no services yet</div>
                @else
                    <div class="row">
                        @foreach($services as $service)
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                @include('user.services.partials.card')
                            </div>
                            @include('user.services.partials.edit')
                        @endforeach
                    </div>
                    {{ $services->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    