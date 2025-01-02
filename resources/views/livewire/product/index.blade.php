<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <section class="header px-7 pt-10">
        <div
            class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    Agenda
                </h1>
            </div>
            <div class="flex flex-col gap-y-3 gap-x-3 md:flex-row">
                <a href="{{ route('product.list') }}" class="w-full md:w-fit text-center px-7 rounded-full text-base py-3 font-semibold text-indigo-950 bg-white">
                    <i class="fas fa-refresh"></i> Refresh
                </a>
                <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="w-full md:w-fit text-center px-7 rounded-full text-base py-3 font-semibold text-white bg-violet-700" type="button">
                    <i class="fas fa-plus"></i> Tambah Agenda
                </button>
            </div>  
        </div>
    </section>
    <section class="header px-7 py-10">
        @if (session()->has('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Success</span>
                <div>
                    <span class="font-medium">Success!</span> {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Agenda
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Agenda Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($products->isEmpty())
                        <tr class="bg-white border-b text-gray-900">
                            <td colspan="4" class="px-6 py-4 text-center">
                                Tidak ada data agenda.
                            </td>
                        </tr>
                    @else
                        @foreach($products as $product)
                            <tr class="bg-white border-b text-gray-900">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $product->name }}
                                </th>
                                <td class="px-6 py-4">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-60 rounded-lg object-cover">
                                </td>                               
                                <td class="px-6 py-4">
                                    {!! $product->overview !!}
                                </td>                               
                                <td class=" px-6 py-4">
                                    <div class="flex justify-center">
                                        <button wire:click="loadProduct({{ $product->id }})" data-modal-target="update-modal" data-modal-toggle="update-modal" class="block m-2 text-white font-medium rounded-full text-sm px-3 py-2 text-center bg-violet-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!--<button wire:click="confirmDelete({{ $product->id }})" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="block m-2 text-white font-medium rounded-full text-sm px-3 py-2 text-center bg-red-700">-->
                                        <!--    <i class="fas fa-trash"></i>-->
                                        <!--</button>                        -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <div class="dark my-3">
                    {{ $products->links() }}
                </div>
            </table>
        </div>
    </section>
    <!-- Create modal -->
    <div wire:ignore.self id="create-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Tambah Agenda
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
    
                <!-- Modal body -->
                <form wire:submit.prevent="store">
                    <div class="p-4 md:p-5 space-y-4">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block mb-2 font-medium text-gray-900">Nama Agenda</label>
                            <input type="text" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter agenda name" required />
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                
                        <!-- Product Image -->
                        <div>
                            <label for="image" class="block mb-2 font-medium text-gray-900">Image</label>
                            <input type="file" id="image" wire:model="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="image" class="text-blue-500 mt-2">Uploading...</div>
                        </div>
                
                        <!-- Product Category -->
                        <div class="mb-6">
                            <label for="category" class="block font-medium text-gray-900">Choose a category</label>
                            <select id="category" wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Choose category</option>
                                <option value="Reguler">Reguler</option>
                                <option value="Pre-Sale 1">Pre-Sale 1</option>
                                <option value="Pre-Sale 2">Program Sederhana</option>
                                <option value="VVIP">VVIP</option>
                            </select>
                            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- <!-- Product Category -->
                        <div class="mb-6">
                            <label for="status" class="block font-medium text-gray-900">Status</label>
                            <select id="status" wire:model="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Choose Status</option>
                                <option value="Dibuka">Dibuka</option>
                                <option value="Ditutup">Ditutup</option>
                            </select>
                            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div> --}}
                
                        <!-- Product Price -->
                        <div>
                            <label for="price" class="block mb-2 font-medium text-gray-900">Price (Rp.)</label>
                            <input type="number" id="price" wire:model="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter agenda price" required />
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                
                        <!-- Product Overview -->
                        <div wire:ignore>
                            <label for="overview" class="mb-6">Deskripsi</label>
                            <input id="overview" type="hidden" wire:model="overview">
                            <trix-editor input="overview" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></trix-editor>
                            @error('overview') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit modal -->
    <div wire:ignore.self id="update-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Update Product
                    </h3>
                    <button type="button" wire:click="resetForm()" data-modal-hide="update-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="p-4 md:p-5 space-y-4">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block mb-2 font-medium text-gray-900">Product Name</label>
                            <input type="text" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter product name" required />
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Product Image -->
                        <div>
                            <label for="image" class="block mb-2 font-medium text-gray-900">Product Image</label>
                            <input type="file" id="image" wire:model="newImage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <div wire:loading wire:target="image" class="text-blue-500 mt-2">
                                Uploading...
                            </div>
                            @if ($oldImage)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($oldImage) }}" alt="Preview Image" class="w-32 h-32 object-cover rounded-lg" />
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="file_product" class="block mb-2 font-medium text-gray-900">Product Link</label>
                            <input type="text" id="file_product" wire:model="file_product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter product name" required />
                            @error('file_product') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Category -->
                        <div class="mb-6">
                            <label for="category" class="block font-medium text-gray-900">Choose a category</label>
                            <select id="category" wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose category</option>
                                <option value="website">Website</option>
                                <option value="aplikasi sederhana">Aplikasi Sederhana</option>
                                <option value="program sederhana">Program Sederhana</option>
                                <option value="data science">Data Science</option>
                            </select>
                        </div>

                        <!-- Product Price -->
                        <div>
                            <label for="price" class="block mb-2 font-medium text-gray-900">Price (Rp.)</label>
                            <input type="text" id="price" wire:model="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter product price" required />
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Product Overview -->
                        <div wire:ignore>
                            <label for="overview" class="mb-6">Product Overview</label>
                            <input id="overview" type="hidden" wire:model="overview">
                            <trix-editor input="overview" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></trix-editor>
                            @error('overview') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="update-modal">
                            Save
                        </button>
                        <button type="button" wire:click="resetForm()" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="update-modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // document.addEventListener("livewire:load", () => {
    //     // Watch for modal open event to set Trix Editor content
    //     Livewire.hook('message.processed', (message, component) => {
    //         if (component.fingerprint.name === 'product.index') { // Gunakan nama lengkap komponen
    //             const trixInput = document.querySelector('#overview');
    //             const editor = document.querySelector('trix-editor');

    //             if (trixInput && editor) {
    //                 // Set nilai dari Livewire ke hidden input dan editor Trix
    //                 trixInput.value = @this.get('overview');
    //                 editor.editor.loadHTML(trixInput.value);
    //             }
    //         }
    //     });
    // });

    // // Update Livewire overview value when Trix Editor content changes
    // document.addEventListener('trix-change', function(event) {
    //     @this.set('overview', event.target.innerHTML);
    // });

    document.addEventListener("livewire:load", () => {
        // Watch for modal open event to set Trix Editor content
        Livewire.hook('message.processed', (message, component) => {
            if (component.fingerprint.name === 'product.index') { // Gunakan nama lengkap komponen
                const trixInput = document.querySelector('#overview');
                const editor = document.querySelector('trix-editor');

                if (trixInput && editor) {
                    // Set nilai dari Livewire ke hidden input dan editor Trix
                    trixInput.value = @this.get('overview');
                    editor.editor.loadHTML(trixInput.value);
                }
            }
        });
    });

    // Update Livewire overview value when Trix Editor content changes
    document.addEventListener('trix-change', function(event) {
        @this.set('overview', event.target.innerHTML);
    });
</script>
