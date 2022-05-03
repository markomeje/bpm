@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="mb-3">
                            <h4 class="text-main-dark">List Building Material</h4>
                            <div class="text-muted">After listing, you will be redirected to add the images.</div>
                        </div>
                    </div>
                    <div class="bg-white p-4 card-raduis">
                        @set('location', geoip()->getLocation())
                        <form method="post" action="javascript:;" class="add-material-form" data-action="{{ route('user.material.add') }}" autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="text-muted">Building material name or title</label>
                                    <textarea class="form-control name" name="name" placeholder="e.g., Dangote cement" rows="2"></textarea>
                                    <small class="invalid-feedback name-error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-muted">Country</label>
                                    <select class="form-control custom-select country" name="country" id="countries">
                                        <option value="">-- Select country --</option>
                                        @set('countries', \App\Models\Country::all())
                                        @if(empty($countries->count()))
                                            <option value="">No countries listed</option>
                                        @else: ?>
                                            <?php $geoip = geoip()->getLocation(request()->ip());  ?>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ strtolower($location['iso_code']) == strtolower($country->iso2) ? 'selected' : '' }}>
                                                    {{ ucwords($country->name ?? '') }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="invalid-feedback country-error"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-muted">State, county or division</label>
                                    <input type="text" class="form-control state" name="state" placeholder="e.g., Texas" value="{{ $location['state_name'] ?? '' }}">
                                    <small class="invalid-feedback state-error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-muted">City, area or town</label>
                                    <input type="text" class="form-control city" name="city" placeholder="e.g., Plano" value="{{ $location['city'] ?? '' }}">
                                    <small class="invalid-feedback city-error"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-muted">Available quantity or amount</label>
                                    <input type="text" class="form-control quantity" name="quantity" placeholder="e.g., 10bags">
                                    <small class="invalid-feedback quantity-error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="text-muted">Address</label>
                                    <textarea class="form-control address" name="address" placeholder="e.g., No 405 Trenth Avenue" rows="2"></textarea>
                                    <small class="invalid-feedback address-error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-muted">Currency</label>
                                    <select class="form-control custom-select currency" name="currency">
                                        <option value="">-- Select currency --</option>
                                        @set('currencies', \App\Models\Currency::all())
                                        @if(empty($currencies->count()))
                                            <option>No currencies listed</option>
                                        @else: ?>
                                            @foreach ($currencies as $currency)
                                                <?php $code = $currency->code ?? ''; ?>
                                                <option value="{{ $currency->id }}" {{ strtolower($location['currency']) == strtolower($code) ? 'selected' : '' }}>
                                                    {{ ucwords($currency->name) }}({{ strtoupper($code) }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="invalid-feedback currency-error"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-muted">Price per unit</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control price" name="price" placeholder="e.g., 200">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        <small class="invalid-feedback price-error"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted">Additional details</label>
                                <textarea class="form-control additional" name="additional" placeholder="Enter any further details here" rows="4"></textarea>
                                <small class="invalid-feedback additional-error"></small>
                            </div>
                            <div class="alert mb-3 add-material-message d-none"></div>
                            <div class="d-flex justify-content-right mb-3 mt-1">
                                <button type="submit" class="btn icon-raduis btn-info px-4 btn-lg text-white add-material-button">
                                    <img src="/images/spinner.svg" class="mr-2 d-none add-material-spinner mb-1">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>                   
                </div>
            </div>      
        </div>
    </div>
</div>
@include('layouts.footer')    