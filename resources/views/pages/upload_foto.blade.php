@extends('layout.master')
@section('content')
<style>
 .{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Poppins', sans-serif;
}


.container {
	max-width: 400px;
	width: 100%;
	background: #e6e3e3;
	padding: 30px;
	border-radius: 30px;
	border : orangered;
}
.img-area {
	position: relative;
	width: 100%;
	height: 240px;
	background: var(--grey);
	margin-bottom: 10px;
	border-radius: 15px;
	overflow: hidden;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
}
.img-area .icon {
	font-size: 100px;
}
.img-area h3 {
	font-size: 20px;
	font-weight: 500;
	margin-bottom: 6px;
}
.img-area p {
	color: #999;
}
.img-area p span {
	font-weight: 600;
}
.img-area img …
const selectImage = document.querySelector('.select-image');
const inputFile = document.querySelector('#file');
const imgArea = document.querySelector('.img-area');

selectImage.addEventListener('click', function () {
	inputFile.click();
})

inputFile.addEventListener('change', function () {
	const image = this.files[0]
	if(image.size < 5000000) {
		const reader = new FileReader();
		reader.onload = ()=> {
			const allImg = imgArea.querySelectorAll('img');
			allImg.forEach(item=> item.remove());
			const imgUrl = reader.result;
			const img = document.createElement('img');
			img.src = imgUrl;
			imgArea.appendChild(img);
			imgArea.classList.add('active');
			imgArea.dataset.img = image.name;
		}
		reader.readAsDataURL(image);
	} else {
		alert("Image size more than 2MB");
	}
})
</style>
    <section class="mt-32">
        <form action="/unggah_foto" method="post" enctype="multipart/form-data">
            @csrf
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-hurricane"></h3>
        </div>
    </section>
    <section class="mt-10">
        <div class="max-w-screen-md mx-auto">
            <div class="flex flex-wrap px-2 flex-container">
                <div class="w-3/5 max-[480px]:w-full">
                    <div class="flex justify-center px-3">
                        <div class="flex items-center justify-center w-full">
                            <div class="container">
                                <input type="file" id="file" accept="image/*" name="file" hidden />
                                <div class="img-area select-image" data-img="">
                                    <ion-icon name="cloud-upload-outline" class="icon"></ion-icon>
                                    <h3>Upload Image</h3>
                                    
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="w-3/5 max-[480px]:w-full">
                    <div class="flex justify-center px-3">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 800x400px)
                                    </p>
                                </div>
                                <input id="dropzone-file" name="file" type="file" class="hidden" />

                            </label>
                        </div>
                    </div>
                </div> --}}
                <div class="w-2/5  max-[480px]:w-full px-2">
                    <div class="flex flex-col flex-wrap">
                        <h3>Judul</h3>
                        <input  type="text" id="judul_foto" name="judul_foto" class="py-1  border-slate-500">
                        <h3 class="mt-4">Deskripsi</h3>
                        <textarea type="text" id="deskripsi" rows="4" name="deskripsi" cols="30" rows="10"
                            class="w-full h-36 border-slate-500 "></textarea>
                            <span class="text-sm mt-5 mb-1">Album</span>

                            <div class="flex flex-row">
                                <select id="album" name="nama_album"
                                    class="block w-full p-2.5 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" class="text-black hidden">Choose Album</option>
                                    @foreach ($album as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_album }}
                                    </option>
                                @endforeach
                                </select>
                                <div class="w-4 mb-3"></div>
                                <button data-modal-target="default-modal" data-modal-toggle="default-modal" type="button"
                                    class="text-green-700 bg-transparent border border-green-700 rounded-md text-sm px-5 h-10 block p-2.5">
                                    <ion-icon name="add-outline"></ion-icon>
                                </button>
                            </div>
                        <div class="flex flex-row justify-between">
                            <div></div>
                            <button type="" class="px-6 py-1 mt-4 w-full text-white rounded-sm bg-green-700">Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-md shadow">
                <!-- Modal header -->
                <div class="flex md:p-5 dark:border-gray-600">
                    <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 inline-flex "
                        data-modal-toggle="default-modal">
                        <ion-icon name="arrow-back-outline" class="text-xl pl-4 pt-3"></ion-icon>
                    </button>
                    <h3 class="text-4xl font-medium pt-6 mx-auto font-itali">
                        Tambah Album
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/tambah_album" method="post">
                    @csrf
                    <div class="p-4 md:p-5 space-y-2 ">
                        <div class="col-span-2">
                            <label for="nama_album" class="block mb-1 text-sm font-medium">Nama Album</label>
                            <input type="text" name="nama_album" id="nama_album"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-4"
                                placeholder="Maukan Nama Album" required="">
                        </div>
                        <div>
                            <button type="submit"
                                class="text-black inline-flex items-center bg-white border font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <ion-icon name="add-outline"></ion-icon>
                                <span>Tambah</span>
                            </button>
                        </div>
                        <div class="p-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>
    <script>
        const selectImage = document.querySelector('.select-image');
const inputFile = document.querySelector('#file');
const imgArea = document.querySelector('.img-area');

selectImage.addEventListener('click', function () {
	inputFile.click();
})

inputFile.addEventListener('change', function () {
	const image = this.files[0]
	if(image.size < 5000000) {
		const reader = new FileReader();
		reader.onload = ()=> {
			const allImg = imgArea.querySelectorAll('img');
			allImg.forEach(item=> item.remove());
			const imgUrl = reader.result;
			const img = document.createElement('img');
			img.src = imgUrl;
			imgArea.appendChild(img);
			imgArea.classList.add('active');
			imgArea.dataset.img = image.name;
		}
		reader.readAsDataURL(image);
	} else {
		alert("Image size more than 2MB");
	}
})
    </script>
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.js"></script>


    @endsection