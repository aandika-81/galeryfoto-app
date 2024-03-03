<!-- 

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;

// class UserController extends Controller
// {
//      // Metode untuk menampilkan profil pengguna
//      public function showProfile(Request $request)
//      {
//          // Logika untuk mengambil data profil pengguna dari database
//          $user = User::find($request->user()->id);
 
//          // Kemudian, kembalikan tampilan (view) yang menampilkan profil pengguna
//          return view('profile.show', compact('user'));
//      }
//     public function update(Request $request, $id)
//     {
//         // Validate the request data
//         $request->validate([
//             'nama_lengkap' => 'required|string',
//             'no_telepon' => 'required|string',
//             'bio' => 'required|string',
//             'alamat' => 'required|string',
//             'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: Validate image upload
//         ]);

//         // Find the user by ID
//         $user = User::findOrFail($id);

//         // Update user profile data
//         $user->nama_lengkap = $request->nama_lengkap;
//         $user->no_telepon = $request->no_telepon;
//         $user->bio = $request->bio;
//         $user->alamat = $request->alamat;

//         // Handle photo upload if exists
//         if ($request->hasFile('foto_profile')) {
//             $fotoProfile = $request->file('foto_profile');
//             $fotoName = time() . '_' . $fotoProfile->getClientOriginalName();
//             $fotoPath = $request->file('foto_profile')->storeAs('uploads', $fotoName, 'public');
//             $user->foto_profile = $fotoPath;
//         }

//         // Save the user profile data
//         $user->save();

//         // Redirect back with a success message
//         return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
//     }
// } -->


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;

// class ProfileController extends Controller
// {
//     // Menampilkan halaman profil pengguna
//     public function showProfile()
//     {
//         $user = auth()->user(); // Mengambil data pengguna yang sedang login
//         return view('profile.show', compact('user'));
//     }

//     // Memperbarui informasi profil pengguna
//     public function updateProfile(Request $request)
//     {
//         $user = auth()->user(); // Mengambil data pengguna yang sedang login

//         // Validasi data yang diterima dari form
//         $request->validate([
//             'nama_lengkap' => 'required|string|max:255',
//             'no_telepon' => 'required|string|max:20',
//             'alamat' => 'nullable|string|max:255',
//             'bio' => 'nullable|string|max:255',
//         ]);

//         // Memperbarui informasi profil pengguna
//         $user->update([
//             'nama_lengkap' => $request->nama_lengkap,
//             'no_telepon' => $request->no_telepon,
//             'alamat' => $request->alamat,
//             'bio' => $request->bio,
//         ]);

//         return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
//     }
// }

