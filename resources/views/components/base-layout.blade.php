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

        <!-- Sidebar -->
        <aside class="w-72 bg-gradient-to-b from-slate-900 to-slate-800 text-slate-100 hidden lg:flex flex-col">
            <div class="px-6 py-6 text-2xl font-bold tracking-tight">
                🚨 IncidentDesk
            </div>

            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition">
                    <span>📊</span> Dashboard
                </a>

                <a href="{{ route('incidents.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition">
                    <span>📋</span> Incidenten
                </a>

                <a href="{{ route('incidents.create') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition">
                    <span>➕</span> Nieuw incident
                </a>
            </nav>

            <div class="px-6 py-5 border-t border-slate-700 text-sm">
                <div class="text-slate-400">Ingelogd als</div>
                <div class="font-medium">{{ auth()->user()->name }}</div>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <header class="bg-white/80 backdrop-blur border-b border-slate-200">
                <div class="px-6 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold">
                            @yield('page-title', 'Dashboard')
                        <p class="text-sm text-slate-500">
                            @yield('page-subtitle')
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-sm text-slate-500">
                            {{ now()->format('d M Y') }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="text-sm font-medium text-red-600 hover:text-red-700 transition">
                                Uitloggen
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6">
                <div class="max-w-7xl mx-auto">
                    {{$slot}}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200">
                <div class="px-6 py-3 text-xs text-slate-500">
                    © {{ date('Y') }} IncidentDesk · Laravel {{ app()->version() }}
                </div>
            </footer>
        </div>
    </div>

</body>

</html>