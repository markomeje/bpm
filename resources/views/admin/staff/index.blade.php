@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info justify-content-between d-flex align-items-center mb-4">
                        <div class="mr-2">({{ \App\Models\Staff::count() }}) Staff</div>
                        <a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#add-staff">
                            <i class="icofont-plus"></i>
                        </a>
                    </div>
                    @include('admin.staff.partials.add')
                </div>
            </div>
            <div class="">
                @if(empty($staffs->count()))
                    <div class="alert-danger alert">No staff yet</div>
                @else
                    <div class="row">
                        @foreach($staffs as $staff)
                            <div class="col-12 col-md-4 col-lg-3 mb-4">
                                @include('admin.staff.partials.card')
                            </div>
                            @include('admin.staff.partials.edit')
                        @endforeach
                    </div>
                    {{ $staffs->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    