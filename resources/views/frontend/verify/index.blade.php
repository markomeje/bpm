@include('layouts.header')
	<div class="position-relative">
		<div class="verify-banner">
			<div class="container">
				<div class="row min-vh-100 justify-content-center align-items-center">
					<div class="login-right col-12 col-md-4 mb-4">
						<section class="pt-5">
							<div class="w-100 mb-4 pb-4" style="max-width: 350px; border-bottom: 1px solid var(--main-dark);">
								<a href="{{ route('home') }}" class="">
									<img src="/images/logos/logo.png" class="img-fluid w-100">
								</a>
								<h1 class="text-white font-weight-bolder m-0 p-0">Services Limited</h1>
							</div>
						</section>
						<section class="">
							<h1 class="font-weight-bolder mb-3">
								<span class="text-white">Verify</span> 
								<span class="text-main-green">Here</span>
							</h1>
							<div class="alert alert-warning mb-4">Please check your email. Your account verification details have been sent to your email and phone number.</div>

							<form action="javascript:;" method="post" class="verify-account-form mb-4 p-4" style="background-color: rgba(0, 0, 0, 0.5);" data-action="{{ route('signup.activate') }}" autocomplete="off">
							    <div class="form-row">
							        <div class="form-group col-12">
							            <label class="text-white">Phone Verify Code</label>
								        <input type="text" name="code" class="form-control code" placeholder="e.g., 908894">
							            <small class="error code-error text-danger"></small>
							        </div>
							    </div>
							    <button type="submit" class="btn btn-lg bg-main-green btn-block text-white verify-account-button mb-4">
							        <img src="/images/spinner.svg" class="mr-2 d-none verify-account-spinner mb-1">
							        Verify
							    </button>
							    <div class="alert px-3 verify-account-message d-none mb-3"></div>
							</form>
							<div class="dropdown">
								<p class="text-white d-inline m-0">Didn't receive a code or expired?</p> 
								<a class="text-main-green font-weight-bolder" data-toggle="dropdown" href="javascript:;">
									<p class="d-inline">Resend Code</p>
								</a>
						    	<div class="dropdown-menu w-100 rounded border-0 shadow p-0">
						    		<p class="dropdown-header bg-main-ash text-main-dark p-4">Resend Code</p>
						    		<div class="dropdown-item p-4">
						    			<form action="javascript:;" class="resend-code-form">
						    				<div class="form-group">
										    	<label class="text-main-dark">Email</label>
										    	<input type="email" class="form-control" name="email" placeholder="e.g., email@example.com">
										    	<small class="invalid-feedback email-error"></small>
										  	</div>
										  	<div class="form-group mb-4">
										    	<label class="text-main-dark">Phone</label>
										    	<input type="number" class="form-control phone" name="phone" placeholder="e.g., 09062972785">
										    	<small class="invalid-feedback phone-error"></small>
										  	</div>
										  	<div class="alert mb-4 resend-code-message d-none"></div>
										  	<button type="submit" class="btn bg-main-green btn-lg btn-block text-white resend-code-button px-4">
					                            <img src="/images/spinner.svg" class="mr-2 d-none resend-code-spinner mb-1">
					                            Resend
					                        </button>
						    			</form>	
									</div>
						    	</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
@include('layouts.footer')