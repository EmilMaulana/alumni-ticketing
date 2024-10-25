<div>
    {{-- Success is as dangerous as failure. --}}
    <section id="checkout" class="container max-w-[1130px] mx-auto my-[120px]">
        <div class="w-full flex justify-center gap-[118px]">
            <div class="product-info flex flex-col gap-4 w-min h-fit mt-[18px]">
                <h1 class="font-semibold text-[32px] ">Checkout Product</h1>
                <div class="product-detail flex flex-col gap-3">
                    <div class="thumbnail w-[412px] h-[255px] flex shrink-0 rounded-[20px] overflow-hidden">
                        <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                    </div>
                    <div class="product-title flex flex-col gap-[30px]">
                        <div class="flex flex-col gap-3">
                            <p class="font-semibold">{{ $product->name }}
                            </p>
                            <p
                                class="bg-[#2A2A2A] font-semibold text-xs text-belibang-grey rounded-[4px] p-[4px_6px] w-fit">
                                {{ ucwords($product->category) }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-12 h-12 rounded-full flex shrink-0 overflow-hidden">
                                    <img src="{{ Storage::url($product->user->profile_photo_path) }}" alt="logo">
                                </div>
                                <p class="font-semibold text-belibang-grey">{{ $product->user->name }}</p>
                            </div>
                            <p
                                class="font-semibold text-4xl bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <form wire:submit.prevent="handlePayment" id="paymentForm"
                class="flex flex-col p-[30px] gap-[60px] rounded-[20px] w-[400px] border-2 border-belibang-darker-grey">
                <div class="w-full flex flex-col gap-4">
                    <p class="font-semibold text-xl">Pembayaran</p>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-1 p-[12px_20px] pl-4 justify-between rounded-lg bg-[#181818] hover:ring-[1px] hover:ring-[#A0A0A0] focus:ring-[1px] focus:ring-[#A0A0A0] transition-all duration-300">
                            <div class="flex flex-col w-full">
                                <label for="customerName" class="text-xs text-belibang-grey pl-1">Nama Lengkap</label>
                                <div class="flex mt-1 items-center max-w-[322px]">
                                    <input type="text" disabled id="customerName" wire:model="customerName"
                                        class="mt-1 font-semibold bg-transparent appearance-none autofull-no-bg outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full"
                                        placeholder="Type here"></input>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 p-[12px_20px] pl-4 justify-between rounded-lg bg-[#181818] hover:ring-[1px] hover:ring-[#A0A0A0] focus:ring-[1px] focus:ring-[#A0A0A0] transition-all duration-300">
                            <div class="flex flex-col w-full">
                                <label for="customerEmail" class="text-xs text-belibang-grey pl-1">Alamat Email</label>
                                <div class="flex mt-1 items-center max-w-[322px]">
                                    <input type="email" disabled id="customerEmail" wire:model="customerEmail"
                                        class="mt-1 font-semibold bg-transparent appearance-none autofull-no-bg outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full"
                                        placeholder="Type here" required></input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-4">
                    <button type="submit" class="rounded-full text-center bg-[#2D68F8] p-[8px_18px] font-semibold hover:bg-[#083297] active:bg-[#062162] transition-all duration-300">Payment Now</button>
                </div>
            </form>
        </div>
    </section>
</div>
<script>
    document.getElementById('paymentForm').onsubmit = async function(event) {
        event.preventDefault();
        
        const response = await @this.handlePayment();
        
        if (response.error) {
            alert(response.error);
            return;
        }
        
        var snapToken = response.snapToken; // Ambil token dari respons
        var orderId = response.orderId;

        // Pastikan Midtrans Snap SDK sudah siap digunakan
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                console.log('Payment successful:', result);
                window.location.href = '/product/checkout/thank-you'; // Halaman sukses
            },
            onPending: function(result) {
                console.log('Payment pending:', result);
                window.location.href = '/pending'; // Halaman pending
            },
            onError: function(result) {
                console.log('Payment error:', result);
                alert('Terjadi kesalahan dalam proses pembayaran. Silakan coba lagi.');
            }
        });
    };
</script>
