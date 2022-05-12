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
                                    @foreach($functions as $resource => $function)
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-white">
                                                {{ ucwords($function['description']) }}
                                            </div>
                                            <div class="card-body px-4 pt-4 pb-0">
                                                @if(empty($function['actions']))
                                                    <div class="alert alert-info">No actions to assign</div>
                                                @else
                                                    <div class="row">
                                                        @foreach($function['actions'] as $action => $detail)
                                                            @set('permission', \App\Models\Permission::where(['resource' => $resource, 'permission' => $action, 'user_id' => $staff->id])->first())
                                                            <div class="col-12 col-md-4 mb-4">
                                                                <div class="bg-main-dark icon-raduis rounded d-flex align-items-center justify-content-between p-4">
                                                                    <div class="dropdown">
                                                                        <a href="javascript:;" class="text-white cursor-pointer text-underline" id="{{ auth()->id() }}" data-toggle="dropdown">
                                                                            {{ ucfirst($action) }}
                                                                        </a>
                                                                        <div class="dropdown-menu border-0 p-4 shadow dropdown-menu-left" aria-labelledby="{{ auth()->id() }}" style="width: 220px !important;">
                                                                            <div class="text-muted">
                                                                                {{ ucfirst($detail) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown">
                                                                        <a href="javascript:;" class="text-white cursor-pointer text-decoration-none" id="{{ auth()->id() }}" data-toggle="dropdown">
                                                                            @if(empty($permission))
                                                                                <div class="bg-danger sm-circle rounded-circle text-center text-white">
                                                                                    <div class="tiny-font position-relative" style="top: 3.2px;">
                                                                                        <i class="icofont-exclamation-circle"></i>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="bg-success sm-circle rounded-circle text-center">
                                                                                    <div class="tiny-font position-relative" style="top: 3px;">
                                                                                        <i class="icofont-check-alt"></i>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </a>
                                                                        <div class="dropdown-menu border-0 p-4 shadow dropdown-menu-right" aria-labelledby="{{ auth()->id() }}" style="width: 220px !important;">
                                                                            @if(empty($permission))
                                                                                <form method="post" class="assign-permission-form" action="javascript:;" data-action="{{ route('admin.permission.assign', ['resource' => $resource, 'permission' => $action, 'user_id' => $staff->id]) }}">
                                                                                    <button type="submit" class="btn btn-success btn-block assign-permission-button">
                                                                                        <img src="/images/spinner.svg" class="mr-2 d-none assign-permission-spinner mb-1">Assign
                                                                                    </button>
                                                                                    <div class="alert d-none mt-4 tiny-font assign-permission-message"></div>
                                                                                </form>
                                                                            @else
                                                                                <form method="post" class="remove-permission-form" action="javascript:;" data-action="{{ route('admin.permission.remove', ['id' => $permission->id]) }}">
                                                                                    <button type="submit" class="btn btn-danger btn-block remove-permission-button">
                                                                                        <img src="/images/spinner.svg" class="mr-2 d-none remove-permission-spinner mb-1">Remove
                                                                                    </button>
                                                                                    <div class="alert d-none mt-4 tiny-font remove-permission-message"></div>
                                                                                </form>
                                                                            @endif
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