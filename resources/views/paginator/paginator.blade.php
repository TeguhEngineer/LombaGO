@if ($paginator->hasPages())
    <nav>
        <div class="float-start">
            <p>
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }}
                results
            </p>
        </div>

        <ul class="pagination justify-content-end">
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}&search={{ request('search') }}"
                        rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Tombol Angka --}}
            @php
                $start = max(1, $paginator->currentPage() - 1);
                $end = min($paginator->lastPage(), $paginator->currentPage() + 1);
            @endphp

            {{-- Tombol Halaman Pertama --}}
            @if ($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}&search={{ request('search') }}">1</a>
                </li>
                @if ($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            {{-- Tombol Angka Dinamis --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link"
                            href="{{ $paginator->url($page) }}&search={{ request('search') }}">{{ $page }}</a>
                    </li>
                @endif
            @endfor

            {{-- Tombol Halaman Terakhir --}}
            @if ($end < $paginator->lastPage())
                @if ($end < $paginator->lastPage() - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link"
                        href="{{ $paginator->url($paginator->lastPage()) }}&search={{ request('search') }}">{{ $paginator->lastPage() }}</a>
                </li>
            @endif

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}&search={{ request('search') }}"
                        rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
