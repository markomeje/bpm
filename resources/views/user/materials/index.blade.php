@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content pb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="mb-3">
                    <h4 class="text-main-dark">Building Materials ({{ number_format(auth()->user()->materials->count()) }})</h4>
                    <div class="text-muted">View list of all your building materials. List your building materials.</div>
                </div>
                <div class="">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('user.material.add') }}" class="btn bg-theme-color mb-4 text-white">
                            <small class="mr-1">
                                <i class="icofont-plus"></i>
                            </small>
                            <div class="d-inline">List Material</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="">
                @if(empty($materials->count()))
                    <div class="alert-info alert">No materials yet</div>
                @else
                    <div class="row">
                        @foreach($materials as $material)
                            <div class="col-12 col-md-4 col-lg-3 mb-4">
                                @include('user.materials.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $materials->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    