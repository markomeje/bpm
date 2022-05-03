@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content user-properties-banner pb-4">
        <div class="container">
            @if(empty($property))
                <div class="alert alert-danger">Property not found. May have been deleted.</div>
            @else
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="alert alert-info mb-4 d-flex align-items-center">Manage property images </div>
                        <div class="">
                            @if($property->images()->exists())
                                <div class="position-relative card mb-4">
                                    @set('mainimage', $property->images()->where(['role' => 'main'])->get()[0] ?? '')
                                    @if(!empty($mainimage))
                                        <div class="card-header border-0 bg-theme-color d-flex justify-content-between">
                                            <small class="text-white">Main view</small>
                                            <div class="d-flex align-items-center">
                                                <small class="upload-image cursor-pointer text-white" data-id="{{ $property->id }}" data-message="Are you to change property main image?">
                                                    <i class="icofont-camera"></i>
                                                </small>
                                            </div>   
                                        </div>
                                        <form action="javascript:;">
                                            <input type="file" name="image" accept="image/*" class="image-input" data-url="{{ route('user.image.upload', ['model_id' => $mainimage->model_id, 'type' => $mainimage->type, 'folder' => 'properties', 'role' => $mainimage->role, 'public_id' => $mainimage->public_id]) }}" style="display: none;">
                                        </form>
                                        <div class="image-loader upload-image-loader  position-absolute d-none rounded-circle text-center border" data-id="{{ $property->id}}">
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
                                                <small class="delete-image cursor-pointer text-theme-color" data-id="{{ $property->id }}" data-message="Are you sure to delete property main image?" data-url="{{ route('user.image.delete', ['model_id' => $mainimage->model_id, 'role' => $mainimage->role, 'type' => $mainimage->type, 'public_id' => $mainimage->public_id]) }}">
                                                    <i class="icofont-trash"></i>
                                                </small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="position-relative card mb-4">
                                            <div class="card-header border-0 bg-theme-color d-flex justify-content-between">
                                                <small class="text-white">Main view</small>
                                                <div class="d-flex align-items-center">
                                                    <small class="upload-image cursor-pointer text-white" data-id="{{ $property->id }}" data-message="Are you to upload main property image?">
                                                        <i class="icofont-camera"></i>
                                                    </small>
                                                </div>   
                                            </div> 
                                            <form action="javascript:;">
                                                <input type="file" name="image" accept="image/*" class="image-input" data-url="{{ route('user.image.upload', ['model_id' => $property->id, 'type' => 'property', 'folder' => 'properties', 'role' => 'main']) }}" style="display: none;">
                                            </form>
                                            <div class="image-loader upload-image-loader  position-absolute d-none rounded-circle text-center border" data-id="{{ $property->id}}">
                                                <img src="/images/spinner.svg">
                                            </div>
                                            <div class="bg-dark" style="height: 260px;">
                                                <img src="/images/banners/placeholder.png" class="img-fluid image-preview h-100 w-100 object-cover">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="">
                                    @set('others', $property->images()->where(['role' => 'others'])->take(4)->get())
                                    @set('max', 4 - ($others->count() > 3 ? 3 : $others->count()))
                                    <div class="border bg-white mb-4">
                                        @if($others->count() >= 4)
                                            <div class="alert alert-danger mb-0">
                                                <i class="icofont-info-circle"></i>
                                                <span>You have uploaded maximum image(s). Delete an image to upload another</span>
                                            </div>
                                        @else
                                            <div class="alert alert-danger mb-0">
                                                <i class="icofont-info-circle"></i>
                                                <span>You can only upload maximum of ({{ $max }}) other image(s)</span>
                                            </div>
                                            <input type="file" class="filepond" name="images[]" accept="image/png, image/jpeg, image/gif" multiple max="{{ $max }}" data-url="{{ route('user.multiple.images.upload', ['model_id' => $property->id, 'type' => 'property', 'folder' => 'properties', 'role' => 'others']) }}">
                                        @endif
                                    </div>
                                    @if(!empty($others->count()))
                                        <div class="row">
                                            @foreach($others as $image)
                                                @set('deleteuri', route('user.image.delete', ['model_id' => $image->model_id, 'role' => $image->role, 'type' => $image->type, 'public_id' => $image->public_id]))
                                                <div class="col-12 col-md-3 col-lg-6 mb-4">
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
                                                                <small class="delete-image cursor-pointer text-white tiny-font" data-id="{{ $property->id }}" data-message="Are you sure to delete this image?" data-url="{{ $deleteuri }}">
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
                                            <small class="upload-image cursor-pointer text-white" data-id="{{ $property->id }}" data-message="Are you to upload main property image?">
                                                <i class="icofont-camera"></i>
                                            </small>
                                        </div>   
                                    </div> 
                                    <form action="javascript:;">
                                        <input type="file" name="image" accept="image/*" class="image-input" data-url="{{ route('user.image.upload', ['model_id' => $property->id, 'type' => 'property', 'folder' => 'properties', 'role' => 'main']) }}" style="display: none;">
                                    </form>
                                    <div class="image-loader upload-image-loader  position-absolute d-none rounded-circle text-center border" data-id="{{ $property->id}}">
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
                        <div class="mb-4">
                            <div class="alert alert-info mb-4">Add property specifics</div>
                            <div class="p-4 border">
                                <form method="post" action="javascript:;" class="update-property-specifics-form p-4 bg-white" data-action="{{ route('user.property.specifics.update', ['id' => $property->id]) }}" autocomplete="off">
                                    @if($property->category === 'residential')
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-muted">Bedrooms</label>
                                                <input type="number" class="form-control bedrooms" name="bedrooms" placeholder="e.g., 4" value="{{ $property->bedrooms }}">
                                                <small class="invalid-feedback bedrooms-error"></small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="text-muted">Toilets</label>
                                                <input type="number" class="form-control toilets" name="toilets" placeholder="e.g., 6" value="{{ $property->toilets }}">
                                                <small class="invalid-feedback toilets-error"></small>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-muted">Group</label>
                                            <select class="form-control custom-select group" name="group">
                                                <option value="">-- Select group --</option>
                                                <?php $groups = \App\Models\Property::$categories[$property->category]['groups'] ?? []; ?>
                                                @if(empty($groups))
                                                    <option>No groups listed</option>
                                                @else: ?>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group }}" {{ $property->group == $group ? 'selected' : '' }}>
                                                            {{ ucwords($group) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="invalid-feedback group-error"></small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-muted">Activate Now?</label>
                                            <select class="form-control custom-select listed" name="listed">
                                                <option value="">-- Select yes or no --</option>
                                                <?php $listed = \App\Models\Property::$listed; ?>
                                                @foreach($listed as $answer)
                                                    <option value="{{ $answer }}" {{ $property->listed == $answer ? 'selected' : '' }}>
                                                        {{ ucfirst($answer) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="invalid-feedback listed-error"></small>
                                        </div>
                                    </div>
                                    <div class="alert mb-3 update-property-specifics-message d-none"></div>
                                    <div class="d-flex justify-content-right mb-3 mt-1">
                                        <button type="submit" class="btn bg-theme-color icon-raduis px-4 btn-lg text-white update-property-specifics-button">
                                            <img src="/images/spinner.svg" class="mr-2 d-none update-property-specifics-spinner mb-1">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="alert alert-info mb-4">Edit property details</div>
                        <div class="p-4 bg-white">
                            <form method="post" action="javascript:;" class="edit-property-form" data-action="{{ route('user.property.update', ['id' => $property->id]) }}" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Country located</label>
                                        <select class="form-control custom-select country" name="country" id="countries">
                                            <option value="">-- Select country --</option>
                                            @set('countries', \App\Models\Country::all())
                                            @if(empty($countries))
                                                <option value="">No countries listed</option>
                                            @else: ?>
                                                <?php $geoip = geoip()->getLocation(request()->ip());  ?>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" {{ $property->country_id == $country->id ? 'selected' : '' }}>
                                                        {{ ucwords($country->name ?? '') }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="invalid-feedback country-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">State, county or division</label>
                                        <input type="text" class="form-control state" name="state" placeholder="e.g., Texas" value="{{ $property->state }}">
                                        <small class="invalid-feedback state-error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">City, area or town</label>
                                        <input type="text" class="form-control city" name="city" placeholder="e.g., Plano" value="{{ $property->city }}">
                                        <small class="invalid-feedback city-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Category</label>
                                        <select class="form-control custom-select category" name="category">
                                            <option value="">-- Select category --</option>
                                            <?php $categories = \App\Models\Property::$categories; ?>
                                            @if(empty($categories))
                                                <option>No Categories Listed</option>
                                            @else: ?>
                                                @foreach ($categories as $category => $values)
                                                    <option value="{{ $category }}" {{ $property->category == $category ? 'selected' : '' }}>
                                                        {{ ucwords($values['name'] ?? 'Nill') }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="invalid-feedback category-error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="text-muted">Address</label>
                                        <textarea class="form-control address" name="address" placeholder="e.g., No 405 Trenth Avenue" rows="2">{{ $property->address }}</textarea>
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
                                                    <option value="{{ $currency['id'] }}" {{ $property->currency_id == $currency['id'] ? 'selected' : '' }}>
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
                                            <input type="number" class="form-control price" name="price" placeholder="e.g., 20000000" value="{{ $property->price }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            <small class="invalid-feedback price-error"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Property action</label>
                                        <select class="form-control custom-select action" name="action">
                                            <option value="">-- Select action --</option>
                                            <?php $actions = \App\Models\Property::$actions; ?>
                                            @if(empty($actions))
                                                <option>No Actions Listed</option>
                                            @else: ?>
                                                @foreach ($actions as $key => $value)
                                                    <option value="{{ $key }}" {{ $property->action == $key ? 'selected' : '' }}>
                                                        {{ ucwords($value ?? 'any') }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="invalid-feedback action-error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-muted">Property measurement</label>
                                        <input type="text" class="form-control measurement" name="measurement" placeholder="e.g., 500Sqft" value="{{ $property->measurement }}">
                                        <small class="invalid-feedback measurement-error"></small>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="text-muted">Additional details</label>
                                    <textarea class="form-control additional" name="additional" placeholder="Enter any further details here" rows="10">{{ $property->additional }}</textarea>
                                    <small class="invalid-feedback additional-error"></small>
                                </div>
                                <div class="alert mb-3 edit-property-message d-none"></div>
                                <div class="d-flex justify-content-right mb-3 mt-1">
                                    <button type="submit" class="btn bg-theme-color icon-raduis px-4 btn-lg text-white edit-property-button">
                                        <img src="/images/spinner.svg" class="mr-2 d-none edit-property-spinner mb-1">
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