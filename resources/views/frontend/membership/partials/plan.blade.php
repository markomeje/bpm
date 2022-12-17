<div class="card border-0 rounded-0">
    <div class="card-header bg-white">
        <div class="py-1 text-main-dark">{{ ucwords($plan->name) }} {{ $package['name'] }}</div>
    </div>
    <div class="card-body position-relative">
        <h6 class="mb-3 text-main-dark">
            NGN{{ number_format($plan->price) }} for {{ $plan->duration }}{{ $plan->duration <= 1 ? 'Day' : 'Days' }}
        </h6>
        <div class="mb-2">
            <a href="{{ auth()->check() ? route('user.dashboard') : route('signup') }}" class="btn bg-theme-color text-white px-4 w-100">Get Started</a>
        </div>
    </div>
</div>