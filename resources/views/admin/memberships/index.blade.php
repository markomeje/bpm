@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="alert alert-info justify-content-between d-flex align-items-center mb-4">
                        <div class="mr-2">({{ \App\Models\Membership::count() }}) Membership Plans</div>
                        {{-- <a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#add-membership">
                            <i class="icofont-plus"></i>
                        </a> --}}
                        {{-- @include('admin.memberships.partials.add') --}}
                    </div>
                    <div class="">
                        @if(empty($memberships->count()))
                            <div class="alert-info alert">No memberships yet</div>
                        @else
                            <div class="row">
                                @foreach($memberships as $membership)
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        @include('admin.memberships.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            {{ $memberships->links('vendor.pagination.default') }}
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="alert alert-info d-flex mb-4 align-items-center">
                        <span class="">Recent Subscribers</span>
                    </div>
                    <div>
                        @set('subscriptions', \App\Models\Subscription::latest()->take(5)->get())
                        @if(empty($subscriptions->count()))
                            <div class="alert alert-danger">No Recent Subscribers</div>
                        @else
                            <div class="row">
                                @foreach($subscriptions as $subscription)
                                    <div class="col-12 mb-4">
                                        @include('admin.memberships.partials.sidebar')
                                    </div>
                                @endforeach
                            </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    