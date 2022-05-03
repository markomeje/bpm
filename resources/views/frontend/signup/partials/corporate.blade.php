<form action="javascript:;" method="post" class="corporate-signup-form mb-4 p-4 border" style="background-color: rgba(0, 0, 0, 0.5);" data-action="{{ route('signup.corporate') }}" autocomplete="off">
    <div class="form-row">
        <div class="form-group col-12">
            <label class="text-white">Company Name</label>
	        <input type="text" name="companyname" class="form-control companyname" placeholder="e.g., Chatdext Limited">
            <small class="error companyname-error text-danger"></small>
        </div>
     </div>
     <div class="form-row">
     	<div class="form-group col-md-6">
            <label class="text-white">Email</label>
	        <input type="email" name="email" class="form-control email" placeholder="e.g., email@you.com">
            <small class="error email-error text-danger"></small>
        </div>
        <div class="form-group col-md-6">
            <label class="text-white">Password</label>
            <input type="number" name="phone" class="form-control phone" placeholder="e.g., 09062972785">
            <small class="error phone-error text-danger"></small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="text-white">Password</label>
            <input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            <small class="error password-error text-danger"></small>
        </div>
        <div class="form-group col-md-6">
            <label class="text-white">Retype Password</label>
            <input type="password" name="retype " class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            <small class="error retype-error text-danger"></small>
        </div>
    </div>
    <div class="mb-3">
        <label class="text-white">Office Address</label>
        <textarea class="form-control address" name="address" rows="4" placeholder="Enter company office address"></textarea>
        <small class="error address-error text-danger"></small>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-3">
    	<div class="custom-control custom-switch">
		  	<input type="checkbox" class="custom-control-input agree" name="agree" value="on" id="weagree">
		  	<label class="custom-control-label cursor-pointer text-white" for="weagree">Agree To Our <a href="javascript:;" class="text-primary">Terms and Conditions.</a></label>
		</div>
    </div>
    <button type="submit" class="btn btn-lg bg-main-green btn-block text-white corporate-signup-button mb-4">
        <img src="/images/spinner.svg" class="mr-2 d-none corporate-signup-spinner mb-1">
        Signup
    </button>
    <div class="alert px-3 corporate-signup-message d-none mb-3"></div>
    <p class="text-white mb-0">
		Already have an account? <a class="text-main-green font-weight-bolder" href="{{ route('login') }}">Login</a>
	</p>
</form>