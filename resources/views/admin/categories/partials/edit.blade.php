<div class="modal fade" id="edit-category-{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="edit-category-form" data-action="{{ route('admin.category.edit', ['id' => $category->id]) }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-smoky mb-0 font-weight-bold">Edit Category</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Category Name</label>
                            <input type="text" class="form-control name rounded-0" name="name" placeholder="e.g., enugu_electric_prepaid" value="{{ $category->name }}">
                            <small class="invalid-feedback name-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-smoky">Category Type</label>
                            <select class="form-control custom-select rounded-0 type" name="type">
                                <option value="">-- Select Type --</option>
                                @set('types', \App\Models\Category::$types)
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" {{ $type == $category->type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="invalid-feedback type-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 edit-category-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info btn-lg text-white edit-category-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none edit-category-spinner mb-1">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>