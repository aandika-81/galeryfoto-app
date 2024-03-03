
@extends('layout.master')
@section('content')
    <section class="mt-6">
    </section>
    <section>
        <div class="pt-[70px] pl-[20px] flex flex-row sm:pl-[277px]">
            <img src="/profile/{{Auth::user()->foto_profile }}"  alt="" class="w-14 h-14 rounded-full">
            <div class="ml-2 flex flex-col">
                <span class="font-itali text-2xl mt-1">{{ $dataprofile->username }}</span>
                <span class="text-xs">{{ $dataprofile->nama_lengkap }}</span>
            </div>
        </div>
        <div class="pl-[20px] mt-1 sm:pl-[277px]">
            <span class="text-xs">{{ $dataprofile->bio }}</span>
        </div>
        <div class="flex ml-[20px] mt-4 sm:pl-[250px]">
            <button data-modal-target="edit_profile" data-modal-toggle="edit_profile" class="bg-white border border-gray-300 focus:outline-none font-medium rounded-lg text-xs px-3 py-1 me-1 mb-2">edit profile</a>
        </a>
        <button data-modal-target="edit_password" data-modal-toggle="edit_password" class="bg-white border border-gray-300 focus:outline-none font-medium rounded-lg text-xs px-3 py-1 me-2 mb-2">
                edit password</a>
        </div>
    </section>

    {{-- tabs menu --}}
    <section class="mt-10">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700 mx-4 -sm:pl-[40px]">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-between lg:justify-normal md:justify-normal sm:pl-[260px] sm:justify-normal"
                id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="unggahan-tab" data-tabs-target="#unggahan"
                        type="button" role="tab" aria-controls="unggahan" aria-selected="false">Unggahan</button>
                </li>
                <li class="" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="album-tab" data-tabs-target="#album" type="button" role="tab" aria-controls="album"
                        aria-selected="false">Album</button>
                </li>
            </ul>
            <div id="default-tab-content">
                <!-- unggahan -->
                <div class="hidden p-4 rounded-lg bg-gray-50 mb-14" id="unggahan" role="tabpanel" aria-labelledby="unggahan-tab">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:pl-[260px] sm:pl-[260px]">
                        
                        @foreach ($tampilUpload as $foto)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="flex justify-center">
                                <img src="/unggah/{{ $foto->lokasi_foto }}" class="w-full h-auto max-w-full rounded-t-lg" alt="{{ $foto->judul_foto }}">
                            </div>
                            <div class="p-4">
                                <h2 class="text-lg font-semibold">{{ $foto->judul_foto }}</h2>
                                <p class="text-sm text-gray-700">{{ $foto->deskripsi }}</p>
                                <p class="text-sm text-gray-700">{{ $foto->created_at->format('d/m/Y H:i') }}</p>

                                {{-- HAPUS FOTO --}}
                                <style>
                                    .btn-bi-trash {
    position: relative;
}

.btn-bi-trash .bi-trash {
    font-size: 40px; /* Atur ukuran ikon sesuai kebutuhan */
    position: absolute;
    left: 200px; /* Sesuaikan jarak ikon dari kiri */
    top: 50%;
    transform: translateY(-130%);
}

                                </style>
                             <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-bi-trash" type="button" onclick="confirmDelete()">
                                    <span class="bi bi-trash"></span>
                                </button>
                            </form>
                            
                            <script>
                                function confirmDelete() {
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Anda tidak dapat mengembalikan ini!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, hapus!',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('deleteForm').submit();
                                        }
                                    });
                                }
                            </script>
                            
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Album -->
                <div class="hidden p-4 rounded-lg mb-14" id="album" role="tabpanel" aria-labelledby="album-tab">
                    <div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-4 lg:grid-cols-6 gap-3 md:pl-[260px] sm:pl-[260px]">

                        @foreach ($tampilAlbum as $album)
                        <a href="{{ route('album.show', $album->id) }}" class="text-center block">
                            <!-- Tampilkan informasi album, misalnya judul album -->
                          
                            <div class="bg-green-200 min-h-[200px] p-10 shadow-xl relative">
                                <img src="{{ asset('assets/FOLDER1.png') }}" class="mx-auto" alt="Album Cover">
                            </div>
                            <h3 class="text-gray-900 font-bold text-lg mb-2">{{ $album->nama_album }}</h3>
                        </a>
                    @endforeach
                    
                </div>
                
              
            </div>
        </div>
    </section>
 


{{-- edit profil modal --}}

    <!-- Edit Profile Modal -->
    <div id="edit_profile" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex md:p-5 dark:border-gray-600">
                    <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 inline-flex " data-modal-toggle="edit_profile">
                        <ion-icon name="arrow-back-outline" class="text-xl pl-4 pt-3"></ion-icon>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="/update_profile" class="p-4 md:p-5 grid md:grid-cols-2 md:gap-4" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class="flex flex-col items-center md:items-start p-4">
                            <img src="/profile/{{ Auth::user()->foto_profile }}" alt="" class="rounded-full w-36 h-36">
    
                            <input type="file" name="profile" class="w-48 h-10 mt-4 border rounded-md">
                            <button class="w-48 py-1 mt-4 text-white rounded-md bg-green-700">Ubah Foto</button>
                        </div>
                    </div>
                    
                    <div class="">
                        <div class="flex flex-col p-4">
                            <h5 class="text-3xl text-center">Your Profile</h5>
                            <h5>Nama Lengkap</h5>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="py-1 rounded-md" required="" value={{ $dataprofile->nama_lengkap }}>
                            <h5>No Telepon</h5>
                            <input type="number" name="no_telepon" id="no_telepon" class="py-1 rounded-md" required="" value="{{ $dataprofile->no_telepon }}">
                            <h5>Alamat</h5>
                            <textarea name="alamat" id="alamat" class="py-1 rounded-md" required="">{{ $dataprofile->alamat }}</textarea>
                            <h5>Bio</h5>
                            <textarea name="bio" id="bio" class="py-1 rounded-md" required="">{{ $dataprofile->bio }}</textarea>
                            <button type="submit" class="py-2 mt-4 text-white rounded-md bg-green-700">Perbaharui</button>
                        </div>
                    </div>
                    <div class="p-2"></div>
                </form>
            </div>
        </div>
    </div>
    


      <!-- Edit Password Modal -->
      <div id="edit_password" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-y-auto md:inset-0 max-h-full">
        <div class="relative w-full max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex md:p-5 dark:border-gray-600">
                    <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 inline-flex" data-modal-toggle="edit_password">
                        <ion-icon name="arrow-back-outline" class="text-xl pl-4 pt-3"></ion-icon>
                    </button>
                    <h3 class="text-3xl font-medium pt-6 mx-auto font-italic">
                        Change Your Password
                    </h3>
                </div>
                <form action="/update_password" method="post">
                    @csrf
                    <div class="p-4 md:p-5 space-y-2">
                        <div class="col-span-2">
                            <label for="current_password" class="block mb-1 text-xs font-medium">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-4 placeholder:text-xs" placeholder="Enter your current password" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="new_password" class="block mb-1 text-xs font-medium">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-4 placeholder:text-xs" placeholder="Enter your new password" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="new_password_confirmation" class="block mb-1 text-xs font-medium">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-4 placeholder:text-xs" placeholder="Confirm your new password" required="">
                        </div>
                        <div>
                            <button type="submit" class="text-black inline-flex items-center bg-white border font-medium rounded-lg text-sm px-5 py-2.5 text-center placeholder:text-xs">
                                <ion-icon name="add-outline"></ion-icon>
                                <span>Update</span>
                            </button>
                        </div>
                    </div>
                </form>
                
                {{-- <form action="/update_password" method="post">
                    @csrf
                    <div class="p-4 md:p-5 space-y-2">
                        <div class="col-span-2">
                            <label for="current_password" class="block mb-1 text-xs font-medium">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-4 placeholder:text-xs" placeholder="Enter your current password" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="password" class="block mb-1 text-xs font-medium">New Password</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-4 placeholder:text-xs" placeholder="Enter your new password" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="password_confirmation" class="block mb-1 text-xs font-medium">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-4 placeholder:text-xs" placeholder="Confirm your new password" required="">
                        </div>
                        <div>
                            <button type="submit" class="text-black inline-flex items-center bg-white border font-medium rounded-lg text-sm px-5 py-2.5 text-center placeholder:text-xs">
                                <ion-icon name="add-outline"></ion-icon>
                                <span>Update</span>
                            </button>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
    
@endsection