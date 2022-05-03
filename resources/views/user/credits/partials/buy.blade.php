<div class="modal fade" id="buy-credit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="buy-credit-form" data-action="{{ route('user.credits.buy') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Buy Credit</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label class="text-smoky">Available units</label>
                            <select class="form-control custom-select rounded-0 unit" name="unit">
                                <option value="">-- Select unit --</option>
                                @if(empty($units->count()))
                                    <option value="">-- No units listed --</option>
                                @else
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">
                                            {{ $unit->units.'units for $'.$unit->price.'('.$unit->duration.'days)' }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback unit-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 buy-credit-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-block bg-theme-color btn-lg text-white buy-credit-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none buy-credit-spinner mb-1">
                            Pay
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>