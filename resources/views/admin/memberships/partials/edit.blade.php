<div class="modal fade" id="edit-membership-{{ $membership->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="edit-membership-form" data-action="{{ route('admin.membership.edit', ['id' => $membership->id]) }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Edit Membership</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Membership Duration</label>
                            <select class="form-control custom-select duration" name="duration">
                                <?php $durations = \App\Models\Membership::$durations; ?>
                                @if(empty($durations))
                                    <option value="">No Durations Listed</option>
                                @else
                                    @foreach ($durations as $key => $value)
                                        <option value="{{ $key }}" {{ $value == $membership->duration ? 'selected' : '' }}>
                                            {{ ucfirst($key) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback duration-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Package</label>
                            <select class="form-control custom-select package" name="package">
                                <?php $packages = \App\Models\Package::all(); ?>
                                @if(empty($packages->count()))
                                    <option>No Packages Listed</option>
                                @else
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}" {{ $package->id == $membership->package_id ? 'selected' : '' }}>
                                            {{ ucfirst($package->name) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback type-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Price ({{ $membership->currency ? $membership->currency->symbol : 'NGN' }})</label>
                            <input class="form-control price" type="number" name="price" value="{{ $membership->price }}">
                            <small class="invalid-feedback price-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Currency</label>
                            <select class="form-control custom-select currency" name="currency">
                                <?php $currenies = \App\Models\Currency::all(); ?>
                                <option value="">Select Currency</option>
                                @if(empty($currenies->count()))
                                    <option>No Currenies Listed</option>
                                @else
                                    @foreach ($currenies as $currency)
                                        <option value="{{ $currency->id }}" {{ $currency->id == $membership->currency_id ? 'selected' : '' }}>
                                            {{ ucfirst($currency->name) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback currency-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Free Listing</label>
                            <input class="form-control freelisting" type="number" name="freelisting" value="{{ $membership->freelisting }}">
                            <small class="invalid-feedback freelisting-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Paid Listing</label>
                            <input class="form-control paidlisting" type="number" name="paidlisting" value="{{ $membership->paidlisting }}">
                            <small class="invalid-feedback paidlisting-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 edit-membership-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info btn-lg text-white edit-membership-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none edit-membership-spinner mb-1">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>