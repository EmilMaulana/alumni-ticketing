<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="relative overflow-x-auto ">
        <h4 class="mb-2 text-lg font-semibold text-gray-900 ">Posts</h4>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
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
                                <div x-show="open" @click.away="open = false" class="absolute mt-2 py-2 w-48 bg-white rounded-lg shadow-xl z-10">
                                    <button wire:click="updateStatus('{{ $post->id }}', 'pending')" class="block w-full text-left px-4 py-2 text-sm text-yellow-600 hover:bg-yellow-100">Pending</button>
                                    <button wire:click="updateStatus('{{ $post->id }}', 'approved')" class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-green-100">Approved</button>
                                    <button wire:click="updateStatus('{{ $post->id }}', 'rejected')" class="block w-full text-left px-4 py-2 text-sm text-red -600 hover:bg-red-100">Rejected</button>
                                </div>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $post->title }}</th>
                        <td class="px-6 py-4">{{ $post->category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-50">
                    <td colspan="4" class="px-6 py-4 text-right">
                        <div class="">{{ $posts->links() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
