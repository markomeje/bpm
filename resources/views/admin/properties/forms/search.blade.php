<div class="modal fade" id="search-properties" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="get" action="{{ route('admin.properties.search') }}" class="search-properties-form" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-main-dark mb-0">Search properties</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-group input-group-lg mb-4">
                        <input type="search" class="form-control query rounded-0" name="query" placeholder="e.g., Enter anything" required value="{{ request()->get('query') }}">
                        <small class="invalid-feedback query-error"></small>
                    </div>
                    <div class="alert mb-3 search-properties-message d-none"></div>
                    <button type="submit" class="btn btn-info btn-lg btn-block text-white search-properties-button">
                        <img src="/images/spinner.svg" class="mr-2 d-none search-properties-spinner mb-1">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>