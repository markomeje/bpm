<div class="modal fade" id="edit-skill-{{ $skill->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="edit-skill-form" data-action="{{ route('admin.skill.edit', ['id' => $skill->id]) }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Edit skill</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-smoky">Name</label>
                        <input type="text" class="form-control name rounded-0" name="name" placeholder="e.g., painter" value="{{ $skill->name ?? '' }}">
                        <small class="invalid-feedback name-error"></small>
                    </div>
                    <div class="alert mb-3 edit-skill-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info btn-lg text-white edit-skill-button btn-block">
                            <img src="/images/spinner.svg" class="mr-2 d-none edit-skill-spinner mb-1">
                            Save skill
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>