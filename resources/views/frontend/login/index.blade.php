@include('layouts.header')
	<div class="login-banner min-vh-100">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-12 col-md-6 col-lg-4 mb-3">
					<div class="d-flex justify-content-md-center justify-content-sm-start">
						<div class="mb-3" style="width: 220px;">
							<a href="{{ route('home') }}" class="">
								<img src="/images/assets/logo.png" class="img-fluid w-100 object-cover">
							</a>
						</div>
					</div>
					<div class="text-sm-left text-md-center mb-4">
						<div class="text-main-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ation ullamco laboris nisi ut aliquip ex ea commodo</div>
					</div>
					<section class="">
						<form action="javascript:;" method="post" class="login-form p-4 card-raduis border mb-4" data-action="{{ route('auth.login') }}">
						    <div class="form-row">
						        <div class="form-group col-12">
						            <label class="text-main-dark">Email or phone</label>
						            <div class="input-group">
							            <input type="text" name="login" class="form-control login" placeholder="Enter email or phone">
						            </div>
						            <small class="error login-error text-danger"></small>
						        </div>
						        <div class="form-group col-12">
						            <label class="text-main-dark">Password</label>
						            <div class="input-group">
						            	<input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
						            </div>
						            <small class="error password-error text-danger"></small>
						        </div>
						    </div>
						    <div class="d-flex align-items-center justify-content-between mb-3">
						    	<div class="custom-control custom-switch">
								  	<input type="checkbox" class="custom-control-input rememberme" id="rememberme" name="rememberme" value="on">
								  	<label class="custom-control-label cursor-pointer" for="rememberme">
								  		<small class="text-main-dark">Remember me</small>
								  	</label>
								</div>
						    	<div class="">
							    	<a href="{{ route('forgot.password') }}">
							    		<small class="">Forgot Password?</small>
							    	</a>
							    </div>
						    </div>
						    <button type="submit" class="btn btn-lg bg-theme-color icon-raduis btn-block text-white login-button mb-4">
						        <img src="/images/spinner.svg" class="mr-2 d-none login-spinner mb-1">
						        Login
						    </button>
						    <div class="alert px-3 login-message d-none mb-3"></div>
						    <p class="text-main-dark mb-0">
								Don't have an account? <a class="text-primary font-weight-bolder" href="{{ route('signup') }}">Signup</a>
							</p>
						</form>
					</section>
				</div>
			</div>
		</div>
	</div>
@include('layouts.footer')