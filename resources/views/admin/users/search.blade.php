@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            @include('admin.users.partials.heading')
            <div class="">
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