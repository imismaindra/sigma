@if ($paginator->hasPages())
    <nav class="simple-pagination" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="page-button disabled">Sebelumnya</span>
        @else
            <a class="page-button" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
        @endif

        <span class="page-info">
            Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}
            <span>{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data</span>
        </span>

        @if ($paginator->hasMorePages())
            <a class="page-button" href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya</a>
        @else
            <span class="page-button disabled">Berikutnya</span>
        @endif
    </nav>
@endif
