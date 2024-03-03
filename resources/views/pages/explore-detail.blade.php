@extends('layout.master')
@push('cssjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('content')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center"></h3>
        </div>
    </section>
    <section class="mt-10">
        <div class="max-w-screen-md mx-auto">
            <div class="flex flex-wrap px-2 flex-container">
                <div class="w-3/5 max-[480px]:w-full">
                    <div class="flex justify-center overflow-hidden">
                        <img src="" alt=""
                            class="w-full h-auto max-w-xl px-2 transition duration-500 ease-in-out hover:scale-105" id="fotodetail">
                    </div>
                </div>
                <div class="w-2/5  max-[480px]:w-full">
                    <div class="flex flex-wrap items-center justify-between ">
                        <div class="flex flex-row items-center gap-2">
                            <div>
                                <img src=""  alt="" class="w-14 h-14 rounded-full" id="profile">
                            </div>
                            
                            <div class="flex flex-col">
                                <a href="other-pin.html" class="text-md" id="username"></a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="mt-2" id="judul"></span>
                        <span class="mt-2" id="deskripsi"></span>
                        {{-- <span class="-mt-1 text-gray-400">1h</span> --}}
                    </div>
                    {{-- <div class="mt-2">
                        <span class="bi bi-heart"></span>
                     <span>12321</span>
                     <span class="bi bi-chat-left-text"></span>
                     <span>4</span>
                    </div> --}}

                    <!-- komen -->
                    <div class="mt-6">
                        
                    </div>
                    <hr class="bg-gray-700 w-full">
                    <div class="relative flex flex-col overflow-y-auto h-[200px] scrollbar-hidden" id="listkomentar">
                        <div class="flex flex-row justify-start mt-4" id="listkomentar">
                            {{-- <div class="w-1/4">
                                <img src="/assets/users.png" class="w-8 h-auto" alt="">
                            </div>
                            <div class="flex flex-col mr-2">
                                <h5 class="text-sm">Atas</h5>
                                <small class="text-xs text-abuabu">Bawah</small>
                            </div>
                            <h5 class="text-sm">Fotonya sangat Bagus Sekali, apakah saya bisa memintanya</h5> --}}
                        </div>
                    </div>
                    <hr class="bg-gray-700 w-full">
                    <div class="flex gap-2 mt-2">
                        @csrf
                        <div class="w-3/4">
                            <input type="text" name="isikomentar" id="" class="w-full px-2 py-1  border-slate-500">
                        </div>
                        <button type="submit" onclick="kirimkomentar()" class="px-4  bg-green-700"><span class="text-white bi bi-send"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @push('footerjs')
<script src="/javascript/detailcomment.js"></script>
@endpush