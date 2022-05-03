@if(empty($params))
    <div class="alert alert-danger mb-0">Unknown error. Try again later</div>
@else
    <form method="post" action="javascript:;" class="promotion-form w-100" data-action="{{ route('user.promotions.promote', $params) }}" autocomplete="off">
        <?php $credits = auth()->user()->credits()->where(['status' => 'available'])->get(); ?>
        @if(empty($credits->count()))
            <div class="alert alert-danger mb-0">You have no available credits. <a href="{{ route('user.credits') }}">Click here</a> to buy.</div>
        @else
            <div class="form-row">
                <div class="form-group col-12">
                    <label class="text-smoky">Credits</label>
                    <select class="form-control custom-select rounded-0 credit" name="credit">
                        <option value="">-- Select credit --</option>
                        @foreach ($credits as $credit)
                            <option value="{{ $credit->id }}">
                                {{ number_format($credit->units).'unit(s) for '.$credit->duration.'day(s)' }}
                            </option>
                        @endforeach
                    </select>
                    <small class="invalid-feedback credit-error"></small>
                </div>
            </div>
            <div class="alert mb-3 promotion-message d-none"></div>
            <div class="d-flex justify-content-right mb-3 mt-1">
                <button type="submit" class="btn bg-theme-color btn-block btn-lg text-white promotion-button px-4">
                    <img src="/images/spinner.svg" class="mr-2 d-none promotion-spinner mb-1">
                    Promote
                </button>
            </div>
        @endif
    </form>
@endif
    