@include('layouts.header')
    <div class="min-vh-100">
        @include('admin.layouts.navbar')
        <div class="section-padding">
            <div class="container-fluid">
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <div class="d-flex">
                        <div class="py-1 px-4 rounded-pill border-dark-500 mr-3 mb-3 text-muted cursor-pointer" data-toggle="modal" data-modal="#add-plan" style="background-color: rgba(0, 0, 0, 0.5);">
                            <small class="">
                                <i class="icofont-caret-down"></i>
                            </small>
                            <small class="">
                                {{ \App\Models\Plan::count() }} Plan(s)
                            </small>
                        </div>
                        <div class="py-1 px-4 rounded-pill border-dark-500 mr-3 mb-3 text-white cursor-pointer bg-info" data-toggle="modal" data-target="#add-plan">
                            <small class="position-relative" style="font-size: 8px; top: -2px;">
                                <i class="icofont-ui-add"></i>
                            </small>
                            <small class="">Add</small>
                        </div>
                        @include('admin.plans.partials.add') 
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="py-1 px-4 rounded-pill border-dark-500 text-muted mb-3 cursor-pointer" data-toggle="modal" data-modal="#add-plan" style="background-color: rgba(0, 0, 0, 0.5);">
                            <small class="">
                                <i class="icofont-caret-down"></i>
                            </small>
                            <small class="">Filter</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-4">
                        @if(empty($plans->count()))
                            <div class="alert-info alert">No plans yet</div>
                        @else
                            <div class="row">
                                @foreach($plans as $plan)
                                    <div class="col-12 col-md-4 col-lg-3 mb-4">
                                        @include('admin.plans.partials.card')
                                    </div>
                                    @include('admin.plans.partials.edit')
                                @endforeach
                            </div>
                            {{ $plans->onEachSide(1)->links('vendor.pagination.default') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')    