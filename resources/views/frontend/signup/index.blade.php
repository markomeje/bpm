@include('layouts.header')
	<div class="signup-banner min-vh-100">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-12 col-md-8 col-lg-6 mb-4">
					<div class="d-flex justify-content-md-center justify-content-sm-start">
						<div class="mb-3" style="width: 220px; height: 49px;">
							<a href="{{ route('home') }}" class="">
								<img src="/images/logos/logo.png" class="img-fluid w-100">
							</a>
						</div>
					</div>
					<div class="row justify-content-center align-items-center">
						<div class="col-12 col-md-9 col-lg-10">
							<p class="mb-4 text-main-dark text-md-center mx-lg-3 text-sm-left">Get started with our global properties listing platform. It's free.</p>
						</div>
					</div>
					<section class="">
						<form action="javascript:;" method="post" class="signup-form mb-4 p-4 border card-raduis" data-action="{{ route('signup.process') }}" autocomplete="off">
						    <div class="form-row">
						     	<div class="form-group col-md-6">
						            <label class="text-muted">Email</label>
							        <input type="email" name="email" class="form-control email" placeholder="e.g., email@you.com">
						            <small class="error email-error text-danger"></small>
						        </div>
						        <div class="form-group col-md-6">
						            <label class="text-muted">Phone</label>
						            <input type="number" name="phone" class="form-control phone" placeholder="e.g., +44062972785">
						            <small class="error phone-error text-danger"></small>
						        </div>
						    </div>
						    <div class="form-row">
						        <div class="form-group col-md-6">
						            <label class="text-muted">Password</label>
						            <input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
						            <small class="error password-error text-danger"></small>
						        </div>
						        <div class="form-group col-md-6">
						            <label class="text-muted">Retype Password</label>
						            <input type="password" name="retype" class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
						            <small class="error retype-error text-danger"></small>
						        </div>
						    </div>
						    <div class="form-group">
						        <div class="custom-control custom-switch">
						            <input type="checkbox" value="on" name="agree" class="custom-control-input agree" id="i-agree">
						            <label class="custom-control-label text-main-dark cursor-pointer" for="i-agree">Agree To Our <a href="javascript:;" class="text-primary">Terms and Conditions?</a></label>
						        </div>
						        <small class="error agree-error text-danger"></small>
						    </div>
						    <button type="submit" class="btn btn-lg icon-raduis bg-theme-color btn-block text-white signup-button mb-4">
						        <img src="/images/spinner.svg" class="mr-2 d-none signup-spinner mb-1">
						        Signup
						    </button>
						    <div class="alert px-3 signup-message d-none mb-3"></div>
						    <p class="text-main-dark mb-0">
								Already have an account? <a class="text-primary font-weight-bolder" href="{{ route('login') }}">Login</a>
							</p>
						</form>
					</section>
				</div>
			</div>
		</div>	
	</div>

@include('layouts.footer')