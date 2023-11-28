{{-- breadCrumbs --}}
<nav {{ $attributes }}>
    <ul class="flex space-x-2 text-white font-semibold">
        <li>
            <a href="/">Home</a>
        </li>

        @foreach ($links as $key=>$link)
            <li>→</li>
            <li>
                <a href="{{ $link }}">{{ $key }}</a>
            </li>
        @endforeach
    </ul>
</nav>
