<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Incident Registratie')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Incident Registratie</h1>

            <div class="space-x-4">
                <a href="{{ route('incidents.index') }}"
                   class="text-gray-600 hover:text-black">
                    Overzicht
                </a>

                <a href="{{ route('incidents.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Nieuw incident
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t text-center text-sm text-gray-500 py-4">
        &copy; {{ date('Y') }} Incident Registratie
    </footer>

</body>
</html>
