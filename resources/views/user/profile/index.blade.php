@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="">
                        @if(empty(auth()->user()->profile))
                            <h6 class="alert alert-info mb-4">Setup Profile details</h6>
                            <div class="p-4 card-raduis bg-white border mb-4">
                                @include('user.profile.partials.add')
                            </div>
                        @else
                            @set('user', auth()->user())
                            @set('profile', $user->profile)
                            <div class="row">
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="position-relative bg-white shadow-sm mb-4 px-4">
                                        @if(empty($profile->image->link))
                                            <div class="d-flex">
                                                <div class="position-relative rounded-circle mr-3" style="width: 70px; height: 70px; top: -20px;">
                                                    <a href="javascript:;">
                                                        <img src="/images/avatar.jpg" class="img-fluid w-100 h-100 object-cover border border-info rounded-circle image-preview border">
                                                    </a>
                                                    <div class="image-loader d-none position-absolute" data-id="{{ auth()->id() }}" style="top: 30%; right: 35%;">
                                                        <img src="/images/spinner.svg" class="position-relative">
                                                    </div>
                                                </div>
                                                <div class="text-center d-flex align-items-center position-relative   cursor-pointer" style="top: -35px;">
                                                    <div class="upload-image text-white mr-3 rounded-circle sm-circle bg-success border" data-message="Are you sure to upload profile image?">
                                                        <div class="tiny-font position-relative" style="top: 2px;">
                                                            <i class="icofont-camera"></i>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="">
                                                <form action="javascript:;">
                                                    <input type="file" name="image" accept="image/*" class="image-input d-none" data-url="{{ route('user.image.upload', ['model_id' => $profile->id, 'type' => 'profile', 'folder' => 'profiles', 'role' => 'main', 'public_id' => '']) }}">
                                                </form>
                                            </div>
                                        @else
                                            @set('image', $profile->image)
                                            <div class="d-flex">
                                                <div class="position-relative rounded-circle mr-3" style="width: 70px; height: 70px; top: -20px;">
                                                    <a href="{{ $image->link }}">
                                                        <img src="{{ $image->link }}" class="img-fluid w-100 h-100 object-cover border border-info rounded-circle image-preview border">
                                                    </a>
                                                    <div class="image-loader d-none position-absolute" data-id="{{ auth()->id() }}" style="top: 30%; right: 35%;">
                                                        <img src="/images/spinner.svg" class="position-relative">
                                                    </div>
                                                </div>
                                                <div class="text-center d-flex align-items-center position-relative   cursor-pointer" style="top: -35px;">
                                                    <div class="upload-image text-white mr-2 rounded-circle sm-circle bg-success border" data-message="Are you sure to upload profile image?">
                                                        <div class="tiny-font position-relative" style="top: 2px;">
                                                            <i class="icofont-camera"></i>
                                                        </div>
                                                    </div>
                                                    <div class="delete-image text-white mr-2 rounded-circle sm-circle bg-danger border" data-url="{{ route('user.image.delete', ['model_id' => $image->model_id, 'role' => $image->role, 'type' => $image->type, 'public_id' => $image->public_id]) }}" data-message="Are you sure to remove your profile image?">
                                                        <div class="tiny-font position-relative" style="top: 2px;">
                                                            <i class="icofont-trash"></i>
                                                        </div>
                                                    </div>
                                                    <div class="{{ $user->status == 'active' ? 'bg-success' : 'bg-secondary' }} text-center border sm-circle rounded-circle">
                                                        <small class="text-white position-relative tiny-font">
                                                            <i class="icofont-tick-mark"></i>
                                                        </small>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="">
                                                <form action="javascript:;">
                                                    <input type="file" name="image" accept="image/*" class="image-input d-none" data-url="{{ route('user.image.upload', ['model_id' => $image->model_id, 'type' => $image->type, 'folder' => 'profiles', 'role' => $image->role, 'public_id' => $image->public_id]) }}">
                                                </form>
                                            </div>
                                        @endif
                                        <div class="pb-5">
                                            <h5 class="text-main-dark mb-3">
                                                {{ ucwords($user->name) }}
                                            </h5>
                                            @set('promoted', !empty($profile->promotion) && ($profile->promotion->status ?? '') == 'active')
                                            <div class="d-flex align-items-center">
                                                <small class="text-white mr-3 tiny-font px-3 py-1 bg-main-dark">
                                                    {{ ucwords($user->created_at->diffForHumans()) }}
                                                </small>
                                                <div class="dropdown">
                                                    <a href="javascript:;" class="align-items-center d-flex text-decoration-none
                                                    " id="promote-{{ $profile->id }}" data-toggle="dropdown">
                                                        <small class="{{ $promoted ? 'bg-success' : 'bg-main-dark' }} tiny-font px-3 py-1 text-white">
                                                            {{ $promoted ? 'Promoted' : 'Promote' }}
                                                            <i class="icofont icofont-caret-down"></i>
                                                        </small>
                                                    </a>
                                                    <div class="dropdown-menu border-0 shadow-sm dropdown-menu-left" aria-labelledby="promote-{{ $profile->id }}" style="width: 210px !important;">
                                                        @if($promoted)
                                                            @set('timing', \App\Helpers\Timing::calculate($profile->promotion->duration, $profile->promotion->expiry, $profile->promotion->started))
                                                            <div class="px-3 py-1 w-100">
                                                                <div class="d-flex">
                                                                    <div class="mr-2">
                                                                        <small class="text-success">
                                                                            ({{ $timing->progress() }}%)
                                                                        </small>
                                                                    </div>
                                                                    <div class="">
                                                                        <small class="">
                                                                            {{ $timing->daysleft() }} Day(s) Left
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="p-4 bg-white">
                                                                @if(empty($profile->image))
                                                                    <div class="alert alert-danger mb-0">Please upload your profile image before promoting</div>
                                                                @else
                                                                    @set('params', ['model_id' => $profile->id, 'type' => 'profile'])
                                                                    @include('user.promotions.partials.promote')
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>       
                                        </div>   
                                    </div>
                                    @if($profile->role == 'artisan')
                                        @if($user->services()->exists())
                                            <div class="d-flex flex-wrap alert alert-info pt-4 icon-raduis mb-4">
                                                @foreach($user->services as $service)
                                                    <div class="mr-3 mb-3 position-relative">
                                                        <small class="px-3 py-1 text-main-dark rounded-pill border border-info">
                                                            {{ ucfirst($service->skill->name) }}
                                                        </small>
                                                    </div>
                                                @endforeach
                                            </div>   
                                        @endif
                                    @endif
                                    <div class="">
                                        <div class="">
                                            <h6 class="alert m-0 d-flex justify-content-between cursor-pointer alert-info" data-toggle="collapse" data-target="#edit-profile-dion" aria-expanded="false" aria-controls="edit-profile-dion">
                                                <span>Manage Profile details</span>
                                                <span>
                                                    <i class="icofont-caret-down"></i>
                                                </span>
                                            </h6>
                                        </div>
                                        <div class="collapse show" id="edit-profile-dion">
                                            <div class="p-4 mt-4 card-raduis bg-white border">
                                                @include('user.profile.partials.edit')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    @if($profile->designation == 'corporate')
                                        <div class="bg-white p-4 shadow-sm mb-4 card-raduis">
                                            <div class="alert alert-info">Company Details</div>
                                            <form method="post" class="update-company-details-form" action="javascript:;" data-action="{{ route('user.profile.company.update', ['id' => $profile->id]) }}" autocomplete="off">
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label class="text-muted">Company Name</label>
                                                        <div class="input-group">
                                                            <input type="text" name="companyname" class="form-control companyname" placeholder="Enter company name" value="{{ $profile->companyname }}">
                                                        </div>
                                                        <small class="error companyname-error text-danger"></small>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="text-muted">RC Number</label>
                                                        <input type="text" class="form-control rcnumber" name="rcnumber" placeholder="e.g., 1714517" value="{{ $profile->rcnumber }}">
                                                        <small class="invalid-feedback rcnumber-error"></small>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        @set('documents', \App\Models\Profile::$documents)
                                                        <label class="text-muted">Document</label>
                                                        <select class="form-control custom-select document" name="document">
                                                            <option value="">-- Select document --</option>
                                                            @if(empty($documents))
                                                                <option value="">No documents listed</option>
                                                            @else
                                                                @foreach ($documents as $document)
                                                                    <option value="{{ $document }}" {{ $profile->document == $document ? 'selected' : '' }}>
                                                                        {{ ucfirst($document) }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <small class="invalid-feedback document-error"></small>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="text-muted">Document Number Selected</label>
                                                        <input type="text" class="form-control idnumber" name="idnumber" placeholder="e.g., 23098916521" value="{{ $profile->idnumber }}">
                                                        <small class="invalid-feedback idnumber-error"></small>
                                                    </div>
                                                </div>
                                                <div class="alert mb-3 update-company-details-message d-none"></div>
                                                <button type="submit" class="btn btn-lg px-4 icon-raduis bg-theme-color text-white update-company-details-button mb-4">
                                                    <img src="/images/spinner.svg" class="mr-2 d-none update-company-details-spinner mb-1">
                                                    Save
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="">
                                        <div class="alert alert-info d-flex justify-content-between mb-4">
                                            <div class="">Social handles</div>
                                            <a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#add-social">
                                                <i class="icofont-plus"></i>
                                            </a>
                                        </div>
                                        @include('user.socials.partials.add')
                                        @if($user->socials()->exists())
                                            <div class="row d-flex align-items-center">
                                                @foreach($user->socials as $social)
                                                    <div class="col-4 col-md-3 mb-4">
                                                        @include('user.socials.partials.card')
                                                    </div>
                                                    @include('user.socials.partials.edit')
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-danger mb-4">You have not added any social media handles.</div>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <?php $qualifications = \App\Models\Profile::$qualifications; ?>
                                        <h6 class="alert alert-info mb-4 d-flex align-items-center justify-content-between">
                                            <span>Certifications list</span>
                                            <a href="javascript:;" data-toggle="modal" data-target="#add-certification">
                                                <i class="icofont-plus"></i>
                                            </a>
                                        </h6>
                                        @if($user->certifications()->exists())
                                            @set('certifications', $user->certifications)
                                            @if(!empty($certifications->count()))
                                                <div class="row">
                                                    @foreach($certifications as $certificate)
                                                        <div class="col-12 col-lg-6 mb-4">
                                                            @include('user.certifications.partials.card')
                                                        </div>
                                                        @include('user.certifications.partials.edit')
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="alert alert-danger">You have no certifications.</div>
                                            @endif   
                                        @else
                                            <div class="alert alert-danger">You have no certifications.</div>
                                        @endif
                                        @include('user.certifications.partials.add')
                                    </div>
                                </div>
                            </div>   
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    