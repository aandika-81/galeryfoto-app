<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // SIGN IN

    // Fungsi untuk menampilkan halaman masuk (sign-in)
    public function sign_in()
    {
        return view('pages.sign_in');
        
    }

    // Fungsi untuk memeriksa kredensial pengguna saat masuk
    public function cek_akun(Request $request)
    {
        // Mencoba untuk mengautentikasi pengguna menggunakan email dan kata sandi
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Menghasilkan kembali sesi untuk mencegah serangan perbaikan sesi
            $request->session()->regenerate();
            // Mengarahkan pengguna yang berhasil masuk ke halaman jelajahi
            return redirect('/explore');
            echo"<script>alert('Login Berhasil !!');window.location.href='/explore'</script>";
        }else {
            echo"<script>alert('Login Gagallll !!');window.location.href='/sign_in'</script>";
        }
    }


    // SIGN UP

    // Fungsi untuk menampilkan halaman pendaftaran (sign-up)
    public function sign_up()
    {
        return view('pages.sign_up');
    }

    // Fungsi untuk membuat akun pengguna baru
    public function buat_akun(Request $request)
    {
        // Data untuk disimpan dalam pembuatan akun baru
        // $request->validate([
        //     'username'=> 'required',
        //     'email' => 'required',
        //     'password'=> 'required|min:8',
        //     'alamat' => 'required'
        // ]);
        $alert = [
            'username.required' => 'nama harus diisi!',
            'email.unique' => 'email sudah digunakan',
            'email.required' => 'email harus diisi!',
            'password.required' => 'password harus diisi!',
            'password.min' => 'password minimal 7 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'no_telepon.required' => 'no telepon harus diisi!',
            'bio.required' => 'no telepon harus diisi!',
        ];
         // Validasi input
         $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            // 'alamat' => 'required',
         ],$alert);
           // Membuat profil otomatis
        $newProfile = 'users.png'; // Nama file gambar profil default

        // Membuat pengguna baru
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->password),
            'foto_profile' => $newProfile, // Simpan nama file gambar profil
        ]);

    //   // Cek apakah email sudah terdaftar
    // $existingUser = User::where('email', $request->email)->first();
    // if ($existingUser) {
    //     // Jika email sudah terdaftar, tampilkan pesan kesalahan
    //     echo"<script>alert('EMAIL SUDAH TERDAFTAR !!');window.location.href='/sign_up'</script>";
    //     return;
    // }

    // // Jika tidak ada kesalahan, lanjutkan dengan membuat akun baru
    // $user = new User();
    // $user->username = $request->username;
    // $user->email = $request->email;
    // $user->password = bcrypt($request->password);
    // $user->save();
             // Menyimpan file profil default ke storage
             $defaultProfilePath = public_path('profile/' . $newProfile);
             copy(public_path('profile/users.png'), $defaultProfilePath);
    // Set notifikasi sukses
    echo"<script>alert('REGISTER BERHASIL SILAHKAN MASUK !!');window.location.href='/sign_in'</script>";
    return view('pages.sign_in');
    }


    // BERANDA

    // Fungsi untuk menampilkan halaman jelajah (explore)
    public function explore()
    {
        return view('pages.explore');
    }


    // UPLOAD FOTO

    // Fungsi untuk menampilkan halaman unggah foto
    public function upload_foto()
    {
        // Mendapatkan semua data album
        $album  =  Album::with('user')->where('users_id',auth()->user()->id)->get();
        // Mengembalikan tampilan unggah foto beserta data album
        return view('pages.upload_foto', compact('album'));
    }

    // Fungsi untuk mengunggah foto
    public function unggah_foto(Request $request)
    {
        // Mendapatkan nama file dan ekstensi file yang diunggah
        $namafile = pathinfo($request->file, PATHINFO_FILENAME);
        $extensi = $request->file->getClientOriginalExtension();
        // Membuat nama file baru dengan awalan "unggah", timestamp saat ini, dan ekstensi file
        $namafoto = 'unggah' . time() . '.' . $extensi;
        // Memindahkan file yang diunggah ke direktori "unggah" dengan nama baru
        $request->file->move('unggah', $namafoto);

        // Data untuk disimpan dalam database
        $datasimpan = [
            'users_id' => auth()->User()->id,
            'judul_foto' => $request->judul_foto,
            'deskripsi' => $request->deskripsi,
            'album_id' => $request->nama_album,
            'lokasi_foto' => $namafoto
        ];
        // Membuat entri baru untuk foto dalam database
        Foto::create($datasimpan);
        // Mengarahkan pengguna kembali ke halaman jelajah setelah unggah foto berhasil
        return redirect('/explore');
    }


    // ALBUM

    // Fungsi untuk menambahkan album baru
    public function tambah_album(Request $request)
    {
        // Jika album_id adalah 0, artinya album baru akan dibuat
        if ($request->album_id == 0) {
            // Data untuk disimpan dalam database
            $datasimpan = [
                'users_id' => auth()->User()->id,
                'nama_album' => $request->nama_album,
            ];
            // Membuat entri baru untuk album dalam database
            Album::create($datasimpan);
        }
        // Mengambil semua data album
        $album = Album::all();
        // Mengembalikan tampilan unggah foto beserta data album setelah penambahan album baru
        return view('pages.upload_foto', compact('album'));
    }


    // KOMENTAR

    // Fungsi untuk menampilkan halaman untuk menulis komentar
    public function komen()
    {
        return view('pages.komen');
    }

    


    // PROFILE

    // Fungsi untuk menampilkan halaman profil pengguna
    public function profile()
    {
        $tampilAlbum = Album::with('foto')->where('users_id', auth()->user()->id)->get();
        $tampilUpload = Foto::with('album')->where('users_id', auth()->user()->id)->get();
        // Mendapatkan data profil pengguna saat ini
            $dataprofile   = User::where('id', auth()->user()->id)->first();
        // Mengembalikan tampilan halaman profil dengan data profil pengguna
        return view('pages.profile', compact('tampilAlbum','dataprofile','tampilUpload'));
    }

    // PROFIL
public function show($id)
{
    $album = Album::with('foto')->findOrFail($id);
    return view('pages.album', compact('album'));
}

    // Fungsi untuk memperbarui profil pengguna
    public function update_profile(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required',
        'no_telepon' => 'required',
        'bio' => 'required'
    ]);

    $dataToUpdate = [];

    // Logika penyimpanan foto sesuai kebutuhan Anda
    if ($request->hasFile('profile')) {
        $filename = pathinfo($request->profile->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->profile->getClientOriginalExtension();
        $namafoto = $filename . '_' . time() . '.' . $extension;
        $request->profile->move(public_path('profile'), $namafoto);
        $dataToUpdate['foto_profile'] = $namafoto;
    }

    // Update data lainnya
    $dataToUpdate += [
        'nama_lengkap' => $request->nama_lengkap,
        'no_telepon' => $request->no_telepon,
        'bio' => $request->bio,
        'alamat' => $request->alamat // Jika alamat juga bisa diubah, tambahkan ini
    ];

    User::where('id', auth()->user()->id)->update($dataToUpdate);

    return redirect('/profil')->with('success', 'Profil berhasil diperbarui!');
}


    // Fungsi untuk memperbarui kata sandi pengguna

    public function update_password(Request $request)
    {
        // Validasi input
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        // Ambil pengguna yang sedang masuk
        $user = User::find(auth()->user()->id);
    
        // Periksa apakah kata sandi saat ini sesuai dengan yang dimasukkan oleh pengguna
        if (Hash::check($request->current_password, $user->password)) {
            // Jika cocok, update kata sandi
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            // Redirect ke halaman profil dengan pesan sukses
            return redirect('/profil')->with('success', 'Kata sandi berhasil diperbarui!');
        } else {
            // Jika tidak cocok, redirect ke halaman profil dengan pesan kesalahan
            return redirect('/profil')->with('error', 'Kata sandi saat ini tidak cocok!');
        }
    }
    
    // LOGOUT

    // Fungsi untuk keluar dari sesi pengguna
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();
        // Membatalkan sesi pengguna
        $request->session()->invalidate();
        // Menghasilkan kembali sesi untuk mencegah serangan perbaikan sesi
        $request->session()->regenerate();
        // Mengarahkan pengguna kembali ke halaman masuk setelah logout berhasil
        return redirect('/sign_in');
    }

    // Fungsi untuk menampilkan detail jelajah
    public function explore_detail()
    {
        // Mengembalikan tampilan halaman detail jelajah
        return view('pages.explore-detail');
    }

  // Controller
public function destroy($id)
{
    $foto = Foto::find($id);

    if ($foto) {
        // Hapus semua like yang terkait dengan foto
        $foto->like()->delete();
        $foto->komentar()->delete();

        // Setelah itu baru hapus foto itu sendiri
        $foto->delete();

        return redirect('/explore')->with('success', 'Foto berhasil dihapus.');
    } else {
        return redirect('/explore')->with('error', 'Foto tidak ditemukan.');
    }
}
}





// namespace App\Http\Controllers;

// use App\Models\Album;
// use App\Models\Foto;
// use App\Models\Komentar;
// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class GalleryController extends Controller
// {
//     // SIGN IN
//     public function sign_in()
//     {
//         return view('pages.sign_in');
//     }
//     public function cek_akun(Request $request)
//     {
//         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//             $request->session()->regenerate();
//             return redirect('/explore');
//         } else {
//             echo "gagal login";
//         }
//     }


//     // SIGN UP
//     public function sign_up()
//     {
//         return view('pages.sign_up');
//     }
//     public function buat_akun(Request $request)
//     {
//         $datasimpan = [
//             'username' => $request->username,
//             'email' => $request->email,
//             'password' => bcrypt($request->password),
//             'alamat' => $request->alamat,
//         ];
//         User::create($datasimpan);
//         return view('pages.sign_in');
//     }


//     // BERANDA
//     public function explore()
//     {
//         return view('pages.explore');
//     }


//     // UPLOAD FOTO
//     public function upload_foto()
//     {
//         $album  =  Album::all();
//         return view('pages.upload_foto', compact('album'));
//     }
//     public function unggah_foto(Request $request)
//     {
//         $namafile = pathinfo($request->file, PATHINFO_FILENAME);

//         // Mendapatkan nama file dari path file yang diunggah.
//         $extensi = $request->file->getClientOriginalExtension();

//         // Mendapatkan ekstensi (format) file yang diunggah.
//         $namafoto = 'unggah' . time() . '.' . $extensi;

//         // Membuat nama file baru dengan awalan "gallery", diikuti oleh timestamp saat ini (fungsi time()) dan ekstensi file asli.
//         $request->file->move('unggah', $namafoto);

//         // Memindahkan file yang diunggah ke direktori "gallery" dengan nama baru yang telah dibuat sebelumnya.


//         $datasimpan = [
//             'users_id' => auth()->User()->id,
//             'judul_foto' => $request->judul_foto,
//             'deskripsi' => $request->deskripsi,
//             'album_id' => $request->nama_album,
//             'lokasi_foto' => $namafoto
//         ];
//         Foto::create($datasimpan);
//         return redirect('/explore');
//     }


//     // ALBUM
//     public function tambah_album(Request $request)
//     {
//         if ($request->album_id == 0) {
//             $datasimpan = [
//                 'users_id' => auth()->User()->id,
//                 'nama_album' => $request->nama_album,
//             ];
//             Album::create($datasimpan);
//         }
//         $album = Album::all();
//         return view('pages.upload_foto', compact('album'));
//     }


//     // KOMENTAR
//     public function komen()
//     {
//         return view('pages.komen');
//     }
//     public function tulis_komentar(Request $request)
//     {
//         $komentar = [
//             'users_id' => auth()->User()->id,
//             'isi_komentar' => $request->komentar,
//         ];
//         Komentar::create($komentar);
//         return view('pages.komen');
//     }


//     // PROFILE
//     public function profile()
//     {
//         $data = [
//             'dataprofile'   => User::where('id', auth()->user()->id)->first()
//         ];
//         return view('pages.profile', $data);

//     }
//     public function update_profile(Request $request)
//     {
//         $data_update = [
//             'foto_profile'   => $request->foto_profile,
//             'nama_lengkap'  => $request->nama_lengkap,
//             'no_telepon'  => $request->no_telepon,
//             'alamat'  => $request->alamat,
//             'bio'  => $request->bio
//         ];
//         //     //proses update
//         User::where('id', auth()->user()->id)->update($data_update);
//         return redirect('/profile');
//     }
//     public function update_password(Request $request)
//     {
//         $update_password = [
//             'password'  => bcrypt($request->new_password),
//         ];
//         //     //proses simpan
//         User::where('id', auth()->user()->id)->update($update_password);
//         return redirect('/profile');
//     }


//     // LOGOUT
//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerate();
//         return redirect('/sign_in');
//     }

//     public function explore_detail()

//     {
//         return view('pages.explore-detail');
//     }
// }

