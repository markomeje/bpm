<form action="javascript:;" method="post" class="individual-signup-form p-4 border rounded mb-4" style="background-color: rgba(0, 0, 0, 0.5);" data-action="{{ route('signup.individual') }}" autocomplete="off">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="text-white">Firstname</label>
	        <input type="text" name="firstname" class="form-control firstname" placeholder="e.g., John">
            <small class="error firstname-error text-danger"></small>
        </div>
        <div class="form-group col-md-6">
            <label class="text-white">Lastname</label>
	        <input type="text" name="lastname" class="form-control lastname" placeholder="e.g., Doe">
            <small class="error lastname-error text-danger"></small>
        </div>
    </div>
    <div class="form-row">
     	<div class="form-group col-md-6">
            <label class="text-white">Email</label>
	        <input type="email" name="email" class="form-control email" placeholder="e.g., email@you.com">
            <small class="error email-error text-danger"></small>
        </div>
        <div class="form-group col-md-6">
            <label class="text-white">Phone</label>
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
            <input type="password" name="retype" class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            <small class="error retype-error text-danger"></small>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" value="on" name="agree" class="custom-control-input agree" id="i-agree">
            <label class="custom-control-label text-white cursor-pointer" for="i-agree">Agree To Our <a href="javascript:;" class="text-primary">Terms and Conditions?</a></label>
        </div>
        <small class="error agree-error text-danger"></small>
    </div>
    <button type="submit" class="btn btn-lg bg-main-green btn-block text-white individual-signup-button mb-4">
        <img src="/images/spinner.svg" class="mr-2 d-none individual-signup-spinner mb-1">
        Signup
    </button>
    <div class="alert px-3 individual-signup-message d-none mb-3"></div>
    <p class="text-white mb-0">
		Already have an account? <a class="text-main-green font-weight-bolder" href="{{ route('login') }}">Login</a>
	</p>
</form>