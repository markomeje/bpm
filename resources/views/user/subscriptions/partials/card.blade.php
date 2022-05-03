<div class="shadow-sm bg-theme-color p-4 mb-4 icon-raduis">
    <div class="">
        @if(empty($subscription))
            <div class="alert alert-danger m-0">Subscribe to list more properties. <a href="javascript:;" data-target="#membership-subscription" data-toggle="modal">Click here</a> to get started.</div>
            @include('user.subscriptions.partials.subscribe')
        @else
            @set('timing', \App\Helpers\Timing::calculate($subscription->duration, $subscription->expiry, $subscription->started))
            @set('status', strtolower($subscription->status ?? ''))
            <div class="d-flex position-relative" style="top: -32px;">
                <small class="text-white bg-info px-2 rounded mr-3">
                    {{ ucfirst($subscription->status) }}
                </small>
                <small class="text-white bg-success px-2 rounded mr-3">
                    {{ $timing->progress() }}%
                </small>
            </div>
            <div class="">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="text-white">
                        {{ ucwords($subscription->membership->name ?? 'Nill') }} Plan
                    </div>
                    <div class="text-white">
                        {{ $timing->daysleft() }} Day(s) left
                    </div>
                </div>
                <div class="mb-4">
                    <div class="progress" style="height: 7.5px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="1" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
                    </div>
                </div>
                <div class="">
                    @if($status == 'active' || $timing->progress() <= 50)
                        <div class="d-flex">
                            <a href="javascript:;" class="btn btn-info px-4 mr-3" data-toggle="modal" data-target="#renew-subscription">
                                Renew
                            </a>
                            <a href="javascript:;" class="btn bg-main-dark text-white px-4 user-cancel-subscription" data-url="{{ route('user.subscription.cancel', ['id' => $subscription->id]) }}">
                                <img src="/images/spinner.svg" class="mr-2 d-none cancel-subscription-spinner mb-1">
                                Cancel
                            </a>
                        </div>
                        @include('user.subscriptions.partials.renew')
                    @elseif($status == 'cancelled')
                        <div class="d-flex align-items-center">
                            <a href="javascript:;" class="btn btn-info btn-block px-4 user-activate-subscription" data-url="{{ route('user.subscription.activate', ['id' => $subscription->id]) }}">
                                <img src="/images/spinner.svg" class="mr-2 d-none activate-subscription-spinner mb-1">
                                Activate
                            </a>
                        </div>
                    @else
                        <div class="d-flex align-items-center">
                            <a href="javascript:;" class="btn btn-info btn-block px-4 user-cancel-subscription" data-url="{{ route('user.subscription.cancel', ['id' => $subscription->id]) }}">
                                <img src="/images/spinner.svg" class="mr-2 d-none cancel-subscription-spinner mb-1">
                                Cancel
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>