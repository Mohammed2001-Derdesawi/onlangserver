@if ($paginator->hasPages())
        <div class="edu-pagination mt-30 mb-20">
            @if ($paginator->onFirstPage())
                <span >
                    @if (App::getLocale() == 'en')

              <i class="fal fa-angle-left"></i>
              @elseif (App::getLocale() == 'ar')
              <i class="fal fa-angle-right"></i>

              @endif

                </span>

            @else
            @if (App::getLocale() == 'en')
                <a href="{{ $paginator->previousPageUrl() }}" id="paginator-prev" ><i class="fal fa-angle-left"></i>                </a>

                    @elseif (App::getLocale() == 'ar')

                <a href="{{ $paginator->previousPageUrl() }}" id="paginator-prev" ><i class="fal fa-angle-right"></i>
                 @endif

                </a>
            @endif

            @if ($paginator->hasMorePages())
            @if (App::getLocale() == 'en')

                <a href="{{ $paginator->nextPageUrl() }}" id="paginator-next" > <i class="fal fa-angle-right"></i>

                </a>
                @else
                <a href="{{ $paginator->nextPageUrl() }}" id="paginator-next" > <i class="fal fa-angle-left"></i>

                </a>
                @endif

            @else
                <span >
                    @if (App::getLocale() == 'en')

                <i class="fal fa-angle-right"></i>
                @elseif (App::getLocale() == 'ar')
                <i class="fal fa-angle-left"></i>

                @endif

                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}

                </p>
            </div>


        </div>
@endif
