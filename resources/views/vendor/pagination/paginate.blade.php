@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        {{-- (~600px) --}}
        <div class="flex justify-between flex-1 tablet:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm text-admin-text-sub bg-admin-main border-2 border-admin-accent rounded-xl cursor-default">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm bg-white border-2 border-admin-accent rounded-xl hover:text-gray-500 focus:outline-none focus:border-blue-300 transition-all duration-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm bg-white border-2 border-admin-accent rounded-xl hover:text-gray-500 focus:outline-none focus:border-blue-300 transition-all duration-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-admin-text-sub bg-admin-main border-2 border-admin-accent rounded-xl cursor-default">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="w-full hidden tablet:flex flex-col-reverse lg:flex-row items-center justify-between">
            <div class="text-sm mt-6 lg:mt-0">
                <span class="font-medium">
                    {{ $paginator->total() }} 件中
                </span>
                @if ($paginator->firstItem())
                    <span class="font-medium">
                        {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} 件表示
                    </span>
                @else
                    {{ $paginator->count() }} 件表示
                @endif
            </div>

            <div class="">
                <span class="relative z-0 inline-flex text-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="inline-flex p-2 text-gray-300 bg-white border border-gray-300 cursor-default rounded-l-xl" aria-hidden="true">
                                <i class="fas fa-angle-left w-5 h-5 content-center text-center"></i>
                            </span>
                        </span>
                    @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex p-2 bg-white border border-gray-300 rounded-l-xl hover:bg-admin-accent/50 focus:z-10 focus:outline-none focus:bg-admin-accent/50 transition duration-300" aria-label="{{ __('pagination.previous') }}">
                            <i class="fas fa-angle-left w-5 h-5 content-center text-center"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-2 md:px-4 py-2 -ml-px bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-2 md:px-4 py-2 -ml-px bg-admin-accent border border-gray-300 cursor-default">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-2 md:px-4 py-2 -ml-px bg-white border border-gray-300 hover:bg-admin-accent/50 focus:z-10 focus:outline-none focus:bg-admin-accent/50 transition duration-300" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex p-2 -ml-px bg-white border border-gray-300 rounded-r-xl hover:bg-admin-accent/50 focus:z-10 focus:outline-none focus:bg-admin-accent/50 transition duration-300" aria-label="{{ __('pagination.next') }}">
                            <i class="fas fa-angle-right w-5 h-5 content-center text-center"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="inline-flex p-2 -ml-px text-gray-300 bg-white border border-gray-300 cursor-default rounded-r-xl" aria-hidden="true">
                                <i class="fas fa-angle-right w-5 h-5 content-center text-center"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
