<div>
    {{-- Be like water. --}}
    <h3 class="text-center text-3xl font-semibold mb-6">CARI DATA ALUMNI</h3>

    <!-- Form Pencarian -->
    <div class="flex justify-center mb-6">
        <div class="group/search-bar p-[14px_18px] bg-belibang-darker-grey ring-1 ring-[#414141] hover:ring-[#888888] max-w-[560px] w-full rounded-full transition-all duration-300">
            <div class="relative text-left">
                <button type="submit" class="absolute inset-y-0 left-0 flex items-center px-3">
                    <img src="{{ asset('images/icons/search-normal.svg') }}" alt="icon pencarian" class="w-5 h-5">
                </button>
                <input name="search" wire:model.live="search" type="text"
                    class="bg-belibang-darker-grey w-full pl-[36px] focus:outline-none placeholder:text-[#595959] pr-9 rounded-full"
                    placeholder="Cari data alumni..." />
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 mb-4 mt-10">
        <!-- Dropdown Sorting Angkatan -->
        <select
            wire:model.live="angkatan"
            class="px-4 me-2 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300">
            <option value="" selected>Semua Angkatan</option>
            @foreach ($availableYears as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>

        <!-- Dropdown Sorting Jurusan -->
        <select
            wire:model.live="jurusan"
            class="px-4 py-2 ms-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300"
        >
            <option value="" selected>Semua Jurusan</option>
            @foreach ($availableMajors as $major)
                <option value="{{ $major }}">{{ $major }}</option>
            @endforeach
        </select>
    </div>
    <!-- Tabel Data Alumni -->
    <div class="flex justify-center rounded-lg overflow-hidden shadow-lg">
        <div class="overflow-x-auto w-full mx-auto">
            <table class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Angkatan</th>
                        <th scope="col" class="px-6 py-3">Jurusan</th>
                        <th scope="col" class="px-6 py-3">Pekerjaan</th>
                        <th scope="col" class="px-6 py-3">Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="bg-gray-900 border-b text-gray-300">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $user->name }}</th>         
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
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td>
                            <p class="mx-3">Data Alumni Terbaru</p>
                        </td>
                        <td colspan="5" class="px-6 py-4 text-right">
                            <div class="dark my-3">{{ $users->links() }}</div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
