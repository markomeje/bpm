@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding min-vh-100 pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info d-flex align-items-center m-0">
                        {{ ucfirst($type ?? '') }} ({{ $payments->count() }})
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info d-flex align-items-center m-0">
                        <a class="text-decoration-none" href="javascript:;" data-target="#search-payments" data-toggle="modal">
                            <i class="icofont-search"></i>
                        </a>
                        {{-- Search Payments modal --}}
                        @include('admin.payments.forms.search')
                    </div>
                </div>
            </div>
            <div class="">
                @if(empty($payments->count()))
                    <div class="alert-danger alert">No payments found</div>
                @else
                    <div class="row">
                        @foreach($payments as $payment)
                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                @include('admin.payments.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $payments->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    