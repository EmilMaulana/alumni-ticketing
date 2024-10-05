<div>
    <section class="header px-7 py-10">
        <p>Total User: {{ $userCount }}</p>
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Profile
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="bg-white border-b text-gray-900">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>                               
                            <td class="px-6 py-4">
                                @if ($user->profile_photo_path)
                                    <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-40 rounded-full">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}" class="rounded-full h-10">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="dark my-3">
                    {{ $users->links() }}
                </div>
            </table>
        </div>
    </section>
    <section class="header px-7 py-10">
        <p>Total Artikel: {{ $postCount }}</p> <!-- Menampilkan jumlah postingan -->
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Author
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="bg-white border-b text-gray-900">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                {{ $post->user->name }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                {{ $post->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $post->category->name }}
                            </td>                               
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-40 rounded-lg">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="dark my-3">
                    {{ $posts->links() }}
                </div>
            </table>
        </div>
    </section>
    
</div>
