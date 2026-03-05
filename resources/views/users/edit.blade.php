<x-base-layout>
    <h1 class="mb-6 text-2xl font-bold">Gebruiker bewerken</h1>

    @if ($errors->any())
        <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4 rounded bg-white p-6 shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="mb-1 block text-sm font-medium">Naam</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded border-gray-300" required>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">E-mail</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded border-gray-300" required>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Rol</label>
            <select name="role" class="w-full rounded border-gray-300" required>
                <option value="gebruiker" @selected(old('role', $user->role) === 'gebruiker')>Gebruiker</option>
                <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
            </select>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Nieuw wachtwoord (optioneel)</label>
            <input type="password" name="password" class="w-full rounded border-gray-300">
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Bevestig nieuw wachtwoord</label>
            <input type="password" name="password_confirmation" class="w-full rounded border-gray-300">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded bg-slate-900 px-4 py-2 text-white">Opslaan</button>
            <a href="{{ route('users.index') }}" class="rounded border border-gray-300 px-4 py-2">Annuleren</a>
        </div>
    </form>
</x-base-layout>
