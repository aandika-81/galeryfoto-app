@extends('layout.master')

@push('cssjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
<section class="mt-10 flex justify-center">
    <div class="max-w-screen-md grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
        @foreach ($album->foto as $foto)
        <div class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <img class="w-full h-auto" src="/unggah/{{ $foto->lokasi_foto }}" alt="{{ $foto->deskripsi }}">
            <div class="p-4">
                <h2 class="text-lg font-semibold">{{ $foto->judul_foto }}</h2>
                <p class="text-sm text-gray-700">{{ $foto->deskripsi }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@push('footerjs')
<script src="/javascript/explore.js"></script>
@endpush
