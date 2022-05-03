<div class="modal fade" id="add-review" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg rounded" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="add-review-form" data-action="{{ route('review.add', ['profileid' => $profile->id]) }}" autocomplete="off">
                <div class="d-flex justify-content-between border-bottom rounded p-3">
                    <div class="text-main-dark mb-0">Add Review</div>
                    <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                        <i class="icofont-close text-danger"></i>
                    </div>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group mb-4">
                        <label class="text-main-dark">Review (Maximum of 50 characters.)</label>
                        <textarea class="form-control review" name="review" placeholder="Enter your review here" rows="6"></textarea>
                        <small class="invalid-feedback review-error"></small>
                    </div>
                    <div class="alert mb-3 add-review-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn bg-info btn-lg px-4 text-white add-review-button">
                            <img src="/images/spinner.svg" class="mr-2 d-none add-review-spinner mb-1">
                            Review
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>