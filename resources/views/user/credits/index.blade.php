@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content user-properties-banner pb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="mb-3">
                    <h4 class="text-main-dark">All Credits ( {{ auth()->user()->credits->count() }} )</h4>
                    <div class="text-muted">List of all your purchased credits.</div>
                </div>
                <div class="">
                    <div class="d-flex align-items-center">
                        <a href="javascript:;" class="bg-theme-color text-white btn mb-4 px-4" data-toggle="modal" data-target="#buy-credit">
                            <small class="mr-1">
                                <i class="icofont-plus"></i>
                            </small>
                            <div class="d-inline">Buy credit</div>
                        </a>
                        @include('user.credits.partials.buy')
                    </div>
                </div>
            </div>
            <div class="">
                @if(!empty($reference))
                    <?php $response = json_decode($verify->content(), true); ?>
                    <div class="alert mb-4 {{ $response['status'] === 0 ? 'alert-danger' : 'alert-success' }}">
                        {{ $response['info'] }}
                    </div>
                @endif
                @if(empty($credits->count()))
                    <div class="alert-info alert">No credits yet</div>
                @else
                    <div class="row">
                        @foreach($credits as $credit)
                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                @include('user.credits.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $credits->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    