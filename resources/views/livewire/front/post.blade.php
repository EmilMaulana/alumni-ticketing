<div>
    <section id="DetailsContent" class="max-w-[1130px] mx-auto mb-[32px] pt-[40px] relative -top-[70px] px-2">
        <div class="flex flex-col gap-5">
            <div class="flex flex-col md:flex-row gap-8 relative -mt-[93px]">
                <!-- Main Content -->
                <div class="flex flex-col p-[30px] gap-5 bg-[#181818] rounded-[10px] shadow-md w-full md:w-[70%] shrink-0 mt-[90px] h-fit">
                    @if ($post->video_url)
                        <div class="flex shrink-0 rounded-lg shadow-md overflow-hidden">
                            <div class="relative w-full" style="padding-top: 56.25%;">
                                @auth
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $post->video_url }}?enablejsapi=1" 
                                        allow="encrypted-media" 
                                        class="absolute top-0 left-0 w-full h-full rounded-lg" 
                                        style="border: 0;" 
                                        allowfullscreen>
                                    </iframe>
                                @else
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $post->video_url }}?autoplay=0" 
                                        allow="encrypted-media" 
                                        class="absolute top-0 left-0 w-full h-full rounded-lg" 
                                        style="border: 0;" 
                                        allowfullscreen>
                                    </iframe>
                                    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-80">
                                        <p class="text-white text-center">
                                            Untuk melanjutkan pemutaran video, silakan 
                                            <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> terlebih dahulu.
                                        </p>
                                    </div>
                                @endauth
                            </div>                            
                        </div>
                    @else
                        <div class="w-full flex shrink-0 rounded-[10px] shadow-md overflow-hidden">
                            <img src="{{Storage::url($post->image)}}" class="object-cover w-full" alt="hero image">
                        </div>
                    @endif
                    <div class="">
                        <span class="bg-blue-900 text-white text-xs font-medium me-2 px-3 py-1 rounded">{{ $post->category->name }}</span>
                        <span class="text-sm"><i class="fas fa-eye"></i> {{ $post->views }} Views</span>
                        <span class="text-sm ms-2"><i class="fas fa-clock"></i> {{ $post->created_at->isoFormat('D MMMM Y') }}</span>
                    </div>
                    <h1 class="font-semibold text-[25px]">
                        {{$post->title}}
                    </h1>
                    <div class="flex flex-col gap-4 prose">
                        <article class="text-gray-200">{!! $post->body !!}</article>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="w-full md:w-[30%] mt-[20px] md:mt-[90px] flex flex-col sticky top-[90px] gap-4 h-fit">
                    <!-- Elemen pertama -->
                    <div class="card bg-[#181818] rounded-[20px] p-[30px] ">
                        <h4 class="font-semibold pb-2">Author</h4>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-3 items-center">
                                <div class="w-12 h-12 flex shrink-0 rounded-full">
                                    <img src="{{Storage::url($post->user->profile_photo_path)}}" alt="icon" class="w-full h-full object-cover rounded-full">
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-semibold">{{ $post->user->name }}</p>
                                    <p class="text-[#595959] text-sm leading-[18px]">
                                        <span class="font-semibold mr-1">{{ $postCount }}</span>
                                        Postingan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-justify leading-[24px] text-belibang-grey pt-2">{{ $post->user->about_me }}</p>
                    </div>
                
                    <!-- Elemen kedua -->
                    <div class="card bg-[#181818] rounded-[20px] p-[30px]">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-3 items-center">
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-semibold">Postingan Terkait</p>
                                    @foreach($relatedPosts as $relatedPost)
                                        <div class="my-2">
                                            <a href="{{ route('front.post', $relatedPost->slug) }}" class="hover:underline hover:text-violet-300">
                                                <img src="{{Storage::url($relatedPost->image)}}" class="object-cover w-full rounded-md mb-2" alt="hero image">
                                                {{ $relatedPost->title }}
                                            </a>
                                            <hr class="mt-2">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- <p class="text-sm leading-[24px] text-belibang-grey">A young UI/UX Designer from Indonesia. Specialized in mobile apps designs & loves creating UI Kit 🇮🇩</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>