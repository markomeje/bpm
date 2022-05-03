<div class="modal fade" id="add-social" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" class="add-social-form" action="javascript:;" data-action="{{ route('user.social.add') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Add Socials</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label class="text-muted">Social Media Company</label>
                            <select class="custom-select form-control company" name="company">
                                <option value="">Select Company</option>
                                @set('companies', \App\Models\Social::$companies)
                                @if(empty($companies))
                                    <option value="">No Companies Listed</option>
                                @else
                                    @foreach($companies as $company)
                                        <option value="{{ $company }}">
                                            {{ ucfirst($company) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="error company-error text-danger"></small>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="text-muted">Social Link</label>
                            <div class="input-group">
                                <input type="text" name="link" class="form-control link" placeholder="e.g., www.facebook.com/myname">
                            </div>
                            <small class="error link-error text-danger"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label class="text-muted">Username</label>
                            <div class="input-group">
                                <input type="text" name="username" class="form-control username" placeholder="e.g., @myname">
                            </div>
                            <small class="error username-error text-danger"></small>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="text-muted">Phone</label>
                            <div class="input-group">
                                <input type="text" name="phone" class="form-control phone" placeholder="Enter phone">
                            </div>
                            <small class="error phone-error text-danger"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 add-social-message d-none"></div>
                    <button type="submit" class="btn btn-lg px-4 mt-2 icon-raduis btn-info text-white add-social-button mb-4">
                        <img src="/images/spinner.svg" class="mr-2 d-none add-social-spinner mb-1">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>