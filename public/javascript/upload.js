// Memilih elemen-elemen yang dibutuhkan
const selectImage = document.querySelector('.select-image');
const inputFile = document.querySelector('#file');
const imgArea = document.querySelector('.img-area');

// Menambahkan event listener untuk tombol selectImage
selectImage.addEventListener('click', function () {
	// Memicu event click pada input file ketika tombol selectImage diklik
	inputFile.click();
})

// Menambahkan event listener untuk input file ketika terjadi perubahan
inputFile.addEventListener('change', function () {
	// Mendapatkan file gambar yang dipilih oleh pengguna
	const image = this.files[0]
	// Memeriksa apakah ukuran gambar kurang dari 5MB (5000000 bytes)
	if(image.size < 5000000) {
		// Membuat objek FileReader
		const reader = new FileReader();
		// Mengatur fungsi yang akan dieksekusi ketika pembacaan file selesai
		reader.onload = ()=> {
			// Menghapus semua gambar yang ada di dalam area gambar
			const allImg = imgArea.querySelectorAll('img');
			allImg.forEach(item=> item.remove());
			// Mendapatkan URL gambar yang akan ditampilkan
			const imgUrl = reader.result;
			// Membuat elemen gambar baru
			const img = document.createElement('img');
			// Mengatur sumber gambar
			img.src = imgUrl;
			// Menambahkan elemen gambar ke dalam area gambar
			imgArea.appendChild(img);
			// Menambahkan kelas 'active' ke area gambar
			imgArea.classList.add('active');
			// Menyimpan nama file gambar ke dalam dataset area gambar
			imgArea.dataset.img = image.name;
		}
		// Membaca konten data URL gambar
		reader.readAsDataURL(image);
	} else {
		// Menampilkan pesan kesalahan jika ukuran gambar lebih dari 5MB
		alert("Image size more than 5MB");
	}
})
