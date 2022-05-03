<div class="modal fade" id="add-plan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="add-plan-form" data-action="{{ route('admin.plan.add') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between bg-main-ash p-3 mb-4">
                        <div class="text-dark mb-0 font-weight-bold">Add plan</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-dark">Plan name</label>
                            <input type="text" class="form-control name" name="name" placeholder="e.g., individual plan">
                            <small class="invalid-feedback name-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-dark">Plan duration</label>
                            <select class="form-control custom-select duration" name="duration">
                                <option value="">-- Select duration --</option>
                                @foreach (array_keys(\App\Models\Plan::$durations) as $duration)
                                    <option value="{{ $duration }}">
                                        {{ ucfirst($duration) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="invalid-feedback duration-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-dark">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control price" name="price" placeholder="e.g., 59">
                                <small class="invalid-feedback price-error"></small>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-dark">Max listing</label>
                            <input type="number" class="form-control listing" name="listing" placeholder="e.g., 10">
                            <small class="invalid-feedback listing-error"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-dark">Additional details</label>
                        <textarea class="form-control details" name="details" placeholder="Enter additional details here" rows="4"></textarea>
                        <small class="invalid-feedback details-error"></small>
                    </div>
                    <div class="alert mb-3 add-plan-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn bg-info btn-lg px-4 text-white add-plan-button">
                            <img src="/images/spinner.svg" class="mr-2 d-none add-plan-spinner mb-1">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>