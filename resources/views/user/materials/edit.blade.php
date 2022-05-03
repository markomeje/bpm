@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content pb-4">
        <div class="container">
            @if(empty($material))
                <div class="alert alert-danger">Material not found. May have been deleted.</div>
            @else
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="alert alert-info mb-4">Manage material images</div>
                        <div class="">
                            @if($material->images()->exists())
                                <div class="position-relative card mb-4">
                                    @set('mainimage', $material->images()->where(['role' => 'main'])->get()[0] ?? '')
                                    @if(!empty($mainimage))
                                        <div class="card-header border-0 bg-theme-color d-flex justify-content-between">
                                            <small class="text-white">Main view</small>
                                            <div class="d-flex align-items-center">
                                                <small class="upload-image cursor-pointer text-white" data-id="{{ $material->id }}" data-message="Are you to change property main image?">
                                                    <i class="icofont-camera"></i>
                                                </small>
                                            </div>   
                                        </div>
                                        <form action="javascript:;">
                                            <input type="file" name="image" accept="image/*" class="image-input" data-url="{{ route('user.image.upload', ['model_id' => $mainimage->model_id, 'type' => $mainimage->type, 'folder' => 'materials', 'role' => $mainimage->role, 'public_id' => $mainimage->public_id]) }}" style="display: none;">
                                        </form>
                                        <div class="image-loader upload-image-loader  position-absolute d-none rounded-circle text-center border" data-id="{{ $material->id}}">
                                            <img src="/images/spinner.svg">
                                        </div>
                                        <div class="bg-dark" style="height: 260px;">
                                            <a href="{{ $mainimage->link }}" class="text-main-dark">
                                                <img src="{{ $mainimage->link }}" class="img-fluid image-preview h-100 w-100 object-cover">
                                            </a>
                                        </div>
                                        <div class="card-footer d-flex bg-white justify-content-between">
                                            <div class="">
                                                <small class="text-main-dark">
                                                    {{ $mainimage->updated_at->diffForHumans() }}
                                                </small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="delete-image cursor-pointer text-theme-color" data-id="{{ $material->id }}" data-message="Are you sure to delete property main image?" data-url="{{ route('user.image.delete', ['model_id' => $mainimage->model_id, 'role' => $mainimage->role, 'type' => $mainimage->type, 'public_id' => $mainimage->public_id]) }}">
                                                    <i class="icofont-trash"></i>
                                                </small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="position-relative card mb-4">
                                            <div class="card-header border-0 bg-theme-color d-flex justify-content-between">
                                                <small class="text-white">Main view</small>
                                                <div class="d-flex align-items-center">
                                                    <small class="upload-image cursor-pointer text-white" data-id="{{ $material->id }}" data-message="Are you to upload main property image?">
                                                        <i class="icofont-camera"></i>
                                                    </small>
                                                </div>   
                                            </div> 
                                            <form action="javascript:;">
                                                <input type="file" name="image" accept="image/*" class="image-input" data-url="{{ route('user.image.upload', ['model_id' => $material->id, 'type' => 'material', 'folder' => 'materials', 'role' => 'main']) }}" style="display: none;">
                                            </form>
                                            <div class="image-loader upload-image-loader  position-absolute d-none rounded-circle text-center border" data-id="{{ $material->id}}">
                                                <img src="/images/spinner.svg">
                                            </div>
                                            <div class="bg-dark" style="height: 260px;">
                                                <img src="/images/banners/placeholder.png" class="img-fluid image-preview h-100 w-100 object-cover">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="">
                                    @set('others', $material->images()->where(['role' => 'others'])->take(3)->get())
                                    @set('max', 3 - ($others->count() > 3 ? 3 : $others->count()))
                                    <div class="border bg-white mb-4">
                                        @if($others->count() >= 3)
                                            <div class="alert alert-danger mb-0">
                                                <i class="icofont-info-circle"></i>
                                                <span>You have uploaded maximum image(s). Delete an image to upload another</span>
                                            </div>
                                        @else
                                            <div class="alert alert-danger mb-0">
                                                <i class="icofont-info-circle"></i>
                                                <span>You can only upload maximum of ({{ $max }}) other image(s)</span>
                                            </div>
                                            <input type="file" class="filepond" name="images[]" accept="image/png, image/jpeg, image/gif" multiple max="{{ $max }}" data-url="{{ route('user.multiple.images.upload', ['model_id' => $material->id, 'type' => 'material', 'folder' => 'materials', 'role' => 'others']) }}">
                                        @endif
                                    </div>
                                    @if(!empty($others->count()))
                                        <div class="row">
                                            @foreach($others as $image)
                                                @set('deleteuri', route('user.image.delete', ['model_id' => $image->model_id, 'role' => $image->role, 'type' => $image->type, 'public_id' => $image->public_id]))
                                                <div class="col-6 col-md-3 col-lg-6 mb-4">
                                                    <div class="card border-0">
                                                        <a href="{{ $image->link }}" class="border d-block" style="height: 140px;">
                                                            <img src="{{ $image->link }}" class="img-fluid w-100 h-100 object-cover">
                                                        </a>
                                                        <div class="card-footer d-flex bg-theme-color justify-content-between align-items-center">
                                                            <div class="">
                                                                <small class="text-white">
                                                                    {{ $image->created_at->diffForHumans() }}
                                                                </small>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <small class="delete-image cursor-pointer text-white tiny-font" data-id="{{ $material->id }}" data-message="Are you sure to delete this image?" data-url="{{ $deleteuri }}">
                                                                    <i class="icofont-trash"></i>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div> 
                            @else
                                <div class="position-relative card mb-4">
                                    <div class="card-header border-0 bg-theme-color d-flex justify-content-between">
                                        <small class="text-white">Main view</small>
                                        <div class="d-flex align-items-center">
                                            <small class="upload-image cursor-pointer text-white" data-id="{{ $material->id }}" data-message="Are you to upload main property image?">
                                                <i class="icofont-camera"></i>
                                            </small>
                                        </div>   
                                    </div> 
                                    <form action="javascript:;">
                                        <input type="file" name="image" accept="image/*" class="image-input" data-url="{{ route('user.image.upload', ['model_id' => $material->id, 'type' => 'material', 'folder' => 'materials', 'role' => 'main']) }}" style="display: none;">
                                    </form>
                                    <div class="image-loader upload-image-loader  position-absolute d-none rounded-circle text-center border" data-id="{{ $material->id}}">
                                        <img src="/images/spinner.svg">
                                    </div>
                                    <div class="bg-dark" style="height: 260px;">
                                        <img src="/images/banners/placeholder.png" class="img-fluid image-preview h-100 w-100 object-cover">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-7 mb-4">
                        <div class="alert alert-info mb-4">Edit material details</div>
                        <div class="p-4 bg-white">
                            <form method="post" action="javascript:;" class="edit-material-form" data-action="{{ route('user.material.edit', ['id' => $material->id]) }}" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="text-muted">Building material name or title</label>
                                        <textarea class="form-control name" name="name" placeholder="e.g., Dangote cement" rows="2">{{ $material->name }}</textarea>
                                        <small class="invalid-feedback name-error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Country located</label>
                                        <select class="form-control custom-select country" name="country" id="countries">
                                            <option value="">-- Select country --</option>
                                            @if(empty($countries))
                                                <option value="">No countries listed</option>
                                            @else: ?>
                                                <?php $geoip = geoip()->getLocation(request()->ip());  ?>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" {{ $material->country_id == $country->id ? 'selected' : '' }}>
                                                        {{ ucwords($country->name ?? '') }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="invalid-feedback country-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">State, county or division</label>
                                        <input type="text" class="form-control state" name="state" placeholder="e.g., Texas" value="{{ $material->state }}">
                                        <small class="invalid-feedback state-error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">City, area or town</label>
                                        <input type="text" class="form-control city" name="city" placeholder="e.g., Plano" value="{{ $material->city }}">
                                        <small class="invalid-feedback city-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Available quantity or amount</label>
                                        <input type="text" class="form-control quantity" name="quantity" placeholder="e.g., 10bags" value="{{ $material->quantity }}"> 
                                        <small class="invalid-feedback quantity-error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="text-muted">Address</label>
                                        <textarea class="form-control address" name="address" placeholder="e.g., No 405 Trenth Avenue" rows="2">{{ $material->address }}</textarea>
                                        <small class="invalid-feedback address-error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Currency</label>
                                        <select class="form-control custom-select currency" name="currency">
                                            <option value="">-- Select currency --</option>
                                            <?php $currencies = currency()->getCurrencies(); ?>
                                            @if(empty($currencies))
                                                <option>No currencies listed</option>
                                            @else: ?>
                                                @foreach ($currencies as $currency)
                                                    <?php $code = $currency['code']; ?>
                                                    <option value="{{ $currency['id'] }}" {{ $material->currency_id == $currency['id'] ? 'selected' : '' }}>
                                                        {{ ucwords($currency['name']) }}({{ strtoupper($code) }})
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="invalid-feedback currency-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Price</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control price" name="price" placeholder="e.g., 20000000" value="{{ $material->price }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            <small class="invalid-feedback price-error"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="text-muted">Additional details</label>
                                    <textarea class="form-control additional" name="additional" placeholder="Enter any further details here" rows="4">{{ $material->additional }}</textarea>
                                    <small class="invalid-feedback additional-error"></small>
                                </div>
                                <div class="alert mb-3 edit-material-message d-none"></div>
                                <div class="d-flex justify-content-right mb-3 mt-1">
                                    <button type="submit" class="btn bg-theme-color px-4 btn-lg text-white edit-material-button">
                                        <img src="/images/spinner.svg" class="mr-2 d-none edit-material-spinner mb-1">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>                   
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footer')    