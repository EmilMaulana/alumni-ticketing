<div>
    <!-- Tabel Pengguna -->
    <div class="relative overflow-x-auto rounded-lg">
        <h4 class="mb-2 text-lg font-semibold text-gray-900 ">User</h4>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Profile</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b text-gray-900">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $user->name }}</th>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if ($user->profile_photo_path)
                                <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-10 rounded-full">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}" class="rounded-full h-10">
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-50">
                    <td colspan="3" class="px-6 py-4 text-right">
                        <div class="dark my-3">{{ $users->links() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
