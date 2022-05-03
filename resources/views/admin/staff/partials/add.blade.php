<div class="modal fade" id="add-staff" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content card-raduis border-0">
            <form method="post" action="javascript:;" class="add-staff-form" data-action="{{ route('admin.staff.add') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-main-dark mb-0 font-weight-bold">Add Staff</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Email</label>
                            <input type="email" class="form-control email" name="email" placeholder="e.g., email@email.com">
                            <small class="invalid-feedback email-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Fullname</label>
                            <input type="text" class="form-control fullname" name="fullname" placeholder="e.g., John Rel">
                            <small class="invalid-feedback fullname-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Phone</label>
                            <input type="text" class="form-control phone" name="phone" placeholder="e.g., 08138982100">
                            <small class="invalid-feedback phone-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Role</label>
                            <input type="text" class="form-control role" name="role" placeholder="e.g., admin">
                            <small class="invalid-feedback role-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label class="text-main-dark">Description</label>
                            <textarea class="form-control description" name="description" placeholder="Enter a description of this role" rows="4"></textarea>
                            <small class="invalid-feedback description-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 add-staff-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info btn-lg text-white add-staff-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none add-staff-spinner mb-1">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>