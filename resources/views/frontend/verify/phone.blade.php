@include('layouts.header')
	<div class="min-vh-100">
		<div class="container">
			<div class="row justify-content-md-center justify-content-sm-start py-5">
				<div class="col-12 col-md-6 col-lg-4">
					<div class="">
						<div class="mb-3 w-100" style="height: 40px;">
							<a href="{{ route('home') }}">
								<img src="/images/logos/logo.png" class="img-fluid w-75 h-100 object-cover">
							</a>
						</div>
					</div>
					<section class="">
						<div class="alert alert-warning mb-4">Enter the code sent to your phone for verification.</div>
						<form action="javascript:;" method="post" class="verify-phone-form card-raduis mb-4 p-4 border" data-action="{{ route('otp.verify', ['reference' => $reference ?? '']) }}" autocomplete="off">
						    <div class="form-row">
						        <div class="form-group col-12 mb-4">
						            <label class="text-main-dark">Enter code</label>
							        <input type="text" name="code" class="form-control code" placeholder="e.g., 908894">
						            <small class="error code-error text-danger"></small>
						        </div>
						    </div>
						    <div class="alert px-3 verify-phone-message d-none mb-3"></div>
						    <button type="submit" class="btn btn-lg bg-theme-color btn-block icon-raduis text-white verify-phone-button mb-2">
						        <img src="/images/spinner.svg" class="mr-2 d-none verify-phone-spinner mb-1">
						        Verify
						    </button>
						</form>
						<div class="p-4 border card-raduis">
							<div class="text-main-dark mb-3">Didn't receive any code or expired?</div>
							<div class="resend-otp" data-url="{{ route('resend.otp', ['reference' => $reference ?? '']) }}">
								<a href="javascript:;" class="btn btn-lg bg-main-dark btn-block icon-raduis text-white resend-otp-button mb-2">
							        <img src="/images/spinner.svg" class="mr-2 d-none resend-otp-spinner mb-1">
							        Resend code
							    </a>
							</div>	
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
@include('layouts.footer')