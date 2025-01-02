<div>
    {{-- In work, do what you enjoy. --}}
    
    <h3 class="text-xl font-semibold text-indigo-950 mb-3">
        Statistics
    </h3>
    <div class="grid grid-cols-4 sm:grid-cols-2 xl:grid-cols-4 gap-x-7 mb-5">
        <div class="item-stat bg-white rounded-2xl p-5">
            <div class="flex flex-row mb-7 justify-between">
                <div class="bg-violet-700 rounded-full w-fit p-3">
                    <i class="fa-solid fa-users px-1 py-1 text-white"></i>
                </div>
            </div>
            <h3 class="text-2xl text-indigo-950 font-bold">
                {{ $totalUsers }}
            </h3>
            <p class="text-sm text-gray-500">
                Total Tiket Terjual
            </p>
        </div>
        <div class="item-stat bg-white rounded-2xl p-5">
            <div class="flex flex-row mb-7 justify-between">
                <div class="bg-green-500 rounded-full w-fit p-3">
                    <i class="fa-solid fa-users px-1 py-1 text-white"></i>
                </div>
            </div>
            <h3 class="text-2xl text-indigo-950 font-bold">
                {{ $totalHadir }}
            </h3>
            <p class="text-sm text-gray-500">
                Peserta Hadir
            </p>
        </div>
        <div class="item-stat bg-white rounded-2xl p-5">
            <div class="flex flex-row mb-7 justify-between">
                <div class="bg-red-500 rounded-full w-fit p-3">
                    <i class="fa-solid fa-users px-1 py-1 text-white"></i>
                </div>
            </div>
            <h3 class="text-2xl text-indigo-950 font-bold">
                {{ $tidakHadir }}
            </h3>
            <p class="text-sm text-gray-500">
                Peserta Tidak Hadir
            </p>
        </div>
    </div>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <div class="relative overflow-x-auto rounded-lg">
            <h4 class="mb-4 text-center text-lg font-semibold text-gray-900">DAFTAR KEHADIRAN</h4>
            <div class=" mb-4 px-1 mt-5">
                <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="text-sm w-full md:w-fit text-center px-7 rounded-full py-3 font-semibold text-white bg-violet-700 hover:bg-indigo-700" type="button">
                    <i class="fas fa-qrcode"></i> Scan Barcode
                </button>
                <a href="{{ route('kehadiran.list') }}" class="text-sm w-full md:w-fit text-center px-7 rounded-full py-3 font-semibold text-white bg-green-600 hover:bg-indigo-700"><i class="fas fa-refresh"></i></a>
            </div>
            <div class="grid grid-cols-4 mb-4 px-1">
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
                <!-- Dropdown Filter Jurusan -->
                <select
                    wire:model.live="selectedJurusan"
                    class="ms-2 px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" selected>Semua Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->jurusan }}">{{ $jurusan->jurusan }}</option>
                    @endforeach
                </select>

                <!-- Dropdown Filter Angkatan -->
                <select
                    wire:model.live="selectedAngkatan"
                    class="ms-2 px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" selected>Semua Angkatan</option>
                    @foreach ($angkatans as $angkatan)
                        <option value="{{ $angkatan->angkatan }}">{{ $angkatan->angkatan }}</option>
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
                        <th class="px-6 py-3">Status Pembayaran</th>
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
    <!-- Modal untuk Scan Barcode -->
    <div wire:ignore.self id="create-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-6xl max-h-full overflow-x-auto rounded-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Scan Barcode
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal content (Video stream untuk scan barcode) -->
                <div class="p-4 justify-items-center">
                    <video id="scanner" width="40%" height="auto" 
                        style="transform: scaleX(-1);" 
                        autoplay class="rounded-lg "></video>
                    <p id="result" class="mt-2 text-sm text-gray-600"></p>
                    <div class="flex items-center space-x-4">
                        <button wire:click='refresh' class="text-sm w-full md:w-fit text-center px-7 rounded-full py-3 font-semibold text-white bg-violet-700" type="button">
                            <i class="fas fa-refresh"></i> REFRESH
                        </button>
                        <select id="camera-options" class="block w-full md:w-auto p-2 border rounded-lg">
                            <option value="" disabled selected>Pilih Kamera</option>
                        </select>
                    </div>                    
                </div>
                <!-- Modal content (Tabel data transaksi terkait barcode) -->
                <div class="p-4">
                    @if($isScanned && count($scannedTransactions) > 0)
                        <table class="w-full text-sm text-left text-gray-500 mb-10">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Checklist</th>
                                    <th class="px-6 py-3">Order ID</th>
                                    <th class="px-6 py-3">Agenda</th>
                                    <th class="px-6 py-3">User</th>
                                    <th class="px-6 py-3">Jurusan</th>
                                    <th class="px-6 py-3">Angkatan</th>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($scannedTransactions as $transaction)
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
                                @endforeach
                            </tbody>
                        </table>
                    @elseif($isScanned)
                        <p class="text-center text-gray-500">Update Data Berhasil</p>
                    @else
                        <p class="text-center text-gray-500">Data transaksi tidak ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/jsqr/dist/jsQR.js"></script>
<script>
    const videoElement = document.getElementById('scanner');
    const cameraOptions = document.getElementById('camera-options');

    navigator.mediaDevices.enumerateDevices()
        .then(devices => {
            const videoDevices = devices.filter(device => device.kind === 'videoinput');
            videoDevices.forEach((device, index) => {
                const option = document.createElement('option');
                option.value = device.deviceId;
                option.textContent = device.label || `Kamera ${index + 1}`;
                cameraOptions.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error accessing devices:', error);
        });

    cameraOptions.addEventListener('change', event => {
        const selectedDeviceId = event.target.value;

        navigator.mediaDevices.getUserMedia({
            video: { deviceId: { exact: selectedDeviceId } }
        }).then(stream => {
            videoElement.srcObject = stream;
        }).catch(error => {
            console.error('Error switching camera:', error);
        });
    });
</script>

<script>
    document.addEventListener('livewire:initialized', () => {
        let scanner = {
            video: null,
            stream: null,
            isScanning: false
        };

        const initializeScanner = () => {
            scanner.video = document.getElementById('scanner');
            let result = document.getElementById('result');

            // Mulai stream video dari kamera
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                .then(function (stream) {
                    scanner.stream = stream;
                    scanner.video.srcObject = stream;
                    scanner.video.play();
                    scanner.isScanning = true;
                    startScanning();
                })
                .catch(function (error) {
                    console.error('Kamera tidak ditemukan atau tidak diizinkan: ', error);
                    result.textContent = 'Error: Kamera tidak ditemukan atau tidak diizinkan';
                });
        };

        // Fungsi untuk memindai QR/Barcode secara berkelanjutan
        function startScanning() {
            const scanFrame = () => {
                if (!scanner.isScanning) return;

                if (scanner.video.readyState === scanner.video.HAVE_ENOUGH_DATA) {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.height = scanner.video.videoHeight;
                    canvas.width = scanner.video.videoWidth;
                    ctx.drawImage(scanner.video, 0, 0, canvas.width, canvas.height);
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, canvas.width, canvas.height, {
                        inversionAttempts: "dontInvert",
                    });

                    if (code) {
                        // Tampilkan hasil pemindaian
                        result.textContent = 'Barcode ditemukan: ' + code.data;
                        // Kirim ke Livewire
                        Livewire.dispatch('barcodeScanned', { barcode: code.data });
                        
                        // Tunda pemindaian berikutnya selama 2 detik
                        setTimeout(() => {
                            if (scanner.isScanning) {
                                requestAnimationFrame(scanFrame);
                            }
                        }, 2000);
                    } else {
                        requestAnimationFrame(scanFrame);
                    }
                } else {
                    requestAnimationFrame(scanFrame);
                }
            };

            requestAnimationFrame(scanFrame);
        }

        // Tambahkan tombol untuk membersihkan data pemindaian
        const addClearButton = () => {
            const modalContent = document.querySelector('.modal-content');
            const clearButton = document.createElement('button');
            clearButton.textContent = 'Bersihkan Data';
            clearButton.className = 'px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600';
            clearButton.onclick = () => {
                Livewire.dispatch('clearScannedData');
            };
            modalContent.appendChild(clearButton);
        };

        // Inisialisasi scanner saat modal dibuka
        document.querySelector('[data-modal-target="create-modal"]').addEventListener('click', function() {
            scanner.isScanning = true;
            initializeScanner();
            addClearButton();
        });

        // Bersihkan saat modal ditutup
        document.querySelector('[data-modal-hide="create-modal"]').addEventListener('click', function() {
            if (scanner.stream) {
                scanner.isScanning = false;
                scanner.stream.getTracks().forEach(track => track.stop());
            }
            scanner.video = null;
            scanner.stream = null;
            Livewire.dispatch('closeModal');
        });

        // Handler untuk memastikan modal tetap terbuka setelah pemindaian
        Livewire.on('show-scan-modal', () => {
            const modal = document.getElementById('create-modal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
    });
</script>