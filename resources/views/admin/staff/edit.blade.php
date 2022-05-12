@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            @if(empty($staff))
                <div class="alert alert-danger">Staff details not found.</div>
            @else
                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="alert alert-info mb-4">Edit staff details</div>
                        <div class="bg-white shadow-sm rounded p-4">
                            <form class="edit-staff" action="javascript:;" method="post" data-action="{{ '' }}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-main-dark">Email</label>
                                        <input type="email" class="form-control email" name="email" placeholder="e.g., email@email.com" value="{{ $staff->email }}">
                                        <small class="invalid-feedback email-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-main-dark">Fullname</label>
                                        <input type="text" class="form-control fullname" name="fullname" placeholder="e.g., John Rel" value="{{ $staff->name }}">
                                        <small class="invalid-feedback fullname-error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-main-dark">Phone</label>
                                        <input type="text" class="form-control phone" name="phone" placeholder="e.g., 08138982100" value="{{ $staff->phone }}">
                                        <small class="invalid-feedback phone-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-main-dark">Role</label>
                                        <input type="text" class="form-control role" name="role" placeholder="e.g., admin" value="{{ $staff->role }}">
                                        <small class="invalid-feedback role-error"></small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="alert alert-info mb-4">Update staff permissions</div>
                        <div class="">
                            <form class="add-permissions" action="javascript:;" method="post" data-action="{{ '' }}">
                                @set('functions', \App\Models\Permission::$resources)
                                @if(!empty($functions))
                                    @foreach($functions as $name => $function)
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-white">
                                                {{ ucwords($function['description']) }}
                                            </div>
                                            <div class="card-body pb-0">
                                                @if(empty($function['actions']))
                                                    <div class="alert alert-info">No actions to assign</div>
                                                @else
                                                    <div class="row">
                                                        @foreach($function['actions'] as $action => $detail)
                                                            <div class="col-6 col-md-4 col-lg-6 mb-4">
                                                                <div class="bg-main-dark rounded d-flex align-items-center justify-content-between p-4">
                                                                    <div class="text-white">
                                                                        {{ ucfirst($action) }}
                                                                    </div>
                                                                    <div class="">
                                                                        @set('random', \Str::random(32))
                                                                        <div class="form-group m-0">
                                                                            <div class="custom-control custom-switch m-0">
                                                                                <input type="checkbox" value="{{ $action }}" name="status" class="custom-control-input status toggle-staff-status" id="{{ $random }}" {{ $action ? 'checked' : '' }} data-url="{{ route('admin.staff.toggle.status', ['id' => $random, 'status' => $action ? 'inactive' : 'active']) }}">
                                                                                <label class="custom-control-label text-main-dark cursor-pointer" for="{{ $random }}"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footer')    