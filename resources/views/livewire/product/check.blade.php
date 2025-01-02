<div>
    {{-- In work, do what you enjoy. --}}
    <div class="p-4 bg-white rounded-lg shadow-md">
        <div class="relative overflow-x-auto rounded-lg">
            <h4 class="mb-4 text-center text-lg font-semibold text-gray-900">DAFTAR KEHADIRAN</h4>
            <div class="grid grid-cols-2 mb-4 px-1">
                <!-- Input Pencarian -->
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Cari Order ID"
                    class="px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                />
        
                <!-- Dropdown Filter Produk -->
                <select
                    wire:model.live="selectedProduct"
                    class="ms-2 px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" selected>Semua Agenda</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            
        
            <!-- Tabel Transaksi -->
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Checklist</th>
                        <th class="px-6 py-3">Order ID</th>
                        <th class="px-6 py-3">Agenda</th>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Jurusan</th>
                        <th class="px-6 py-3">Angkatan</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="bg-white border-b text-gray-900 text-nowrap">
                            <td class="px-6 py-4">
                                <!-- Tombol untuk update status kehadiran -->
                                <div x-data="{ open: false }" @click.away="open = false" class="relative">
                                    <span @click="open = !open" class="cursor-pointer inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white"
                                        :class="{
                                            'bg-green-600': '{{ $transaction->check && $transaction->check->is_checked ? 'hadir' : 'tidak hadir' }}' === 'hadir',
                                            'bg-red-700': '{{ $transaction->check && $transaction->check->is_checked ? 'hadir' : 'tidak hadir' }}' === 'tidak hadir'
                                        }">
                                        {{ ucfirst($transaction->check && $transaction->check->is_checked ? 'hadir' : 'tidak hadir') }}
                                    </span>
                                    <div x-show="open" @click.away="open = false" class="absolute mt-2 py-2 w-48 bg-white rounded-lg shadow-xl z-10">
                                        <!-- Tombol untuk memperbarui status kehadiran -->
                                        <button wire:click="updateStatus({{ $transaction->id }}, 'hadir')" class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-green-100">
                                            Hadir
                                        </button>
                                        <button wire:click="updateStatus({{ $transaction->id }}, 'tidak hadir')" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                                            Tidak Hadir
                                        </button>
                                    </div>
                                </div>
                            </td>                        
                            <td class="px-6 py-4">{{ $transaction->order_id }}</td>
                            <td class="px-6 py-4">{{ $transaction->product->name }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->name }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->jurusan }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->angkatan }}</td>
                            <td class="px-6 py-4">{{ $transaction->created_at->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium text-white" 
                                    :class="{
                                    'bg-green-500': '{{ $transaction->status }}' === 'success',
                                    'bg-yellow-500': '{{ $transaction->status }}' === 'pending',
                                    'bg-red-500': '{{ $transaction->status }}' === 'failed'
                                    }">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="9" class="px-6 py-4">
                            {{ $transactions->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
