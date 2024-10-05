<div>
    {{-- In work, do what you enjoy. --}}
    <section class="header px-7 pt-10">
        <div
            class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    Posts Edit
                </h1>
                {{-- <p class="text-sm text-gray-500">
                    Lorem dolor reporting easier
                </p> --}}
            </div>
            <div class="flex flex-row gap-x-3">
                <a href="{{ route('posts.list') }}"
                    class="md:w-fit w-full text-center px-7 rounded-full text-base py-3 font-semibold text-white bg-violet-700">
                    <i class="fas fa-arrow-left"></i> Back To Posts
                </a>
            </div>
        </div>
    </section>
    <section class="header px-7 pt-10">
        <form method="post" action="{{ route('posts.update', $post->slug) }}" enctype="multipart/form-data">
            @csrf
            <div class="p-4 md:p-5 space-y-4">
                <!-- Category Name -->
                <div>
                    <label for="title" class="block mb-2 font-medium text-gray-900">Post Title</label>
                    <input type="text" id="title" name="title" wire:model="title"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter post title"/>
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="category" class="block mb-2 font-medium text-gray-900">Post Category</label>
                    <select wire:model="category_id" id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                        <option selected="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    @if ($oldImage)
                        <div class="mb-3">
                            <img src="{{ Storage::url($oldImage) }}" alt="Current Image" class="w-80 rounded-lg mb-2">
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="video_url" class="block mb-2 font-medium text-gray-900">YouTube Video URL</label>
                    <input type="text" wire:model="video_url" name="video_url" id="video_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('video_url') }}">
                    @error('video_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Post Image -->
                <div>
                    <label for="image" class="block mb-2 font-medium text-gray-900">Post Image</label>
                    <input wire:model="image" id="image" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none " id="file_input" type="file">
                    <!-- Error handling for image -->
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <!-- Show loading state during file upload -->
                    <div wire:loading wire:target="image" class="text-blue-500 mt-2">
                        Uploading...
                    </div>
                </div>
                <div wire:ignore>
                    <label for="body" class="block mb-2 font-medium text-gray-900">Post Body</label>
                    <textarea wire:model="body" id="body" name="body" rows="10" cols="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('body', $body) }}</textarea>
                    @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="create-modal">
                    Save
                </button>
            </div>
        </form>
    </section>
</div>
