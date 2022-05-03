@include('layouts.header')
<div class="bg-alabaster min-vh-100">
    @include('frontend.partials.navbar')
    <div class="position-relative">
        <div class="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form method="post" action="javascript:;" class="update-password-form p-4 bg-white" data-action="{{ route('password.update') }}" autocomplete="off">
                            <input type="hidden" name="email" value="{{ $user->email ?? null }}">
                            <div class="form-group">
                                <label class="text-smoky font-weight-bold">Password</label>
                                <input type="password" class="form-control password rounded-0" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                <small class="invalid-feedback password-error"></small>
                            </div>
                            <div class="form-group">
                                <label class="text-smoky font-weight-bold">Confirm Password</label>
                                <input type="password" class="form-control confirmpassword rounded-0" name="confirmpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                <small class="invalid-feedback confirmpassword-error"></small>
                            </div>
                            <div class="alert mb-3 update-password-message d-none"></div>
                            <div class="mb-3 mt-4">
                                <button type="submit" class="btn rounded-0 bg-violet text-white update-password-button px-4 font-weight-bold">
                                    <img src="/images/svgs/spinner.svg" class="mr-2 d-none update-password-spinner mb-1">
                                    Reset
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="">
                            <img src="/images/banners/safe.png" class="img-fluid w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer') 