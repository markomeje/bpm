@include('layouts.header')
	<div class="min-vh-100">
		<div class="container">
			<div class="d-flex justify-content-md-center justify-content-sm-start mb-4">
				<div class="mb-4 w-100" style="height: 49px;">
					<a href="{{ route('home') }}">
						<img src="/images/logos/logo.png" class="img-fluid w-100">
					</a>
				</div>
			</div>
			<section class="">
				<div class="alert alert-warning mb-4">An account verification code have been sent to your email and phone number. Please enter the code below to verify your account.</div>
				<form action="javascript:;" method="post" class="verify-account-form mb-4 p-4" data-action="{{ route('signup.activate') }}" autocomplete="off">
				    <div class="form-row">
				        <div class="form-group col-12">
				            <label class="text-white">Verify Code</label>
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
			</div>
		</div>
	</div>
@include('layouts.footer')