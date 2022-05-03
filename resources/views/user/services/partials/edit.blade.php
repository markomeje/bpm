<div class="modal fade" id="edit-service-{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="edit-service-form" data-action="{{ route('user.service.edit', ['id' => $service->id]) }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-main-dark mb-0">Edit service</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Minimum Price (NGN)</label>
                            <input type="number" class="form-control price" name="price" placeholder="e.g., 1000" value="{{ $service->price }}">
                            <small class="invalid-feedback price-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Service</label>
                            <select class="form-control custom-select skill" name="skill">
                                <option value="">-- Select Service --</option>
                                @set('skills', \App\Models\Skill::all())
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ $service->skill_id == $skill->id ? 'selected' : '' }}>
                                        {{ ucfirst($skill->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="invalid-feedback skill-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        @set('location', geoip()->getLocation())
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
                                        <option value="{{ $currency->id }}" {{ $service->currency_id == $currency->id ? 'selected' : '' }}>
                                            {{ ucwords($currency->name) }}({{ strtoupper($code) }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback currency-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Activate Now?</label>
                            <select class="form-control custom-select status" name="status">
                                <option value="">-- Select answer --</option>
                                @set('status', \App\Models\Service::$status)
                                @foreach ($status as $answer => $value)
                                    <option value="{{ $answer }}" {{ $service->status == $answer ? 'selected' : '' }}>
                                        {{ ucfirst($value) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="invalid-feedback status-error"></small>  
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-main-dark">Description (400 characters maximum)</label>
                        <textarea class="form-control description" name="description" rows="8" placeholder="Enter description of your service">{{ $service->description }}</textarea>
                        <small class="invalid-feedback description-error"></small>
                    </div>
                    <div class="alert mb-3 edit-service-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn bg-theme-color text-white icon-raduis btn-lg px-4 edit-service-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none edit-service-spinner mb-1">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>