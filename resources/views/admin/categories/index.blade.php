@include('layouts.header')
<div class="bg-alabaster min-vh-100">
    @include('admin.layouts.navbar')
    <div class="section-padding">
        <div class="container">
            <div class="row flex-wrap">
                <div class="col-6 col-md-3 mb-4">
                    <a class="btn btn-block border-main-dark bg-transparent rounded-0" href="javascript:;" data-toggle="modal" data-target="#add-category">
                        <small class="text-main-dark">Add Category</small>
                    </a>
                    @include('admin.categories.partials.add')
                </div>
            </div>
            <div class="">
                @if(empty($allCategories->count()))
                    <div class="alert-info alert">No properties yet</div>
                @else
                    <div class="row">
                        @foreach($allCategories as $category)
                            <div class="col-12 col-md-4 col-lg-3 mb-4">
                                @include('admin.categories.partials.card')
                            </div>
                            @include('admin.categories.partials.edit')
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    