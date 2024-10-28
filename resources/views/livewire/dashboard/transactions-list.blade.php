<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="relative overflow-x-auto rounded-lg">
        <h4 class="mb-2 text-lg font-semibold text-gray-900 ">Transactions</h4>
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">Transaction ID</th>
                    <th scope="col" class="px-6 py-3">User Name</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr class="bg-white border-b text-gray-900 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900  whitespace-nowrap">{{ $transaction->id }}</th>
                        <td class="px-6 py-4">{{ $transaction->user->name }}</td>
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
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-50">
                    <td colspan="5" class="px-6 py-4">
                        {{ $transactions->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
