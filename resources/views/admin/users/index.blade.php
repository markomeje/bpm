@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="m-0 alert alert-info d-flex">
                        <div class="mr-2">
                            ({{ $users->total() }}) users
                        </div>
                    </div>
                </div>  
                <div class="col-12 col-md-6 mb-4">
                    <div class="d-flex align-items-center alert alert-info m-0">
                        <div class="mr-2 cursor-pointer text-center text-decoration-none" data-toggle="modal" data-target="#search-users">
                            <i class="icofont-search"></i>
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
                                                <input type="text" class="form-control form-control-lg query" name="query" placeholder="e.g., Type anything" required>
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
                        <div class="mr-2 cursor-pointer text-center text-decoration-none" data-toggle="modal" data-target="#designation-filter">
                            <i class="icofont-users"></i>
                        </div>
                        {{-- Designation filter Users modal --}}
                        <div class="modal fade" id="designation-filter" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content border-0">
                                    <div class="px-4 pt-5 pb-4">
                                        @set('designations', \App\Models\Profile::$designations)
                                        @if(empty($designations))
                                            <div value="alert alert-danger">No designations</div>
                                        @else
                                            @foreach($designations as $designation)
                                                <a href="{{ route('admin.users', ['query' => $designation]) }}" class="alert alert-info mb-4 d-flex align-items-center text-decoration-none justify-content-between">
                                                    <span>{{ ucwords($designation) }}</span>
                                                    <small class="px-3 tiny-font py-1 bg-danger rounded-pill">
                                                        <small class="text-white">
                                                            {{ \App\Models\Profile::where(['designation' => $designation])->get()->count() }}
                                                        </small>
                                                    </small>
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="mb-4">
                @if(empty($users->count()))
                    <div class="alert-info alert">No users yet</div>
                @else
                    <div class="row">
                        @foreach($users as $user)
                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                @include('admin.users.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $users->onEachSide(1)->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    