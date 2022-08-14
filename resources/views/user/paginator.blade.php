<div class="col-12">
    <div id="pagination">
        <nav aria-label="">
            <ul class="pagination">

                @if ($paginator->onFirstPage())

                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true"><i class="fas fa-chevron-left"></i></a>
                    </li>
                @endif


                @foreach ($elements as $element)
                    @if (count($element) < 2)

                    @else
                        @foreach ($element as $key => $el)
                            @if ($key == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link " href="javascript::void">{{ $key }}</a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $el }}">{{ $key }}</a></li>

                            @endif
                        @endforeach
                    @endif
                @endforeach




                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                    </li>
                @endif


            </ul>
        </nav>
    </div>
</div>


