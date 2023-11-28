<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Job Board</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body class="mx-auto mt-10 max-w-4xl bg-gradient-to-r from-slate-900 from-10% via-slate-750 via-30% to-slate-600 to-90% text-slate-700">
        <nav class="mb-8 flex justify-between text-lg font-medium bg-white py-4 px-4 rounded-sm">
            <ul class="flex">
                <li>
                    <a href="{{ route('jobs.index') }}">Home</a>
                </li>
            </ul>

            <uL class="flex justify-between gap-2">
                @auth
                    <li>
                       <a href="{{ route('my-job-applications.index') }}">
                        {{ auth()->user()->name ?? 'Anonymous' }}: Applications |
                       </a>
                    </li>

                    <li>
                        <a href="{{ route("my-jobs.index") }}">My Jobs</a>
                    </li>

                    <li>
                        <form action="{{ route('auth.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <a href="{{ route('auth.create') }}">Login</a>
                @endauth
            </uL>
        </nav>

        @if (session('success'))
            <div class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-800 opacity-75">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-800 opacity-75">
                <p class="font-bold">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        {{ $slot }}
    </body>
</html>
