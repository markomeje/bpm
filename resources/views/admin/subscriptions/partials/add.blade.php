<div class="modal fade" id="add-subscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content card-raduis border-0">
            <form method="post" action="javascript:;" class="add-subscription-form" data-action="{{ route('admin.subscription.add') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-main-dark mb-0 font-weight-bold">Add subscription</div>
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
                            @set('roles', \App\Models\User::$roles)
                            <select class="form-control custom-select role" name="role">
                                <option value="">Select role</option>
                                @if(empty($roles))
                                    <option value="">No roles found</option>
                                @else
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}">
                                            {{ ucwords($role) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback role-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 add-subscription-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info btn-lg text-white add-subscription-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none add-subscription-spinner mb-1">
                            Continue
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>