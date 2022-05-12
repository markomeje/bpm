<div class="card-raduis alert alert-info">
    <div class="">
        @set('total_subscriptions', \App\Models\Subscription::count())
        @set('total_adverts', \App\Models\Advert::count())
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="">
                <h4 class="text-main-dark">
                    {{ number_format($total_subscriptions) }}
                </h4>
                <a href="{{ route('admin.subscriptions') }}" class="text-main-dark">Subscriptions</a>
            </div>
            <small class="px-3 bg-warning rounded-pill">
                <small class="tiny-font text-main-dark">0%</small>
            </small>
        </div>
        <?php $subscription_percentages = [
            'active' => ['count' => \App\Models\Subscription::where(['status' => 'active'])->count(), 'color' => 'success'],
            'cancelled' => ['count' => \App\Models\Subscription::where(['status' => 'cancelled'])->count(), 'color' => 'warning'], 
            'expired' => ['count' => \App\Models\Subscription::where(['status' => 'expired'])->count(), 'color' => 'danger'],
            'renewed' => ['count' => \App\Models\Subscription::where(['status' => 'renewed'])->count(), 'color' => 'info']
        ]; ?>
        <div class="row">
            @foreach($subscription_percentages as $name => $percentage)
                <div class="col-12 col-md-6 mb-4">
                    <div class="bg-white p-3 shadow-sm d-flex justify-content-between align-items-center icon-raduis">
                        <div class="">
                            <div class="">
                                {{ $percentage['count'] }}
                            </div>
                            <a href="{{ route('admin.subscriptions', ['status' => $name]) }}" class="text-decoration-none">
                                <small class="text-main-dark">
                                    {{ ucfirst($name) }}
                                </small>
                            </a> 
                        </div>
                        <div class="border lg-circle rounded-circle border-{{ $percentage['color'] }} text-center">
                            <small class="tiny-font position-relative" style="top: 4px;">
                                {{ round(($percentage['count']/($total_subscriptions == 0 ? 1 : $total_subscriptions)) * 100) }}%
                            </small>
                        </div>  
                    </div>
                </div>
            @endforeach
        </div>
    </div> 
</div>