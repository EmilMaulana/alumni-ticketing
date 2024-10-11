<div>
    {{-- In work, do what you enjoy. --}}
    <section class="header px-7 pt-10">
        <div
            class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    My Posts
                </h1>
            </div>
            <div class="flex flex-col gap-y-3 gap-x-3 md:flex-row">
                <a href="{{ route('posts.list') }}" class="w-full md:w-fit text-center px-7 rounded-full text-base py-3 font-semibold text-indigo-950 bg-white">
                    <i class="fas fa-refresh"></i> Refresh
                </a>
                <a href="{{ route('posts.create') }}" class="w-full md:w-fit text-center px-7 rounded-full text-base py-3 font-semibold text-white bg-violet-700" type="button">
                    <i class="fas fa-plus"></i> Add Posts
                </a>
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
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($postss->isEmpty())
                        <td class="pt-3 items-center">
                            <span class="text-indigo-950 text-xl ">No post found.</span> 
                        </td>
                    @else
                        @foreach($postss as $post)
                            <tr class="bg-white border-b text-gray-900">
                                <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                    {{ $post->title }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                    @switch($post->status)
                                        @case('pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-400 text-white">
                                                Pending
                                            </span>
                                            @break
                                        @case('approved')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-600 text-white">
                                                Approved
                                            </span>
                                            @break
                                        @case('rejected')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-700 text-white">
                                                Rejected
                                            </span>
                                            @break
                                        @default
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-700 text-white">
                                                Unknown
                                            </span>
                                    @endswitch
                                </th>
                                <td class="px-6 py-4">
                                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-60 rounded-lg">
                                </td>              
                                <td class="px-6 py-4">
                                    <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0">
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="me-3 text-white bg-violet-700 font-medium rounded-full text-sm px-3 py-2"><i class="fa-solid fa-square-pen"></i></a>
                                        <button data-modal-target="popup-modal-{{ $post->slug }}" data-modal-toggle="popup-modal-{{ $post->slug }}" class="me-3 text-white bg-red-600 font-medium rounded-full text-sm px-3 py-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Konfirmasi Hapus -->
                            <div id="popup-modal-{{ $post->slug }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow ">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $post->slug }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete {{ $post->title }} ?</h3>
                                            <form action="{{ route('posts.delete', $post->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="popup-modal-{{ $post->slug }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                            <button data-modal-hide="popup-modal-{{ $post->slug }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                No, cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
                <div class="dark my-3">
                    {{ $postss->links() }}
                </div>
            </table>
        </div>
    </section>
</div>
