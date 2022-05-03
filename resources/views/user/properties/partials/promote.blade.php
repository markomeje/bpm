<div class="modal fade" id="promote-property-{{ $property->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="promote-property-form" data-action="{{ route('user.property.promote', ['id' => $property->id]) }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Promote property</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <?php $credits = auth()->user()->credits()->where(['status' => 'paused'])->get(); ?>
                    @if(empty($credits->count()))
                        <div class="alert alert-danger">You have no credits. <a href="{{ route('user.dashboard') }}">Click here</a> to buy.</div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label class="text-smoky">Credits</label>
                            <select class="form-control custom-select rounded-0 credit" name="credit">
                                <option value="">-- Select credit --</option>
                                @if(empty($credits->count()))
                                    <option>You have no credits</option>
                                @else
                                    @foreach ($credits as $credit)
                                        <option value="{{ $credit->id }}">
                                            {{ number_format($credit->units).'unit(s) for '.$credit->duration.'day(s)' }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback credit-error"></small>
                        </div>
                    </div>
                    <input type="hidden" name="property" value="{{ $property->id }}">
                    <div class="alert mb-3 promote-property-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info icon-raduis btn-block btn-lg text-white promote-property-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none promote-property-spinner mb-1">
                            Promote
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>