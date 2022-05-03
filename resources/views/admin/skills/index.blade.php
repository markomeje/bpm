@include('layouts.header')
<div class="bg-white min-vh-100">
    @include('admin.layouts.navbar')
    <div class="section-padding pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-2">
                    <div class="alert alert-info d-flex align-items-center">
                        <small class="mr-2">All skills ({{ \App\Models\Skill::count() }})</small>
                        <a href="javascript:;" class="text-underline" data-url="{{ route('admin.skill.add') }}" data-target="#add-skill" data-toggle="modal">
                            <small class="mr-2">
                                Add skill
                            </small>
                        </a>
                        @include('admin.skills.forms.add')
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <div class="alert alert-info d-flex align-items-center">
                        <a class="text-underline" href="javascript:;">
                            <small class="">
                                Search skills
                            </small>
                        </a>
                    </div>
                </div>
            </div>
            <div class="">
                @if(empty($skills->count()))
                    <div class="alert-info alert">No skills listed</div>
                @else
                    <div class="row">
                        @foreach($skills as $skill)
                            <div class="col-12 col-md-4 col-lg-3 mb-4">
                                @include('admin.skills.partials.card')
                            </div>
                            @include('admin.skills.forms.edit')
                        @endforeach
                    </div>
                    {{ $skills->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    