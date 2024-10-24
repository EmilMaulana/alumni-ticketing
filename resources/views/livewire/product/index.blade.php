<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <section class="header px-7 pt-10">
        <div
            class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    Product
                </h1>
            </div>
            <div class="flex flex-col gap-y-3 gap-x-3 md:flex-row">
                <a href="{{ route('product.list') }}" class="w-full md:w-fit text-center px-7 rounded-full text-base py-3 font-semibold text-indigo-950 bg-white">
                    <i class="fas fa-refresh"></i> Refresh
                </a>
                <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="w-full md:w-fit text-center px-7 rounded-full text-base py-3 font-semibold text-white bg-violet-700" type="button">
                    <i class="fas fa-plus"></i> Add Product
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
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($products->isEmpty())
                        <tr class="bg-white border-b text-gray-900">
                            <td colspan="3" class="px-6 py-4 text-center">
                                Tidak ada data produk.
                            </td>
                        </tr>
                    @else
                        @foreach($products as $product)
                            <tr class="bg-white border-b text-gray-900">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $product->name }}
                                </th>
                                <td class="px-6 py-4">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-40 rounded-lg">
                                </td>                               
                                <td class="px-6 py-4">
                                    @if (in_array(pathinfo(Storage::url($product->file_product), PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <!-- Jika file adalah gambar, tampilkan preview -->
                                        <img src="{{ Storage::url($product->file_product) }}" alt="Preview Image" class="w-32 h-32 object-cover rounded-lg" />
                                    @else
                                        <!-- Jika file bukan gambar, tampilkan sebagai link download -->
                                        <a href="{{ Storage::url($product->file_product) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" target="_blank">
                                            <i class="fas fa-download mr-2"></i> <!-- Icon download dari Font Awesome -->
                                            Download Product
                                        </a>
                                    @endif
                                </td>                               
                                <td class=" px-6 py-4">
                                    <div class="flex justify-center">
                                        <button wire:click="loadProduct({{ $product->id }})" data-modal-target="update-modal" data-modal-toggle="update-modal" class="block m-2 text-white font-medium rounded-full text-sm px-3 py-2 text-center bg-violet-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $product->id }})" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="block m-2 text-white font-medium rounded-full text-sm px-3 py-2 text-center bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>                        
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
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Product
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
                            <input type="file" id="image" wire:model="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
    
                            <!-- Error handling for image -->
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    
                            <!-- Show loading state during file upload -->
                            <div wire:loading wire:target="image" class="text-blue-500 mt-2">
                                Uploading...
                            </div>
                        </div>
                        <div>
                            <label for="file_product" class="block mb-2 font-medium text-gray-900">Product File</label>
                            <input type="file" id="file_product" wire:model="file_product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
    
                            <!-- Error handling for image -->
                            @error('product_file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    
                            <!-- Show loading state during file upload -->
                            <div wire:loading wire:target="product_file" class="text-blue-500 mt-2">
                                Uploading...
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="category" class="block font-medium text-gray-900">
                                Choose a category
                            </label>
                            <select id="category" wire:model="category" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
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
                        <div class="mb-6">
                            <label for="overview" class="block mb-2 font-medium text-gray-900">
                                Product Overview
                            </label>
                            <textarea id="overview" wire:model="overview" rows="10" class="block p-2.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 " placeholder="Write product overview..."></textarea>
                        </div>
                    </div>
    
                    <!-- Modal footer -->
                    <div class="block items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="create-modal">
                            Save
                        </button>
                        <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="create-modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit modal -->
    <div wire:ignore.self id="update-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                            <label for="file_product" class="block mb-2 font-medium text-gray-900">Product File</label>
                            <input type="file" id="file_product" wire:model="file_product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
    
                            <!-- Error handling for image -->
                            @error('product_file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    
                            <!-- Show loading state during file upload -->
                            <div wire:loading wire:target="product_file" class="text-blue-500 mt-2">
                                Uploading...
                            </div>
                        </div>
                        @if ($oldProductFile)
                            <div class="mt-2">
                                @if (in_array(pathinfo(Storage::url($oldProductFile), PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Jika file adalah gambar, tampilkan preview -->
                                    <img src="{{ Storage::url($oldProductFile) }}" alt="Preview Image" class="w-32 h-32 object-cover rounded-lg" />
                                @else
                                    <!-- Jika file bukan gambar, tampilkan sebagai link download -->
                                    <a href="{{ Storage::url($oldProductFile) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" target="_blank">
                                        <i class="fas fa-download mr-2"></i> <!-- Icon download dari Font Awesome -->
                                        Download Product
                                    </a>
                                @endif
                            </div>
                        @endif
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
                        <div class="mb-6">
                            <label for="overview" class="block mb-2 font-medium text-gray-900">Product Overview</label>
                            <textarea id="overview" wire:model="overview" rows="10" class="block p-2.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Write product overview..."></textarea>
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
    <!-- Delete Modal -->
    <div wire:ignore.self id="delete-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Confirm Delete
                    </h3>
                    <button type="button" class="text-gray-400 hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 space-y-4">
                    <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center p-4 border-t border-gray-200 rounded-b">
                    <button wire:click="deleteProduct" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center" data-modal-hide="delete-modal">
                        Delete
                    </button>
                    <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:outline-none" data-modal-hide="delete-modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
