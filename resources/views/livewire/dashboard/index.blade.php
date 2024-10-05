<div>
    {{-- Be like water. --}}
    
    <section>
        <h1 class="text-xl font-bold">Daftar Pengguna</h1>
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user) <!-- Gunakan forelse untuk menangani situasi tanpa data -->
                    <tr>
                        <td class="border px-4 py-2">{{ $user->id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->role }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500">Edit</a>
                            <button wire:click="deleteUser({{ $user->id }})" class="text-red-500">Delete</button>
                        </td>
                    </tr>
                @empty <!-- Jika tidak ada pengguna, tampilkan pesan -->
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">Tidak ada pengguna ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>
