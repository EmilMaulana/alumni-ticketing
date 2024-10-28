<div>
    {{-- In work, do what you enjoy. --}}
    <section class="header px-7 pt-10">
        <div
            class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    My Transactions
                </h1>
            </div>        
        </div>
    </section>
    <section class="header px-7 py-10">
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Order ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cover
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="bg-white border-b text-gray-900">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                {{ $transaction->order_id }}
                            </th>
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($transaction->product->image)  }}" alt="{{ $transaction->product->name }}" class="w-30 h-24 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->product->name }}
                            </td>
                            <td class="px-6 py-4">
                                @if($transaction->status === 'success')
                                        <!-- Jika file bukan gambar, tampilkan sebagai link download -->
                                        <a href="{{ $transaction->product->file_product }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" target="_blank">
                                            <i class="fas fa-download mr-2"></i> <!-- Icon download dari Font Awesome -->
                                            Download
                                        </a>
                                @else
                                    <span class="text-gray-500">Pembayaran belum berhasil</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($transaction->created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                @if($transaction->status === 'success')
                                    <span class="bg-green-500 text-white rounded-full px-3 py-1 text-sm">Success</span>
                                @elseif($transaction->status === 'pending')
                                    <span class="bg-red-500 text-white rounded-full px-3 py-1 text-sm">Pending</span>
                                @else
                                    <span class="bg-gray-500 text-white rounded-full px-3 py-1 text-sm">{{ ucwords($transaction->status) }}</span>
                                @endif
                            </td>                                             
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-5">
            {{ $transactions->links() }}
        </div>
    </section>
    
</div>
