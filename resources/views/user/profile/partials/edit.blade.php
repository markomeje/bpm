<form method="post" class="profile-edit-form" action="javascript:;" data-action="{{ route('user.profile.edit', ['id' => $profile->id]) }}" autocomplete="off">
    <div class="form-row">
        <div class="form-group col-lg-6">
            <label class="text-muted">Profile name</label>
            <div class="input-group">
                <input type="text" name="name" class="form-control name" value="{{ ucwords(auth()->user()->name) }}" placeholder="Enter profile name">
            </div>
            <small class="error name-error text-danger"></small>
        </div>
        <div class="form-group col-lg-6">
            <?php $designations = \App\Models\Profile::$designations; ?>
            <label class="text-muted">Designation</label>
            <select class="form-control custom-select designation" name="designation">
                <option value="">-- Select designation --</option>
                @if(empty($designations))
                    <option value="">No designation listed</option>
                @else
                    @foreach ($designations as $designation)
                        <option value="{{ $designation }}" {{ $profile->designation == $designation ? 'selected' : '' }}>
                            {{ ucfirst($designation) }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="invalid-feedback designation-error"></small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-6">
            <label class="text-muted">Address</label>
            <input type="text" class="form-control address" name="address" value="{{ ucwords($profile->address) }}" placeholder="e.g., No 66 Trenth Avenue">
            <small class="invalid-feedback address-error"></small>
        </div>
        <div class="form-group col-lg-6">
            <label class="text-muted">Profile role</label>
            <select class="form-control custom-select role" name="role">
                <option value="">-- Select role --</option>
                <?php $roles = \App\Models\Profile::$roles; ?>
                @if(empty($roles))
                    <option value="">No roles listed</option>
                @else
                    @foreach ($roles as $role => $description)
                        @foreach($description as $key => $value)
                            <option value="{{ $role.'|'.$value['code'] }}" {{ $profile->role == $role && $profile->code == $value['code'] ? 'selected' : '' }}>
                                {{ ucfirst($value['name']) }}
                            </option>
                        @endforeach
                    @endforeach
                @endif
            </select>
            <small class="invalid-feedback role-error"></small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-6">
            <label class="text-muted">Country located</label>
            <select class="form-control custom-select country" name="country" id="countries">
                <?php $countries = \App\Models\Country::all(); ?>
                <option value="">-- Select country --</option>
                @if(empty($countries))
                    <option value="">No countries listed</option>
                @else: ?>
                    <?php $geoip = geoip()->getLocation(request()->ip());  ?>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ $profile->country_id == $country->id ? 'selected' : '' }} id="{{ $country->state_id }}">
                            {{ ucwords($country->name ?? '') }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="invalid-feedback country-error"></small>
        </div>
        <div class="form-group col-lg-6">
            <label class="text-muted">State, county or division</label>
            <input type="text" class="form-control state" name="state" value="{{ ucwords($profile->state) }}" placeholder="e.g., Texas">
            <small class="invalid-feedback state-error"></small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-6">
            <label class="text-muted">City, area or town</label>
            <input type="text" class="form-control city" name="city" placeholder="e.g., Plano" value="{{ ucwords($profile->city) }}">
            <small class="invalid-feedback city-error"></small>
        </div>
        <div class="form-group col-lg-6">
            <label class="text-muted">Additional phone number</label>
            <input type="text" class="form-control phone" name="phone" placeholder="e.g., +443240989" value="{{ ucwords($profile->phone) }}">
            <small class="invalid-feedback phone-error"></small>
        </div>
    </div>
    <div class="mb-4">
        <label class="text-muted">Description</label>
        <textarea class="form-control description" name="description" placeholder="Enter any further details here" rows="6">{{ $profile->description }}</textarea>
        <small class="invalid-feedback description-error"></small>
    </div>
    <div class="alert mb-3 profile-edit-message d-none"></div>
    <button type="submit" class="btn btn-lg px-4 icon-raduis bg-theme-color text-white profile-edit-button mb-4">
        <img src="/images/spinner.svg" class="mr-2 d-none profile-edit-spinner mb-1">
        Save
    </button>
</form>