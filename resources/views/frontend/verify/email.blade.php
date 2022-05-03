@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
    	<section class="" style="padding: 160px 0 80px;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="p-4 card-raduis border">
							<?php $verify = (array)json_decode($verify->content(), true); ?>
							@if(isset($verify['status']))
								@if($verify['status'] === 0)
									<div class="alert alert-danger">
										{{ $verify['info'] }}
									</div>
									<div class="d-flex align-items-center">
										<div class="dropdown cursor-pointer">
										  	<a href="javascript:;" class="text-decoration-underline" id="resend-token-link-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Resend link</a>
										  	<div class="dropdown-menu p-4 border-0 shadow card-raduis" style="width: 280px;" aria-labelledby="resend-token-link-dropdown">
										    	<form method="post" class="resend-token-link-form w-100" action="javascript:;" data-action="{{ route('token.resend', ['token' => $token ?? '']) }}">
										    		<div class="form-group mb-3">
										    			<label class="text-main-dark">Enter Email</label>
										    			<input type="email" name="email" class="form-control email" placeholder="e.g., email@email.com">
										    		</div>
										    		<button type="submit" class="btn btn-lg bg-theme-color icon-raduis btn-block text-white resend-token-link-button mb-4">
												        <img src="/images/spinner.svg" class="mr-2 d-none resend-token-link-spinner mb-1">
												        Resend
												    </button>
												    <div class="alert px-3 resend-token-link-message d-none mb-3"></div>
										    	</form>
										  	</div>
										</div>
										<div class="ml-1">or <a href="{{ route('login') }}" class="text-decoration-underline">Login</a></div>
									</div>
								@elseif($verify['status'] === 1)
									<div class="alert alert-success">
										{{ $verify['info'] }}
									</div>
									<div class="ml-1">
										<a href="{{ route('login') }}" class="text-decoration-underline">Login Here</a>
									</div>
								@else
									<div class="alert alert-danger">Unknown error. Try again later.</div>
								@endif
							@else
								<div class="alert alert-danger">Unknown error. Try again later.</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')