@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
        @set('banner', \App\Models\Content::where(['page' => 'about', 'section' => 1])->first())
        @if(!empty($banner))
            <section class="about-banner">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h1 class="text-white">
                                {{ ucwords($banner->title) }}
                            </h1>
                            <div class="text-white">{{ ucfirst($banner->content) }}</div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="mission-vision position-relative">
            <div class="container-fluid">
                @set('mission', \App\Models\Content::where(['page' => 'about', 'section' => 2])->first())
                @if(!empty($mission))
                    <div class="row">
                        <div class="col-12 col-md-7 mb-4">
                            <h1 class="text-main-dark">
                                {{ ucwords($mission->title) }}
                            </h1>
                            <div class="text-white mb-4">
                                {!! $mission->content !!}
                            </div>
                        </div>
                    </div>
                @endif
                @set('core', \App\Models\Content::where(['page' => 'about', 'section' => 3])->first())
                @if(!empty($core))
                    <div class="row">
                        <div class="col-12 col-md-7 mb-4">
                            <h1 class="text-main-dark mb-4">
                                {{ $core->title }}
                            </h1>
                            @set('values', explode(';', $core->content))
                            @if(count($values) > 0)
                                <div class="row">
                                    @foreach($values as $key => $value)
                                        @if(!empty($value))
                                            <div class="col-12 mb-4">
                                                <div class="pb-3" style="border-bottom: 1px solid #b53a3a;">
                                                    <h5 class="text-white">
                                                        {{ ucfirst($value) }}
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
    @include('frontend.layouts.bottom')
@include('layouts.footer')