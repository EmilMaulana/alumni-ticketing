<div>
    <section class="header px-7 pt-10">
        <div class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    Custom Products
                </h1>
            </div>        
        </div>
    </section>
    <section class="px-7">
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">NO</th>
                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">No WhatsApp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customProducts as $index => $product)
                        <tr class="bg-white border-b text-gray-900">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $index + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $product->deskripsi }}
                            </td>
                            <td class="px-6 py-4">
                                @if($product->status === 'completed')
                                    <span class="bg-green-500 text-white rounded-full px-3 py-1 text-sm">Completed</span>
                                @elseif($product->status === 'pending')
                                    <span class="bg-yellow-500 text-white rounded-full px-3 py-1 text-sm">Pending</span>
                                @else
                                    <span class="bg-red-700 text-white rounded-full px-3 py-1 text-sm">{{ ucfirst($product->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="https://wa.me/62{{ ltrim($product->nomor_wa, '0') }}?text={{ urlencode("Halo, saya admin. Kami telah menerima custom product yang Anda minta dengan deskripsi: {$product->deskripsi}") }}"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    {{ $product->nomor_wa }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-5">
            {{ $customProducts->links() }}
        </div>
    </section>
</div>
