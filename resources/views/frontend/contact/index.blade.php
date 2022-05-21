@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="position-relative">
    	<section class="contact-banner">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-lg-7 mb-4">
						<h3 class="text-theme-color mb-3">Contact <span class="text-white">Us</span></h3>
						<div class="text-white mb-4">World best property page is not just a web design convenience but a source of connection between our prospective clients, users and our company. Our page is friendly and inviting. Contact us on what you need us to do for you and best believe, your satisfaction is a guarantee.</div>
						@if(empty(request()->get('success')))
							<form class="contact-form p-4 mb-4 rounded border" action="javascript:;" method="post" autocomplete="off" data-action="{{ route('contact.send') }}">
								<div class="form-row">
							        <div class="form-group col-md-6">
							            <label class="text-white">Fullname</label>
								        <input type="text" name="fullname" class="form-control fullname" placeholder="Enter email or phone">
							            <small class="error fullname-error text-danger"></small>
							        </div>
							        <div class="form-group col-md-6">
							            <label class="text-white">Designation</label>
							            <select class="custom-select form-control designation" name="designation">
							            	<option value="">Select Designation</option>
							            	<option value="Company">Company</option>
							            	<option value="Individual">Individual</option>
							            </select>
							            <small class="error designation-error text-danger"></small>
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
							    <div class="mb-4">
							    	<label class="text-white">Message</label>
							    	<textarea class="form-control message" name="message" rows="4" placeholder="Enter message here"></textarea>
							    	<small class="error message-error text-danger"></small>
							    </div>
							    <button type="submit" class="btn btn-lg bg-theme-color px-4 text-white contact-button mb-4">
							        <img src="/images/spinner.svg" class="mr-2 d-none contact-spinner mb-1">
							        Send
							    </button>
							    <div class="alert px-3 contact-message d-none mb-3"></div>
							</form>
						@else
							<div class="alert alert-success mb-4">Thank you for contacting us. We would get back to you shortly.</div>
						@endif
					</div>
					<div class="col-12 col-lg-5">
						<h3 class="text-white">Office Addresses</h3>
						<div class="mb-4">
							<p class="text-theme-color">Head Office</p>
							<div class="text-white">Suit E01b, The statement Complex, Plot 1002, First Avenue, CBD, FCT Abuja.</div>
						</div>
						<div class="mb-4">
							<p class="text-theme-color">Branch Office</p>
							<div class="text-white">Geohomes House, 26 Moorehouse Ogui Enugu Enugu state, Nigeria.</div>
						</div>
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')