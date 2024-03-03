{{-- @extends('layout.master')
@push('cssjsexternal')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('content')
<section class="mt-32">
    <div class="items-center max-w-screen-md mx-auto" id="exploredata">
        <h3 class="text-5xl text-center font-hurricane"></h3>
    </div>
</section>
@endsection

@push('footerjsexternal')
    <script src="/javascript/explore.js"></script>
@endpush --}}

@extends('layout.master')

@push('cssjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@section('content')
<section class="mt-32">
    
    @csrf
    
    <div class=" flex justify-center items-center max-w-screen-md flex-wrap mx-auto" id="exploredata">
                           
    </div>
    
</section>
@endsection

@push('footerjs')
<script src="/javascript/explore.js"></script>
@endpush

{{-- Formulir HTML --}}
{{-- <form>
    <input type="text" id="nama" name="nama">
    <button type="submit">Kirim</button>
</form> --}}


{{-- @extends('layout.master')
@push('cssjsexternal')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
@endpush
@section('content')
<section class="mt-32">
    <div class="items-center max-w-screen-md mx-auto" id="exploredata">
        <h3 class="text-5xl text-center font-hurricane"></h3>
    </div>
</section>
<section class="mt-10">
    <div class="max-w-screen-md mx-auto">
        <div class="flex flex-wrap items-center flex-container">
            <div class="flex mt-2 bg-white">
                <div class="flex flex-col px-2">
                    <a href="explore-detail.html">
                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                            <img src="/assets/bg_01.png" alt="" class="w-full transition duration-500 ease-in-out hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    Kebahagiaan
                                </div>
                                <div class="text-xs text-abuabu">
                                    15w
                                </div>
                            </div>
                        </div>
                        <div>
                        
                            <span class="bi bi-chat-left-text"></span>
                            <small>14</small>
                            <span class="bi bi-heart"></span>
                            <small>40</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex mt-2 bg-white">
                <div class="flex flex-col px-2">
                    <a href="explore-detail.html">
                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                            <img src="/assets/bg_02.png" alt="" class="w-full transition duration-500 ease-in-out hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    Kebahagiaan
                                </div>
                                <div class="text-xs text-abuabu">
                                    15w
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="bi bi-chat-left-text"></span>
                            <small>14</small>
                            <span class="bi bi-heart"></span>
                            <small>40</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex mt-2 bg-white">
                <div class="flex flex-col px-2">
                    <a href="explore-detail.html">
                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                            <img src="/assets/bg_04.png" alt="" class="w-full transition duration-500 ease-in-out hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    Kebahagiaan
                                </div>
                                <div class="text-xs text-abuabu">
                                    15w
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="bi bi-chat-left-text"></span>
                            <small>14</small>
                            <span class="bi bi-heart"></span>
                            <small>40</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex mt-2 bg-white">
                <div class="flex flex-col px-2">
                    <a href="explore-detail.html">
                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                            <img src="/assets/bg_01.png" alt="" class="w-full transition duration-500 ease-in-out hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    Kebahagiaan
                                </div>
                                <div class="text-xs text-abuabu">
                                    15w
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="bi bi-chat-left-text"></span>
                            <small>14</small>
                            <span class="bi bi-heart"></span>
                            <small>40</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
@endsection
@push('footerjsexternal')
    <script src="/javascript/explore.js"></script>
@endpush --}}