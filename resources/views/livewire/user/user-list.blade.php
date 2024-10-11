<div>
    <section class="header px-7 py-10">
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Profile
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="bg-white border-b text-gray-900">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>                               
                            <td class="px-6 py-4">
                                @if ($user->profile_photo_path)
                                    <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-40 rounded-full">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}" class="rounded-full h-10">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="dark my-3">
                    {{ $users->links() }}
                </div>
            </table>
        </div>
    </section>
    <section class="header px-7 py-10">
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Author</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="bg-white border-b text-gray-900">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $post->user->name }}</th>
                            <td class="px-6 py-4">
                                <div x-data="{ open: false }" @click.away="open = false" class="relative">
                                    <span @click="open = !open" class="cursor-pointer inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white"
                                        :class="{
                                            'bg-yellow-400': '{{ $post->status }}' === 'pending',
                                            'bg-green-600': '{{ $post->status }}' === 'approved',
                                            'bg-red-700': '{{ $post->status }}' === 'rejected',
                                            'bg-gray-700': '{{ $post->status }}' === 'unknown'
                                        }">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                    
                                    <!-- Dropdown untuk mengubah status -->
                                    <div x-show="open" @click.away="open = false" class="absolute mt-2 py-2 w-48 bg-white rounded-lg shadow-xl z-10">
                                        <button wire:click="updateStatus('{{ $post->id }}', 'pending')" class="block w-full text-left px-4 py-2 text-sm text-yellow-600 hover:bg-yellow-100">
                                            Pending
                                        </button>
                                        <button wire:click="updateStatus('{{ $post->id }}', 'approved')" class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-green-100">
                                            Approved
                                        </button>
                                        <button wire:click="updateStatus('{{ $post->id }}', 'rejected')" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                                            Rejected
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $post->title }}</th>
                            <td class="px-6 py-4">{{ $post->category->name }}</td>                               
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="dark my-3">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
</div>
