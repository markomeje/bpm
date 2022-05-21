@include('layouts.header')
    <div class="min-vh-100 bg-main-ash">
        @include('admin.layouts.navbar')
        <div class="section-padding pb-4">
            <div class="container-fluid">
                @can('view', ['contents'])
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="alert alert-info d-flex mb-4 align-items-center justify-content-between mb-4">
                                <div class="">+{{ \App\Models\Content::count() }} Contents</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="alert alert-info d-flex mb-4 align-items-center justify-content-between mb-4">
                                <a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#add-content">
                                    <i class="icofont-plus"></i>
                                </a>
                                @include('admin.contents.partials.add')
                            </div>
                        </div>
                    </div>  
                    <div class="">
                        @if(empty($contents->count()))
                            <div class="alert-info alert">No contents yet</div>
                        @else
                            <div class="row">
                                @foreach($contents as $content)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                                        @include('admin.contents.partials.card')
                                    </div>
                                    @include('admin.contents.partials.edit')
                                @endforeach
                            </div>
                            {{ $contents->links('vendor.pagination.default') }}
                        @endif
                    </div>
                @endcan
            </div>
        </div>
    </div>
@include('layouts.footer')    