<div class="modal fade" id="add-certification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" class="add-certification-form" action="javascript:;" data-action="{{ route('user.certification.add') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Add Certification</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-muted">Year</label>
                            <div class="input-group">
                                <input type="text" name="year" class="form-control year" placeholder="Enter academic year">
                            </div>
                            <small class="error year-error text-danger"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-muted">Qualification</label>
                            <select class="form-control custom-select qualification" name="qualification">
                                <option value="">-- Select qualification --</option>
                                @if(empty($qualifications))
                                    <option value="">No qualifications listed</option>
                                @else
                                    @foreach ($qualifications as $qualification => $name)
                                        <option value="{{ $qualification }}">
                                            {{ ucfirst($name) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback qualification-error"></small>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="text-muted">Institution</label>
                        <textarea name="institution" class="form-control institution" placeholder="Enter Institution name"></textarea>
                        <small class="invalid-feedback institution-error"></small>
                    </div>
                    <div class="alert mb-3 add-certification-message d-none"></div>
                    <button type="submit" class="btn btn-lg px-4 icon-raduis bg-theme-color text-white add-certification-button mb-4">
                        <img src="/images/spinner.svg" class="mr-2 d-none add-certification-spinner mb-1">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>