<div class="modal fade" id="add-unit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-raduis border-0">
            <form method="post" action="javascript:;" class="add-unit-form" data-action="{{ route('admin.unit.add') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-main-dark mb-0 font-weight-bold">Edit Unit</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Price</label>
                            <input type="number" class="form-control price rounded-0" name="price" placeholder="e.g., 10">
                            <small class="invalid-feedback price-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Units</label>
                            <input type="number" class="form-control units rounded-0" name="units" placeholder="e.g., 345">
                            <small class="invalid-feedback units-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Duration (in days)</label>
                            <input type="number" class="form-control duration rounded-0" name="duration" placeholder="e.g., 10">
                            <small class="invalid-feedback duration-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Currency</label>
                            <select class="form-control custom-select currency" name="currency">
                                <option value="">-- Select currency --</option>
                                @set('currencies', currency()->getCurrencies())
                                @if(empty($currencies))
                                    <option>No currencies listed</option>
                                @else: ?>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency['id'] }}">
                                            {{ ucwords($currency['name']) }}({{ strtoupper($currency['code']) }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback currency-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 add-unit-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info btn-lg text-white add-unit-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none add-unit-spinner mb-1">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>