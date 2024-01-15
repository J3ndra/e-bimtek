@if ($paginator->hasPages())
<div class="card-footer p-8pt">
    <ul class="pagination justify-content-start pagination-xsm m-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="@lang('pagination.previous')"> <span aria-hidden="true" class="material-icons">chevron_left</span>
                <span>Prev</span>
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')"> <span>Previous</span>
                <span aria-hidden="true" class="material-icons">chevron_right</span>
            </a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item disabled" aria-current="page">
            <a class="page-link" href="javascript:void(0)"> <span>{{ $page }}</span>
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $url }}"> <span>{{ $page }}</span>
            </a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')"> <span>Next</span>
                <span aria-hidden="true" class="material-icons">chevron_right</span>
            </a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="@lang('pagination.next')"> <span aria-hidden="true" class="material-icons">chevron_right</span>
                <span>Next</span>
            </a>
        </li>
        @endif
        
    </ul>
</div>
@endif
