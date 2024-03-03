<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    // Method untuk mengambil data explore
    public function getData(Request $request)
    {
        if ($request->cari !== 'null'){
            $explore = Foto::with(['like'])->where ('judul_foto','like','%'.$request->cari.'%')-> orderBy('id','DESC')->withCount(['like', 'komentar'])->paginate();
        } else {
            $explore = Foto::with(['like'])->orderBy('id', 'DESC')->withCount(['like', 'komentar'])->paginate();
        }
        
        return response()->json([
            'data'  => $explore,
            'statuscode' => 200,
            'idUser' => auth()->user()->id
        ]);
    }
    
    // Method untuk menyukai atau tidak menyukai foto
    public function likefotos(Request $request)
    {
        try {
            $request->validate([
                'fotoid' => 'required'
            ]);

            // Memeriksa apakah pengguna telah menyukai foto sebelumnya atau tidak
            $existingLike = Like::where('foto_id', $request->fotoid)->where('users_id', auth()->user()->id)->first();
            if (!$existingLike) {
                // Jika belum menyukai foto, simpan data like baru
                $dataSimpan = [
                    'foto_id'       => $request->fotoid,
                    'users_id'       => auth()->user()->id
                ];
                Like::create($dataSimpan);
            } else {
                // Jika sudah menyukai foto, hapus data like yang ada
                Like::where('foto_id', $request->fotoid)->where('users_id', auth()->user()->id)->delete();
            }

            return response()->json('Data Berhasil Di Simpan', 200);
        } catch (\Throwable $th) {
            return response()->json('Something went wrong', 500);
        }
    }
    
    
    // Method untuk mengambil detail foto berdasarkan id
    public function getdatadetail(Request $request,$id)
    {
        // Mengambil detail foto berdasarkan id yang diberikan
        $dataDetailFoto = Foto::with('user')->where('id', $id)->firstOrFail();
        return response()->json([
            'dataDetailFoto' => $dataDetailFoto,
            // 'dataUser' => auth()->user()->id,
        ]);
    }

    
    // Method untuk mengambil data komentar berdasarkan id foto
    public function ambildatakomentar(Request $request, $id)
    {
        // Mengambil data komentar berdasarkan id foto yang diberikan
        $ambilkomentar  = Komentar::with('user')->orderBy('id', 'DESC')->where('foto_id', $id)->get();
        return response()->json([
            'data'  => $ambilkomentar
        ], 200);
    }

    // Method untuk mengirim komentar pada foto
    public function kirimkomentar(Request $request)
    {
        try {
            $request->validate([
                'fotoid'    => 'required',
                'isi_komentar'  => 'required'
            ]);
            // Membuat data komentar baru
            $data = [
                'users_id'   => auth()->user()->id,
                'foto_id'   => $request->fotoid,
                'isi_komentar'  => $request->isi_komentar
            ];
            Komentar::create($data);
            return response()->json([
                'data'      => 'data berhasil disimpan'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json('data gagal disimpan', 500);
        }
    }


   
}

// namespace App\Http\Controllers;
// use App\Models\Album;
// use App\Models\Foto;
// use App\Models\Komentar;
// use App\Models\Like;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class ExploreController extends Controller
// {
//     public function getData(Request $request)
//     {
//         // Memeriksa apakah pengguna telah terotentikasi
//         // if (!Auth::check()) {
//         //     return response()->json([
//         //         'message' => 'Unauthorized',
//         //         'statuscode' => 200,
//         //     ], 401);
//         // }
        
//         // Mengambil data explore
//         $explore = Foto::with(['like'])->orderBy('id', 'DESC')->withCount(['like', 'komentar'])->paginate(4);
        
//         return response()->json([
//             'data'  => $explore,
//             'statuscode' => 200,
//             'idUser' => auth()->user()->id
//         ]);
        
//     }
//     public function likefotos(Request $request)
//     {
//         try {
//             $request->validate([
//                 'fotoid' => 'required'
//             ]);

//             $existingLike = Like::where('foto_id', $request->fotoid)->where('users_id', auth()->user()->id)->first();
//             if (!$existingLike) {
//                 $dataSimpan = [
//                     'foto_id'       => $request->fotoid,
//                     'users_id'       => auth()->user()->id
//                 ];
//                 Like::create($dataSimpan);
//             } else {
//                 Like::where('foto_id', $request->fotoid)->where('users_id', auth()->user()->id)->delete();
//             }

//             return response()->json('Data Berhasil Di Simpan', 200);
//         } catch (\Throwable $th) {
//             return response()->json('Something went wrong', 500);
//         }
//     }
// //coment
// public function getdatadetail(Request $request,$id)
// {
//     $dataDetailFoto = Foto::with('user')->where('id', $id)->firstOrFail();
//     return response()->json([
//         'dataDetailFoto' => $dataDetailFoto,
//         // 'dataUser' => auth()->user()->id,
//     ]);
// }
// public function ambildatakomentar(Request $request, $id)
//     {
//         $ambilkomentar  = Komentar::with('user')->where('foto_id', $id)->get();
//         return response()->json([
//             'data'  => $ambilkomentar
//         ], 200);
//     }


//     // komentar
//     public function kirimkomentar(Request $request)
//     {
//         try {
//             $request->validate([
//                 'fotoid'    => 'required',
//                 'isi_komentar'  => 'required'
//             ]);
//             $data = [
//                 'users_id'   => auth()->user()->id,
//                 'foto_id'   => $request->fotoid,
//                 'isi_komentar'  => $request->isi_komentar
//             ];
//             Komentar::create($data);
//             return response()->json([
//                 'data'      => 'data berhasil disimpan'
//             ], 200);
//         } catch (\Throwable $th) {
//             return response()->json('data gagal disimpan', 500);
//         }
//     }


// }



