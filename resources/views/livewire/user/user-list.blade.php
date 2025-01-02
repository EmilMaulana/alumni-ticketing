<div>
    <!-- Tabel Pengguna -->
    <div class="p-4 bg-white rounded-lg shadow-md">
        <div class="relative overflow-x-auto rounded-lg">
            <h4 class="mb-4 text-center text-lg font-semibold text-gray-900">DAFTAR ALUMNI</h4>
            <!-- Form Pencarian -->
            <div class="grid grid-cols-3 mb-4 px-1">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Cari nama, email, atau nomor whatsapp..."
                    class="px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                />
                <!-- Dropdown Sorting Angkatan -->
                <select
                    wire:model.live="angkatan"
                    class="mx-2  px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300">
                    <option value="" selected>Semua Angkatan</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                <!-- Dropdown Sorting Jurusan -->
                <select
                    wire:model.live="jurusan"
                    class=" px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300"
                >
                    <option value="" selected>Semua Jurusan</option>
                    @foreach ($availableMajors as $major)
                        <option value="{{ $major }}">{{ $major }}</option>
                    @endforeach
                </select>
            </div>
            <table class="px-1 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">No Wa</th>
                        <th scope="col" class="px-6 py-3">Angkatan</th>
                        <th scope="col" class="px-6 py-3">Jurusan</th>
                        <th scope="col" class="px-6 py-3">Pekerjaan</th>
                        <th scope="col" class="px-6 py-3">Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="bg-white border-b text-gray-900">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $user->name }}</th>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <a href="https://wa.me/{{ $user->wa }}" target="_blank" class="text-blue-500 underline">
                                    {{ $user->wa }}
                                </a>
                            </td>                        
                            <td class="px-6 py-4">{{ $user->angkatan }}</td>
                            <td class="px-6 py-4">{{ $user->jurusan }}</td>
                            <td class="px-6 py-4">{{ ucwords($user->occupation) }}</td>
                            <td class="px-6 py-4">
                                @if ($user->profile_photo_path)
                                    <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="object-cover rounded-full h-10 w-10">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}" class="rounded-full h-10">
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white border-b text-gray-900">
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="7" class="px-6 py-4 text-right">
                            <div class="dark my-3">{{ $users->links() }}</div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
