@include('layouts.header')
    @include('frontend.layouts.navbar')
	<section class="bg-main-ash py-5">
		<div class="container-fluid my-5 pt-2">
			<div class="row align-items-center my-5 pt-5">
				<?php if($expired): ?>
					<div class="col-12">
						<div class="alert alert-danger m-0">Your password reset link have expired. Please <a href="{{ route('forgot.password') }}">Click Here</a> for another link.</div>
					</div>
				<?php elseif(empty($token)): ?>
					<div class="col-12">
						<div class="alert alert-danger m-0">Your password reset link is invalid. Please <a href="{{ route('forgot.password') }}">Click Here</a> for another link.</div>
					</div>
				<?php elseif(empty($user)): ?>
					<div class="col-12">
						<div class="alert alert-danger m-0">Sorry. We couldn't find any account with your email. Please <a href="{{ route('signup') }}">Signup Here</a>.</div>
					</div>
				<?php else: ?>
					<div class="col-12 col-md-5">
						<h3 class="text-main-dark mb-3">Reset Password</h3>
						<div class="text-main-dark mb-3">Reset you password below. Minimum of eight characters required.</div>
						<form method="post" action="javascript:;" class="reset-password-form p-4 bg-white" data-action="{{ route('password.reset') }}" autocomplete="off">
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
		                    <div class="alert mb-3 reset-password-message d-none"></div>
		                    <div class="mb-3 mt-4">
		                        <button type="submit" class="btn bg-theme-color text-white reset-password-button px-4">
		                            <img src="/images/spinner.svg" class="mr-2 d-none reset-password-spinner mb-1">
		                            Reset
		                        </button>
		                    </div>
			            </form>
					</div>
					<div class="col-12 col-md-7">
                        <div class="">
                            <img src="/images/banners/safe.png" class="img-fluid w-100">
                        </div>
                    </div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	@include('frontend.layouts.bottom')
@include('layouts.footer')