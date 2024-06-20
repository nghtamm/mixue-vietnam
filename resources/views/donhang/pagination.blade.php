<input type="hidden" name="_currentPage" id="_currentPage" value="{{ $paginator->currentPage() }}">
<div class="col-sm-3" style="margin-top: -5px">
    <div class="dataTables_info" style="margin-top: 5px;"><span class="page-link">Danh sách đang hiển thị
            {{ $paginator->count() }} / {{ $paginator->total() }} đơn hàng</span></div>
</div>
<div class="col-sm-6" style="display: flex; justify-content: center;">
    <div class="main_paginate">
        @if ($paginator->hasPages())
            <ul class="pagination pagination-sm" style="margin: 0;white-space: nowrap;text-align: center;">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Trước</span></li>
                @else
                    <li class="page-item"><a page="{{ $paginator->currentPage() - 1 }}" class="page-link"
                            rel="prev">Trước</a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a page="{{ $page }}"
                                        class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a page="{{ $paginator->currentPage() + 1 }}" class="page-link"
                            rel="next">Tiếp</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">Tiếp</span></li>
                @endif
            </ul>
        @endif
    </div>
</div>
<div class="col-sm-3" style="padding-bottom: 5px;">
    <div class="left_paginate" style="display:flex; align-items: center;">
        <div class="col-sm-6" style="display:flex; align-items: center; justify-content: end; padding-right: 15px">
            <span class="page-link">Hiển thị</span>
        </div>
        <div class="col-sm-6">
            <select style="font-size:14px; max-width: 100%;" id="cdan_nuber_record_page"
                class="col-sm-1 form-control input-sm" name="cdan_nuber_record_page">

                <option id="15" name="15" value="15" @if ($paginator->perPage() == 15) selected @endif>
                    15</option>
                <option id="50" name="50" value="50" @if ($paginator->perPage() == 50) selected @endif>
                    50</option>
                <option id="100" name="100" value="100" @if ($paginator->perPage() == 100) selected @endif>
                    100</option>
            </select>
        </div>
    </div>
</div>
