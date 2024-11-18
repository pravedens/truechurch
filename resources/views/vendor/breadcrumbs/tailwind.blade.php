@unless ($breadcrumbs->isEmpty())
    <nav class="container mx-auto">
        <ol class="flex flex-wrap p-4 text-sm text-gray-800 bg-gray-300 rounded">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}" class="text-blue-600 hover:text-blue-900 hover:underline focus:text-blue-900 focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li>
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="px-2 text-gray-500">
                        >
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
