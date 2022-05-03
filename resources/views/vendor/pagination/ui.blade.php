@if ($paginator->hasPages())
    <div class="listings-pagination-wrap">
      <span class="section-separator"></span>
        <nav class="navigation pagination custom-pagination ajax-pagination" role="navigation">
          <div class="nav-links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
              <span data-page="1" class="prevposts-link page-numbers"><i class="fa fa-caret-left"></i></span>
            @else

                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <span data-page="1" class="prevposts-link page-numbers"><i class="fa fa-caret-left"></i></span>
                </a>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a data-page="{{ $element }}" href="#" class="page-numbers ajax-pagi-item">
                      {{ $element }}
                    </a>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a data-page="3" href="javascript:;" data-page="{{ $page }}" aria-current="page" class="page-numbers active ajax-pagi-item">
                              {{ $page }}
                            </a>
                        @else
                        <a data-page="3" href="{{ $url }}" class="page-numbers active ajax-pagi-item">
                              {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())

            <a data-page="2" href="{{ $paginator->nextPageUrl() }}" rel="next" class="nextposts-link page-numbers ajax-pagi-item">
              <i class="fa fa-caret-right"></i>
            </a>

            @else
                <a data-page="2" href="javascript:;" rel="next" class="nextposts-link page-numbers ajax-pagi-item">
                  <i class="fa fa-caret-right"></i>
                </a>
            @endif
          </div>
        </nav>
    </div>
@endif
