@component('mail::message', ['data' => $data])

<h2>Welcome . . . </h2> 
<p>Please click on the button below to verify your phone Number</p>

<?php $url = route('phone.verify', ['reference' => $data['reference']]); ?>
<div style="text-align: left;">
	@component('mail::button', ['url' => $url])
		Click Here
	@endcomponent
</div>

<h3>Or click on the link below.</h3>
<h1>{{ $url }}</h1>
<p>Regards {{ env('APP_NAME') }}</p>

@endcomponent
