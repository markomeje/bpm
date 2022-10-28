<?php $title = ucfirst(retitle($property)); ?>
<div class="card border-0 bg-white w-100 card-raduis position-relative">
    <div class="position-absolute w-100 px-4 mt-4" style="z-index: 2;">
        <div class="d-flex justify-content-between">
            <div class="">
                <div class="d-flex align-items-center flex-wrap">
                    <?php $actions = \App\Models\Property::$actions; $action = strtolower($property->action); ?>
                    @if(isset($actions[$action]))
                        <small class="bg-theme-color px-3 py-1 tiny-font text-white mr-2 mb-2">
                            {{ ucwords($actions[$action]) }}
                        </small>
                    @endif
                    <small class="bg-theme-color tiny-font px-3 py-1 mr-2 text-white mb-2">
                        {{ ucwords($property->category) }}
                    </small>
                </div>
                @if($property->promoted == true && ($property->promotion ? $property->promotion->status == 'active' : ''))
                    <a href="javascript:;" class="d-block text-decoration-none">
                        <small class="bg-success px-3 py-1 text-white tiny-font mb-2">Promoted</small>
                    </a>  
                @endif
            </div>
            <div class="">
                <div class="dropdown">
                    <a href="javascript:;" class="d-block text-decoration-none mb-2" id="share-dropdown" data-toggle="dropdown" aria-expanded="false" data-offset="0, 12">
                        <small class="bg-white border text-theme-color rounded cursor-pointer px-2 py-1">
                            <i class="icofont-share"></i>
                        </small>
                    </a>
                    <div class="dropdown-menu border-0 p-0 m-0 shadow-sm dropdown-menu-right" aria-labelledby="share-dropdown">
                        @set('socials', ['twitter', 'facebook', 'linkedin', 'whatsapp', 'telegram'])
                        <div class="d-flex align-items-center justify-content-between p-3 text-center">
                            @if(empty($socials))
                                <div class="alert alert-danger m-0">No social handles</div>
                            @else
                                @set('categories', \App\Models\Property::$categories)
                                @set('last', array_values($socials))
                                @foreach($socials as $social)
                                    <div class="p-2 cursor-pointer {{ end($last) == $social ? '' : 'mr-2' }} border-theme-color text-decoration-none  text-theme-color" data-sharer="{{ $social }}" data-title="Checkout this {{ $title }}. {{ $property->description }} Please contact @ {{ $property->user ? $property->user->phone : 'N/A' }}." data-hashtags="bestpropertymarket,realestate,globalproperties,lands,buildings,estates,properties" data-url="{{ route('property.category.id.slug', ['category' => $property->category, 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}">
                                        <div class="">
                                            <i class="icofont-{{ $social }}"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @endif 
                        </div>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
    <div class="position-relative" style="height: 280px; line-height: 280px;">
        <a href="{{ route('property.category.id.slug', ['category' => $property->category, 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}" class="text-decoration-none rounded-top">
            @if($property->images()->exists())
                @foreach($property->images()->where(['role' => 'main'])->take(1)->get() as $image)
                    <img src="{{ $image->link }}" class="img-fluid w-100 h-100 object-cover" data-role="{{ $image->role }}">
                @endforeach
            @else
                <img src="/images/banners/placeholder.png" class="img-fluid w-100 h-100 object-cover">
            @endif
        </a>
        <div class="position-absolute w-100 px-3 d-flex align-items-center justify-content-between" style="height: 45px; line-height: 45px; bottom: 0; background-color: rgba(0, 0, 0, 0.6);">
            <div class="">
                <small class="text-theme-color">
                    <i class="icofont-location-pin"></i>
                </small>
                <small class="text-white">
                    {{ \Str::limit(ucwords($property->city), 16) }}
                </small>
            </div>
            <div>
                <span class="text-theme-color">
                    <i class="icofont-bullseye"></i>
                </span>
                <small class="text-white">
                    {{ empty($property->views) ? 0 : $property->views }}
                </small>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="font-weight-bolder mb-3">
            <a href="{{ route('property.category.id.slug', ['category' => $property->category, 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}" class="text-main-dark text-underline">
                {{ \Str::limit($title, 45) }}
            </a>
        </div>
        <h4 class="text-theme-color">
            {{ $property->currency->symbol ?? 'NGN' }}{{ number_format($property->price) }}
        </h4>
        <div class="geodir-card-text">
            <a href="{{ route('property.category.id.slug', ['category' => $property->category->name ?? 'any', 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}" class="text-underline text-main-dark">
                <span class="">
                    {{ \Str::limit($property->additional, 18) }}
                </span>
            </a>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('account.profile', ['id' => $property->user->profile->id ?? 0, 'name' => \Str::slug($property->user->name)]) }}" class="rounded-circle lg-circle m-0 d-block">
                <div class="p-1 m-0 border border-{{ $property->status == 'active' ? 'success' : 'danger' }} rounded-circle w-100 h-100">
                    @if(empty($property->user->profile->image->link))
                        <div class="w-100 h-100 border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                            <small class="text-main-dark">
                                {{ substr(strtoupper($property->user->name), 0, 1) }}
                            </small>
                        </div>
                    @else
                        <img src="{{ $property->user->profile->image->link }}" class="img-fluid object-cover rounded-circle w-100 h-100 border">
                    @endif
                </div>
            </a>
            <div class="ml-2">
                <a href="{{ route('account.profile', ['id' => $property->user->profile->id ?? 0, 'name' => \Str::slug($property->user->name)]) }}" class="text-decoration-none d-block">
                    <small class="text-main-dark">
                        {{ $property->user ? \Str::limit(ucwords($property->user->name), 7) : 'Our Agent' }}
                    </small>
                </a>
                <small class="text-muted tiny-font">
                    {{ $property->created_at->diffForHumans() }}
                </small>
            </div>      
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ empty($property->user->email) ? 'javascript:;' : 'mailto:'.$property->user->email }}" class="text-theme-color text-decoration-none d-block md-circle rounded-circle border-theme-color text-center mr-3">
                <div class="" style="margin-top: 2px;">
                    <i class="icofont-email"></i>
                </div>
            </a>
            <a href="{{ $property->user ? 'tel:'.$property->user->phone : 'javascript:;' }}" class="text-theme-color text-decoration-none d-block md-circle rounded-circle border-theme-color text-center">
                <div class="" style="margin-top: 2px;">
                    <i class="icofont-phone"></i>
                </div>
            </a>
        </div>
    </div>
</div>