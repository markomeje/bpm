@if ($paginator->hasPages())
    <nav class="mb-3">
        <ul class="pagination d-flex align-items-center flex-wrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled mr-3 mb-3 text-center" style="width: 42px;" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        <i class="icofont-long-arrow-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item mr-3 mb-3 text-center" style="width: 42px;">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="icofont-long-arrow-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled mr-3 mb-3 text-center" style="width: 42px;" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active mr-3 mb-3 text-center" style="width: 42px;" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item mr-3 mb-3 text-center" style="width: 42px;"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item mr-3 mb-3 text-center" style="width: 42px;">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="icofont-long-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled mr-3 mb-3 text-center" style="width: 42px;" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        <i class="icofont-long-arrow-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
