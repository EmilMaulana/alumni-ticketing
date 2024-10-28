<div>
    <h2 class="text-lg font-semibold mb-4">Custom Product List</h2>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 shadow-md rounded-lg">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">USER</th>
                <th scope="col" class="px-6 py-3">DESKRIPSI</th>
                <th scope="col" class="px-6 py-3">STATUS</th>
                <th scope="col" class="px-6 py-3">NO WHATSAPP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customProducts as $product)
                <tr class="bg-white border-b text-gray-900">
                    <td class="px-6 py-4">{{ $product->user->name }}</td>
                    <td class="px-6 py-4">{{ $product->deskripsi }}</td>
                    <td class="px-6 py-4">
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <span @click="open = !open" class="cursor-pointer inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white"
                                :class="{
                                    'bg-yellow-400': '{{ $product->status }}' === 'pending',
                                    'bg-green-600': '{{ $product->status }}' === 'completed',
                                    'bg-red-700': '{{ $product->status }}' === 'canceled',
                                    'bg-gray-700': '{{ $product->status }}' === 'unknown'
                                }">
                                {{ ucfirst($product->status) }}
                            </span>
                        
                            <div x-show="open" class="absolute mt-2 py-2 w-48 bg-white rounded-lg shadow-xl z-10">
                                <button wire:click="updateStatus('{{ $product->id }}', 'pending')" 
                                        class="block w-full text-left px-4 py-2 text-sm text-yellow-600 hover:bg-yellow-100">
                                    Pending
                                </button>
                                <button wire:click="updateStatus('{{ $product->id }}', 'completed')" 
                                        class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-green-100">
                                    Completed
                                </button>
                                <button wire:click="updateStatus('{{ $product->id }}', 'canceled')" 
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                                    Canceled
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $product->nomor_wa) }}?text={{ urlencode('Halo, saya adalah admin. Saya akan menghubungi Anda mengenai produk: ' . $product->deskripsi) }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ $product->nomor_wa }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4">Tidak ada produk kustom yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="py-4">{{ $customProducts->links() }}</td>
            </tr>
        </tfoot>
    </table>
    
</div>

