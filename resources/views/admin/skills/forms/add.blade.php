<div class="modal fade" id="add-skill" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="add-skill-form" data-action="{{ route('admin.skill.add') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Add skill</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-smoky">Name</label>
                        <input type="text" class="form-control name rounded-0" name="name" placeholder="e.g., painter">
                        <small class="invalid-feedback name-error"></small>
                    </div>
                    <div class="alert mb-3 add-skill-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn bg-main-dark btn-lg btn-block text-white add-skill-button px-4 font-weight-bold">
                            <img src="/images/spinner.svg" class="mr-2 d-none add-skill-spinner mb-1">
                            Add skill
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>