@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash">
    	<section class="news-banner">
			<div class="container-fluid">
				<div class="row mb-4">
					<div class="col-12 mb-4">
						<h1 class="text-white">Real Estate News</h1>
						<div class="text-white">Our news section links you directly to the detailed page where passed and recent factual informations are displayed to all users. As much as you  sell and buy, you need to have the first hand informations of what is happening in the real estate industry globally. So, we enjoin you to fed your knowledge and constantly stay ahead on your game</div>
					</div>
				</div>
			</div>
		</section>
		<section class="position-relative" style="padding: 100px 0;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						@if($newsapi['status'] === 1)
							<?php $newsdata = $newsapi['data'] ?? []; ?>
							@if(isset($newsdata['status']) && strtolower($newsdata['status']) === 'ok')
								<div class="bg-main-dark p-3 mb-4">
									<h5 class="text-white m-0">
										{{ ucwords($newsdata['user_input']['q'] ?? 'Real Estate') }} News ({{ number_format($newsdata['total_hits'] ?? 0) }})
									</h5>
								</div>
								<?php $articles = $newsdata['articles'] ?? []; ?>
								<div class="">
									@if(empty($articles))
										<div class="alert alert-info">No News Available</div>
									@else
										<div class="row">
											@foreach($articles as $news)
												<div class="col-12 col-md-6">
													@include('frontend.news.partials.card')
												</div>
											@endforeach
										</div>
									@endif
									<?php $totalPages = $newsdata['total_pages'] ?? 0; $currentPage = $newsdata['page'] ?? 1 ?>
									@if(!empty($totalPages))
										<div class="alert-info alert mt-2">
											<?php $requestPage = request()->page ?? 1; ?>
											@if($requestPage > 1)
												<?php $nextPage = ($currentPage - 1); ?>
												<a href="{{ $requestPage == 2 ? url('news') : url("news?page={$nextPage}") }}" class="mr-2 text-underline">
													<small class="text-main-dark">Previous</small>
												</a>
											@endif
											@if($totalPages >= $requestPage)
												<?php $previousPage = ($currentPage + 1); ?>
												<a href="{{ url("news?page={$previousPage}") }}" class="mr-2 text-underline">
													<small class="text-main-dark">Next</small>
												</a>
											@endif
										</div>
									@endif
								</div>
							@else
								<div class="alert alert-danger">News not available</div>
							@endif
						@else
							<div class="alert alert-danger">News not found. Try again later</div>
						@endif
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')