<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="p-4 bg-white rounded-lg shadow-md">
        <div class="relative overflow-x-auto rounded-lg">
            <h4 class="mb-4 text-center text-lg font-semibold text-gray-900">DAFTAR TRANSAKSI</h4>
            <!-- Form Pencarian -->
            <div class="grid grid-cols-2 mb-4 px-1">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Cari Order ID"
                    class="px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                />
                <!-- Dropdown Sorting Produk -->
                <select
                    id="productFilter"
                    wire:model.live="selectedProduct"
                    class="mx-2  px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300">
                    <option value="" selected>Semua Agenda</option>
                    @foreach ($availableProducts as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">Order ID</th>
                        <th scope="col" class="px-6 py-3">User Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">WA</th>
                        <th scope="col" class="px-6 py-3">Jurusan</th>
                        <th scope="col" class="px-6 py-3">Angkatan</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr class="bg-white border-b text-gray-900 text-nowrap">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900  whitespace-nowrap">{{ $transaction->order_id }}</th>
                            <td class="px-6 py-4">{{ $transaction->user->name }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->email }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->wa }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->jurusan }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->angkatan }}</td>
                            <td class="px-6 py-4">{{ number_format($transaction->amount, 2) }}</td>
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
                            <td class="px-6 py-4">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr class="bg-white border-b text-gray-900">
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data yang ditemukan.
                            </td>
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
