<div class="modal fade" id="edit-advert-{{ $advert->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="edit-advert-form" data-action="{{ route('user.advert.edit', ['id' => $advert->id]) }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Edit Advert</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label class="text-smoky">Used Credit (Cannot be changed)</label>
                            <select class="form-control custom-select rounded-0 credit" readonly name="credit">
                                <option value="">-- Select credit --</option>
                                @if(auth()->user()->credits()->exists())
                                    <?php $credits = auth()->user()->credits; ?>
                                    @foreach ($credits as $credit)
                                        @if($credit->id == $advert->credit_id)
                                            <option value="{{ $credit->id }}" selected>
                                                {{ $credit->units.'units '.$credit->unit->duration.' days' }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="">-- You have no available credits --</option>
                                @endif
                            </select>
                            <small class="invalid-feedback credit-error"></small>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label class="text-smoky">Advert link</label>
                            <input type="url" name="link" class="form-control link" placeholder="Enter advert link" value="{{ $advert['link'] }}">
                            <small class="invalid-feedback link-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label class="text-smoky">Description (Optional)</label>
                            <input type="text" name="description" class="form-control description" placeholder="Enter advert description" value="{{ $advert->description }}">
                            <small class="invalid-feedback description-error"></small>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label class="text-smoky">Advert Size</label>
                            <select class="form-control custom-select rounded-0 size" name="size">
                                <option value="">-- Select size --</option>
                                <?php $sizes = \App\Models\Advert::$sizes; ?>
                                @if(empty($sizes))
                                    <option value="">-- You sizes listed --</option>
                                @else
                                    @foreach ($sizes as $key => $size)
                                        <option value="{{ $size['code'] }}" {{ $advert->size == $size['code'] ? 'selected' : '' }}>
                                            {{ $size['name'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback size-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 edit-advert-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn bg-theme-color btn-lg text-white edit-advert-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none edit-advert-spinner mb-1">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>