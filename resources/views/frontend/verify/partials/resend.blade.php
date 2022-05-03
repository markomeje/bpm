<div class="modal fade" id="resend-code" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="resend-code-form" data-action="{{ route('signup.code.resend') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Resend Code</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Email</label>
                            <input type="email" class="form-control email rounded-0" name="email" placeholder="e.g., 500Mb">
                            <small class="invalid-feedback email-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Phone</label>
                            <input type="text" class="form-control phone rounded-0" name="phone" placeholder="e.g., 500">
                            <small class="invalid-feedback phone-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 resend-code-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn rounded-0 bg-violet text-white resend-code-button px-4 font-weight-bold">
                            <img src="/images/spinner.svg" class="mr-2 d-none resend-code-spinner mb-1">
                            Resend
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>