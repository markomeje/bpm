@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info m-0">
                        Your Settings
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="alert alert-info m-0">
                        {{ date("F j, Y") }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="">
                        <div class="text-main-dark mb-4">Update your password</div>
                        <div class="bg-white shadow-sm p-4 rounded">
                            <form method="post" action="javascript:;" class="update-password-form" data-action="{{ route('admin.password.update') }}" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="text-main-dark">Current Password</label>
                                        <div class="input-group">
                                            <input type="password" name="currentpassword" class="form-control currentpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                        </div>
                                        <small class="error currentpassword-error text-danger"></small>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="text-main-dark">New Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                        </div>
                                        <small class="error password-error text-danger"></small>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="text-main-dark">Retype New Password</label>
                                        <div class="input-group">
                                            <input type="password" name="retype" class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                        </div>
                                        <small class="error retype-error text-danger"></small>
                                    </div>
                                </div>
                                <div class="alert mb-3 update-password-message d-none"></div>
                                <div class="d-flex justify-content-right mb-3 mt-1">
                                    <button type="submit" class="btn bg-info btn-lg px-4 text-white update-password-button">
                                        <img src="/images/spinner.svg" class="mr-2 d-none update-password-spinner mb-1">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')