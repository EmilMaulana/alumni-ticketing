<div>
    <section id="checkout" class="container max-w-[1130px] mx-auto my-[120px] px-4">
        <div class="w-full flex flex-col lg:flex-row justify-center gap-[30px]">
            <div class="product-info flex flex-col gap-4 w-full lg:w-[400px] h-fit mt-[18px]">
                <h1 class="font-semibold text-[32px] text-center lg:text-left">Checkout Tiket</h1>
                <div class="product-detail flex flex-col gap-3">
                    <div class="thumbnail w-full flex shrink-0 rounded-[20px] overflow-hidden">
                        <img src="{{ Storage::url($product->image) }}" class="h-[230px] object-cover " alt="thumbnail">
                    </div>
                    <div class="product-title flex flex-col gap-[30px]">
                        <div class="flex flex-col gap-3">
                            <p class="font-semibold text-center lg:text-left">{{ $product->name }}</p>
                            <p class="bg-[#2A2A2A] font-semibold text-xs text-belibang-grey rounded-[4px] p-[4px_6px] w-fit self-center lg:self-start">
                                {{ ucwords($product->category) }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-12 h-12 rounded-full flex shrink-0 overflow-hidden">
                                    <img src="{{ Storage::url($product->user->profile_photo_path) }}" alt="logo">
                                </div>
                                <p class="font-semibold text-belibang-grey">{{ $product->user->name }}</p>
                            </div>
                            <p class="font-semibold text-4xl bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <form class="flex flex-col p-[30px] gap-[30px] rounded-[20px] w-full lg:w-[400px] border-2 border-belibang-darker-grey">
                <div class="w-full flex flex-col gap-4">
                    <p class="font-semibold text-xl text-center lg:text-left">Pembayaran</p>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-1 p-[12px_20px] pl-4 justify-between rounded-lg bg-[#181818] hover:ring-[1px] hover:ring-[#A0A0A0] focus:ring-[1px] focus:ring-[#A0A0A0] transition-all duration-300">
                            <div class="flex flex-col w-full">
                                <label for="customerName" class="text-xs text-belibang-grey pl-1">Nama Lengkap</label>
                                <div class="flex mt-1 items-center">
                                    <input type="text" disabled id="customerName" wire:model="customerName"
                                        class="mt-1 font-semibold bg-transparent appearance-none autofull-no-bg outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full"
                                        placeholder="Type here">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 p-[12px_20px] pl-4 justify-between rounded-lg bg-[#181818] hover:ring-[1px] hover:ring-[#A0A0A0] focus:ring-[1px] focus:ring-[#A0A0A0] transition-all duration-300">
                            <div class="flex flex-col w-full">
                                <label for="customerEmail" class="text-xs text-belibang-grey pl-1">Alamat Email</label>
                                <div class="flex mt-1 items-center">
                                    <input type="email" disabled id="customerEmail" wire:model="customerEmail"
                                        class="mt-1 font-semibold bg-transparent appearance-none autofull-no-bg outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full"
                                        placeholder="Type here" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 p-[12px_20px] pl-4 justify-between rounded-lg bg-[#181818] hover:ring-[1px] hover:ring-[#A0A0A0] focus:ring-[1px] focus:ring-[#A0A0A0] transition-all duration-300">  
                            <div class="flex flex-col w-full">  
                                <label for="size" class="text-xs text-belibang-grey pl-1">Ukuran Kaos</label>  
                                <div class="flex mt-1 items-center">  
                                    <select id="size" wire:model="size" class="mt-1 font-semibold bg-transparent outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full" required>  
                                        <option value="" disabled selected>Pilih Ukuran</option>  
                                        <option value="S">S (Small)</option>  
                                        <option value="M">M (Medium)</option>  
                                        <option value="L">L (Large)</option>  
                                        <option value="XL">XL (Extra Large)</option>  
                                        <option value="XXL">XXL (Double Extra Large)</option>  
                                    </select>  
                                </div>  
                            </div>  
                        </div>                          
                        <div class="flex items-center gap-1 p-[12px_20px] pl-4 justify-between rounded-lg bg-[#181818] hover:ring-[1px] hover:ring-[#A0A0A0] focus:ring-[1px] focus:ring-[#A0A0A0] transition-all duration-300">  
                            <div class="flex flex-col w-full">  
                                <label for="shipping_method" class="text-xs text-belibang-grey pl-1">Pilih Metode Pengiriman</label>  
                                <select id="shipping_method" class="mt-1 bg-transparent outline-none px-1" onchange="toggleAlamatInput()">  
                                    <option value="diambil">Diambil</option>  
                                    <option value="diantar">Diantar</option>  
                                </select>  
                                <div id="alamat-input" class="hidden flex mt-1 items-center">  
                                    <label for="shipping_address" class="text-xs text-belibang-grey pl-1">Alamat Pengiriman Kaos</label>  
                                    <input type="text" id="shipping_address" wire:model="shipping_address"  
                                        class="mt-1 font-semibold bg-transparent appearance-none autofull-no-bg outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full"  
                                        placeholder="Type here" required>  
                                </div>  
                            </div>  
                        </div>  
                    </div>
                </div>
            
                <!-- Bagian Total Pembayaran dengan Service Fee -->
                <div class="w-full flex flex-col gap-4">
                    <div class="flex justify-between items-center p-[12px_20px] rounded-lg bg-[#181818] text-white">
                        <span class="text-sm font-semibold">Subtotal</span>
                        <span class="text-lg font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center p-[12px_20px] rounded-lg bg-[#181818] text-white">
                        <span class="text-sm font-semibold">Service Fee</span>
                        <span class="text-lg font-bold">Rp {{ number_format(1900, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center p-[12px_20px] rounded-lg bg-[#181818] text-white">
                        <span class="text-sm font-semibold">Total Pembayaran</span>
                        <span class="text-lg font-bold">Rp {{ number_format($product->price + 1900, 0, ',', '.') }}</span>
                    </div>
                </div>
            
                <div class="w-full flex flex-col gap-4">
                    @if($snapToken)
                        <button type="button" onclick="handlePayment()" 
                            class="rounded-full text-center bg-[#2D68F8] p-[8px_18px] font-semibold hover:bg-[#083297] active:bg-[#062162] transition-all duration-300">
                            Payment Now
                        </button>
                    @else
                        <div class="text-red-500 text-center">
                            Terjadi kesalahan dalam mempersiapkan pembayaran. Silakan coba lagi.
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    function handlePayment() {
        var snapToken = '{{ $snapToken }}'; // Ambil token dari controller
        if (!snapToken) {
            alert('Snap Token tidak tersedia. Mohon periksa kembali.');
            return;
        }

        // Redirect pengguna ke halaman pembayaran Midtrans
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                console.log('Payment successful:', result);

                // Kirim hasil pembayaran ke Livewire untuk diproses
                @this.call('handlePaymentResponse', result)
                    .then(() => {
                        // Redirect ke halaman sukses setelah update status
                        window.location.href = `/agenda/checkout/thank-you/${result.order_id}`;
                    })
                    .catch((error) => {
                        console.error('Error updating transaction status:', error);
                    });
            },
            onPending: function(result) {
                console.log('Payment pending:', result);

                // Kirim hasil pembayaran ke Livewire untuk diproses
                @this.call('handlePaymentResponse', result)
                    .then(() => {
                        // Redirect ke halaman pending setelah update status
                        window.location.href = `/agenda`;
                    })
                    .catch((error) => {
                        console.error('Error updating transaction status:', error);
                    });
            },
            onError: function(result) {
                console.log('Payment error:', result);
                alert('Terjadi kesalahan dalam proses pembayaran. Silakan coba lagi.');
            }
        });
    }
</script>
<script>  
    function toggleAlamatInput() {  
        const pengirimanSelect = document.getElementById('shipping_method');  
        const alamatInput = document.getElementById('alamat-input');  
        if (pengirimanSelect.value === 'diantar') {  
            alamatInput.classList.remove('hidden');  
        } else {  
            alamatInput.classList.add('hidden');  
        }  
    }  
</script>  

