@if ($paginator->hasPages())

    <div class="pagination-bar">

        <div class="pagination-info">
            Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </div>

        <div class="pagination-links">

            @if ($paginator->onFirstPage())
                <span class="btn btn-secondary pagination-disabled">← Prev</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-secondary">← Prev</a>
            @endif

            @foreach ($paginator->getUrlRange(
                max(1, $paginator->currentPage() - 2),
                min($paginator->lastPage(), $paginator->currentPage() + 2)
            ) as $page => $url)

                @if ($page == $paginator->currentPage())
                    <span class="btn btn-primary pagination-current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="btn btn-secondary">{{ $page }}</a>
                @endif

            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-secondary">Next →</a>
            @else
                <span class="btn btn-secondary pagination-disabled">Next →</span>
            @endif

        </div>

    </div>

@endif