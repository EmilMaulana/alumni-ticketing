@extends('layouts.main')
@section('content')

<header
    class="w-full pt-[94px] pb-[94px] bg-[url('{{asset('images/hero-3.png')}}')] bg-cover bg-no-repeat bg-center relative z-0">
    <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10 px-3">
        <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
            <h1 class="font-semibold text-[45px] leading-[130%]">Selamat datang di website resmi
                 <br>Alumni SMK NEGERI 1 KAWALI.</h1>
        </div>
    </div>
    <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
</header>

<section class="mb-[102px] mt-[80px] max-w-4xl mx-auto px-3">
    @livewire('alumni.front')
</section>

<section id="Tool" class="mb-[102px] flex flex-col gap-8">
    <div class="container max-w-[1130px] mx-auto flex justify-between items-center px-3">
        <h2 class="font-semibold text-[22px]">Kata mereka yang telah lulus dari<br>SMK NEGERI 1 KAWALI</h2>
    </div>
    <div class="tools-logos w-full overflow-hidden flex flex-col gap-5">
        {{-- group slider 1 --}}
        <div class="group/slider flex flex-nowrap w-max items-center">
            <div
                class="logo-container animate-[slide_50s_linear_infinite] group-hover/slider:pause-animate flex gap-5 pl-5 items-center flex-nowrap">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card bg-[#181818] rounded-[20px] flex w-[420px] h-[286px] shrink-0 mb-2 p-4"> <!-- Fixed width for cards -->
                        <div class="p-4 flex flex-col w-full gap-[20px] bg-[url('{{asset('/images/backgrounds/Testimonials-image.png')}}')] bg-contain bg-no-repeat bg-top"> <!-- Background settings -->
                            <div class="flex flex-col gap-4">
                                <div class="flex items-center gap-2">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                </div>
                                <p class="text-sm">{{ $testimonial->body }}</p> <!-- Testimonial body -->
                            </div>
                            <div class="flex gap-[14px] items-center">
                                <div class="w-10 h-10 flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ $testimonial->user->profile_photo_path ? asset('storage/' . $testimonial->user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($testimonial->user->name).'&background=random' }}" 
                                        class="w-full h-full object-cover rounded-full"
                                        alt="photo">
                                </div>  
                                <div class="flex flex-col justify-center">
                                    <p class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">{{ $testimonial->user->name }}</p> <!-- Display user name -->
                                    <p class="font-semibold text-left text-xs text-belibang-grey text-uppercase">{{ ucwords($testimonial->user->occupation) }}</p> <!-- User occupation -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div
                class="logo-container animate-[slide_50s_linear_infinite] group-hover/slider:pause-animate flex gap-5 pl-5 items-center flex-nowrap">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card bg-[#181818] rounded-[20px] flex w-[420px] h-[286px] shrink-0 mb-2 p-4"> <!-- Fixed width for cards -->
                        <div class="p-4 flex flex-col w-full gap-[20px] bg-[url('{{asset('/images/backgrounds/Testimonials-image.png')}}')] bg-contain bg-no-repeat bg-top"> <!-- Background settings -->
                            <div class="flex flex-col gap-4">
                                <div class="flex items-center gap-2">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                    <img src="{{asset('/images/icons/star.svg')}}" alt="star">
                                </div>
                                <p class="text-sm">{{ $testimonial->body }}</p> <!-- Testimonial body -->
                            </div>
                            <div class="flex gap-[14px] items-center">
                                <div class="w-10 h-10 flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ $testimonial->user->profile_photo_path ? asset('storage/' . $testimonial->user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($testimonial->user->name).'&background=random' }}" 
                                        class="w-full h-full object-cover rounded-full"
                                        alt="photo">
                                </div>  
                                <div class="flex flex-col justify-center">
                                    <p class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">{{ $testimonial->user->name }}</p> <!-- Display user name -->
                                    <p class="font-semibold text-left text-xs text-belibang-grey text-uppercase">{{ ucwords($testimonial->user->occupation) }}</p> <!-- User occupation -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto py-12 md:px-8 px-4 xl:px-0 mt-[82px] mb-[100px]">
    <div class="flex flex-col gap-y-7">
        <h1 class="font-semibold text-[35px] leading-[130%]">Frequently Asked Questions</h1>
        <div class="grid lg:grid-cols-2 gap-x-8 gap-y-8">
            <div class="flex-col flex gap-y-8">
                <div class="group faq-card shaynakit-accordion">
                    <div class="bg-white rounded-2xl p-5 flex flex-col gap-y-5">
                        <a href="#" class="btn-accordion">
                            <div class="flex flex-row justify-between">
                                <h3 class="text-indigo-950 font-bold text-lg">
                                    Apa tujuan website alumni K-One ini?
                                </h3>
                                <div
                                    class="bg-white w-[30px] h-[30px] items-center flex justify-center rounded-full">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.44 6.7124L10.55 11.6024C9.9725 12.1799 9.0275 12.1799 8.45 11.6024L3.56 6.7124"
                                            stroke="#080C2E" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                            </div>
                        </a>
                        <div class="accordion-content hidden flex flex-col gap-y-5">
                            <p class="text-base text-gray-500 leading-loose">
                                Website ini bertujuan untuk menghubungkan kembali para alumni K-One, berbagi informasi terkini, serta menjadi ruang untuk kegiatan dan kesempatan berjejaring. Melalui platform ini, alumni bisa terus terhubung dan saling mendukung dalam berbagai kegiatan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="group faq-card shaynakit-accordion">
                    <div class="bg-white rounded-2xl p-5 flex flex-col gap-y-5">
                        <a href="#" class="btn-accordion">
                            <div class="flex flex-row justify-between">
                                <h3 class="text-indigo-950 font-bold text-lg">
                                    Bagaimana cara mendaftar sebagai anggota?
                                </h3>
                                <div
                                    class="bg-white w-[30px] h-[30px] items-center flex justify-center rounded-full">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.44 6.7124L10.55 11.6024C9.9725 12.1799 9.0275 12.1799 8.45 11.6024L3.56 6.7124"
                                            stroke="#080C2E" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                            </div>
                        </a>
                        <div class="accordion-content hidden flex flex-col gap-y-5">
                            <p class="text-base text-gray-500 leading-loose">
                                Untuk bergabung, klik tombol “Gabung Sekarang” di halaman utama. Isi formulir registrasi dengan informasi pribadi Anda, seperti nama, tahun lulus, dan kontak. Setelah itu, ikuti instruksi verifikasi yang dikirimkan ke email Anda.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="group faq-card shaynakit-accordion">
                    <div class="bg-white rounded-2xl p-5 flex flex-col gap-y-5">
                        <a href="#" class="btn-accordion">
                            <div class="flex flex-row justify-between">
                                <h3 class="text-indigo-950 font-bold text-lg">
                                    Apakah semua alumni bisa bergabung?
                                </h3>
                                <div
                                    class="bg-white w-[30px] h-[30px] items-center flex justify-center rounded-full">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.44 6.7124L10.55 11.6024C9.9725 12.1799 9.0275 12.1799 8.45 11.6024L3.56 6.7124"
                                            stroke="#080C2E" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                            </div>
                        </a>

                        <div class="accordion-content hidden flex flex-col gap-y-5">
                            <p class=" text-base text-gray-500 leading-loose">
                                Ya, semua alumni K-One dari berbagai angkatan dipersilakan untuk bergabung. Website ini terbuka untuk siapa pun yang pernah menempuh pendidikan di K-One dan ingin tetap terhubung dengan komunitas.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="flex-col flex gap-y-8">
                <div class="group faq-card shaynakit-accordion">
                    <div class="bg-white rounded-2xl p-5 flex flex-col gap-y-5">
                        <a href="#" class="btn-accordion">
                            <div class="flex flex-row justify-between">
                                <h3 class="text-indigo-950 font-bold text-lg">
                                    Bagaimana cara mengikuti acara atau reuni yang diadakan?
                                </h3>
                                <div
                                    class="bg-white w-[30px] h-[30px] items-center flex justify-center rounded-full">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.44 6.7124L10.55 11.6024C9.9725 12.1799 9.0275 12.1799 8.45 11.6024L3.56 6.7124"
                                            stroke="#080C2E" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                            </div>
                        </a>
                        <div class="accordion-content hidden flex flex-col gap-y-5">
                            <p class=" text-base text-gray-500 leading-loose">
                                Informasi acara dan reuni dapat ditemukan di bagian “Agenda Kegiatan” pada website ini. Setiap acara biasanya dilengkapi dengan detail tanggal, lokasi, dan cara pendaftaran agar Anda bisa mengikuti dengan mudah.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="group faq-card shaynakit-accordion">
                    <div class="bg-white rounded-2xl p-5 flex flex-col gap-y-5">
                        <a href="#" class="btn-accordion">
                            <div class="flex flex-row justify-between">
                                <h3 class="text-indigo-950 font-bold text-lg">
                                    Apakah saya bisa memperbarui informasi profil saya?
                                </h3>
                                <div
                                    class="bg-white w-[30px] h-[30px] items-center flex justify-center rounded-full">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.44 6.7124L10.55 11.6024C9.9725 12.1799 9.0275 12.1799 8.45 11.6024L3.56 6.7124"
                                            stroke="#080C2E" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                            </div>
                        </a>
                        <div class="accordion-content hidden flex flex-col gap-y-5">
                            <p class=" text-base text-gray-500 leading-loose">
                                Tentu. Anda dapat memperbarui informasi profil kapan saja dengan masuk ke akun Anda, kemudian klik “Edit Profil.” Pastikan data selalu terbaru agar mudah dihubungi oleh teman-teman seangkatan.
                            </p>
                        </div>

                    </div>
                </div>
                
            </div>

        </div>
</section>

<script>
        document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua tombol accordion
        const accordionButtons = document.querySelectorAll('.btn-accordion');
    
        // Loop melalui semua tombol accordion dan tambahkan event listener
        accordionButtons.forEach(button => {
            button.addEventListener('click', function (e) {
            // Mencegah perilaku default (misalnya reload halaman saat klik)
            e.preventDefault();
    
            // Ambil elemen konten yang terkait dengan tombol yang diklik
            const accordionContent = this.nextElementSibling;
    
            // Toggle visibilitas konten
            accordionContent.classList.toggle('hidden');
    
            // Ganti icon SVG (rotasi tanda panah)
            const icon = this.querySelector('svg');
            if (accordionContent.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
            });
        });
        });
</script>
  
@endsection

@push('after-script')
<script>
    $('.testi-carousel').flickity({
        // options
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        prevNextButtons: false,
    });

    // previous
    $('.btn-prev').on('click', function () {
        $('.testi-carousel').flickity('previous', true);
    });

    // next
    $('.btn-next').on('click', function () {
        $('.testi-carousel').flickity('next', true);
    });
</script>


@endpush