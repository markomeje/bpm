<div class="d-flex align-items-center justify-content-between flex-wrap">
    <div class="mb-4">
        <h4 class="mr-2 mb-0 text-main-dark">
            ({{ $users->total() }}) users
        </h4>
    </div>
    <div class="d-flex align-items-center mb-4">
        <div class="dropdown cursor-pointer">
            <div class="mr-2 text-decoration-none md-circle text-center rounded-circle border border-info" data-toggle="dropdown">
                <small class="text-muted tiny-font">
                    <i class="icofont-filter"></i>
                </small>
            </div>
            <div class="dropdown-menu border-0 shadow dropdown-menu-left">
                <form action="javascript:;" class="users-date-filter p-3" data-url="{{ '' }}">
                    <div class="form-group">
                        <input type="date" name="date" class="form-control">
                    </div>
                </form>
            </div>
        </div>
        <div class="mr-2 cursor-pointer text-center text-decoration-none md-circle rounded-circle border border-info" data-toggle="modal" data-target="#search-users">
            <small class="text-muted tiny-font">
                <i class="icofont-search"></i>
            </small>
        </div>
        {{-- Search Users modal --}}
        <div class="modal fade" id="search-users" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <form method="get" action="{{ route('admin.users.search') }}" class="search-users-form">
                        <div class="modal-body p-4" autocomplete="off">
                            <div class="d-flex justify-content-between align-items-center pb-2 mb-3">
                                <div class="text-main-dark">Search Users</div>
                                <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                                    <i class="icofont-close text-danger"></i>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control form-control-lg query" name="query" placeholder="e.g., Type user name" required>
                            </div>
                            <div class="alert mb-3 search-users-message d-none"></div>
                            <div class="d-flex justify-content-right mb-3 mt-1">
                                <button type="submit" class="btn bg-info btn-lg btn-block text-white search-users-button">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mr-2 cursor-pointer text-center text-decoration-none md-circle rounded-circle border border-info" data-toggle="modal" data-target="#designation-filter">
            <small class="text-muted tiny-font">
                <i class="icofont-users-alt"></i>
            </small>
        </div>
    </div>
</div>