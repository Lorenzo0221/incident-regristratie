<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Incident Registratie')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 text-slate-800 antialiased">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col bg-gradient-to-b from-slate-900 to-slate-800 text-slate-100 lg:flex">
            <div class="px-6 py-6 text-2xl font-bold tracking-tight">
                IncidentDesk
            </div>

            <nav class="flex-1 space-y-1 px-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-700">
                    Dashboard
                </a>

                <a href="{{ route('incidents.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-700">
                    Incidenten
                </a>

                <a href="{{ route('incidents.create') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-700">
                    Nieuw incident
                </a>

                <a href="{{ route('incidents.stats') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-700">
                    Statistieken
                </a>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('users.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-700">
                            Gebruikers
                        </a>
                    @endif
                @endauth
            </nav>

            <div class="border-t border-slate-700 px-6 py-5 text-sm">
                @auth
                    <div class="text-slate-400">Ingelogd als</div>
                    <div class="font-medium">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-slate-400">{{ auth()->user()->role }}</div>
                @else
                    <div class="text-slate-400">Niet ingelogd</div>
                    <a href="{{ route('login') }}" class="font-medium hover:underline">Inloggen</a>
                @endauth
            </div>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="border-b border-slate-200 bg-white/80 backdrop-blur">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h1 class="text-2xl font-semibold">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-slate-500">@yield('page-subtitle')</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-sm text-slate-500">{{ now()->format('d M Y') }}</span>

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="text-sm font-medium text-red-600 transition hover:text-red-700">
                                    Uitloggen
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6">
                <div class="mx-auto max-w-7xl">
                    {{ $slot }}
                </div>
            </main>

            <footer class="border-t border-slate-200 bg-white">
                <div class="px-6 py-3 text-xs text-slate-500">
                    &copy; {{ date('Y') }} IncidentDesk · Laravel {{ app()->version() }}
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
