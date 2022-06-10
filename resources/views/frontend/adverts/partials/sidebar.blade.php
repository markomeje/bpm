@set('svbs', \App\Models\Advert::where(['status' => 'active', 'size' => 'svb'])->inRandomOrder()->take(2)->get())
@if(!empty($svbs))
	<div class="row">
		@foreach($svbs as $advert)
			@if(!empty($advert->image->link))
				<div class="col-12 mb-4">
					<a href="{{ $advert->link }}" target="_blank" class="w-100 advert-click d-block" style="height: 480px;">
						<img src="{{ $advert->image->link }}" class="img-fluid border w-100 h-100 object-cover">
					</a>
				</div>
			@endif
		@endforeach
	</div>
@endif
@set('ssbs', \App\Models\Advert::where(['status' => 'active', 'size' => 'ssb'])->inRandomOrder()->take(2)->get())
@if(!empty($ssbs))
	<div class="row">
		@foreach($ssbs as $advert)
			@if(!empty($advert->image->link))
				<div class="col-6 mb-4">
					<a href="{{ $advert->link }}" target="_blank" class="w-100 advert-click d-block" style="height: 200px;">
						<img src="{{ $advert->image->link }}" class="img-fluid border w-100 h-100 object-cover">
					</a>
				</div>
			@endif
		@endforeach
	</div>
@endif