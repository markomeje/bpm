@component('mail::message', ['data' => $data])

<h2>{{ ucwords($data['fullname']) }} with phone number {{ ucwords($data['phone']) }} and email {{ ucwords($data['email']) }} Contacted as a {{ ucwords($data['designation']) }} with the message below.</h2> 
<p>{{ ucwords($data['message']) }}</p>

@endcomponent
