<div class="modal fade" id="search-payments" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="get" action="{{ route('admin.payments.search') }}" class="search-payments-form" autocomplete="off">
                <div class="modal-body p-4" autocomplete="off">
                    <div class="d-flex justify-content-between align-items-center pb-2 mb-3">
                        <div class="text-main-dark">Search Pyaments</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" class="form-control form-control-lg query" name="query" placeholder="e.g., Type anything" required value="{{ request()->get('query') }}">
                    </div>
                    <div class="alert mb-3 search-payments-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn bg-info btn-lg btn-block text-white search-payments-button">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>