@include('layouts.header')
    <div class="min-vh-100 bg-main-ash">
        @include('admin.layouts.navbar')
        <div class="section-padding pb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <div class="alert alert-info m-0">
                            {{ $subscriptions->total() }} Subscription(s)
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <div class="alert alert-info m-0">
                            <div class="">
                                <i class="icofont-notification"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-4">
                    <div class="col-12">
                        @if(empty($subscriptions->count()))
                            <div class="alert-info alert">No subscriptions yet</div>
                        @else
                            <div class="row">
                                @foreach($subscriptions as $subscription)
                                    <div class="col-12 col-md-3 col-lg-2 mb-5">
                                        @include('admin.subscriptions.partials.card')
                                    </div>
                                @endforeach
                            </div>
                            {{ $subscriptions->onEachSide(1)->links('vendor.pagination.default') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')    