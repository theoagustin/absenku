<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Perusahaan;
use App\Models\Cuti;
use App\Models\ShiftKaryawan;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ApiController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $idusers = $user->idusers;

        // Cari data karyawan berdasarkan idusers dan role_level
        $karyawan = Karyawan::join('users', 'karyawans.idakun', '=', 'users.idusers')
                            ->where('users.idusers', $idusers)
                            ->where('users.role_level', 3)
                            ->select('karyawans.id as id_karyawan')
                            ->first();

        if ($karyawan) {
            // Jika data karyawan ditemukan, ambil id_karyawan
            $id_karyawan = $karyawan->id_karyawan;

            return response()->json([
                'idusers' => $idusers,
                'id_karyawan' => $id_karyawan,
            ], 200);
        } else {
            // Jika tidak ada data karyawan yang sesuai
            return response()->json(['error' => 'No matching employee found'], 401);
        }
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}



    
public function index(Request $request)
    {
        // Mengambil id_karyawan dari input request
        $id_karyawan = $request->input('id_karyawan');

        try {
            // Mengambil semua data absensi berdasarkan id_karyawan
            $absensi = Absensi::where('id_karyawan', $id_karyawan)->orderBy('id', 'desc')->get();


            // Mengembalikan respons JSON dengan data absensi dan status 200 OK
            return response()->json($absensi, 200);
        } catch (\Exception $e) {
            // Mengembalikan respons error jika terjadi kesalahan
            return response()->json(['error' => 'Failed to retrieve absensi'], 500);
        }
    }
    
    public function getabsen(Request $request)
    {
        // Mengambil id_karyawan dari input request
        $id_karyawan = $request->id_karyawan;

        try {
            // Mengambil semua data absensi berdasarkan id_karyawan
            $absensi = Absensi::where('id_karyawan', $request->id_karyawan)->orderBy('id', 'desc')->get();


            // Mengembalikan respons JSON dengan data absensi dan status 200 OK
            return response()->json($absensi, 200);
        } catch (\Exception $e) {
            // Mengembalikan respons error jika terjadi kesalahan
            return response()->json(['error' => 'Failed to retrieve absensi'], 500);
        }
    }
    
public function getper(Request $request)
    {
        // Mengambil id_karyawan dari input request
        $idusers = $request->idusers;

        try {
            // Mengambil semua data absensi berdasarkan id_karyawan
            $permohonan = Cuti::where('idusers', $idusers)->orderBy('id', 'desc')->get();

            // Mengembalikan respons JSON dengan data absensi dan status 200 OK
            return response()->json($permohonan, 200);
        } catch (\Exception $e) {
            // Mengembalikan respons error jika terjadi kesalahan
            return response()->json(['error' => 'Failed to retrieve absensi'], 500);
        }
    }


    public function getDataByIds(Request $request)
{
    $idusers = $request->input('idusers');
    $id_karyawan = $request->input('id_karyawan');

    // Lakukan join antara tabel user dan karyawan berdasarkan id_karyawan dan idusers
    $result = DB::table('users')
        ->join('karyawans', 'users.idusers', '=', 'karyawans.idusers')
        ->where('users.idusers', $idusers)
        ->where('karyawans.id', $id_karyawan)
        ->select('users.*', 'karyawans.*')
        ->first();

    if (!$result) {
        return response()->json(['error' => 'Data not found'], 404);
    }

    return response()->json($result, 200);
}



    public function changePassword(Request $request)
    {
        // Validasi request
        $request->validate([
            'idusers' => 'required|exists:users,idusers', // Memastikan idusers ada di tabel users
            'password' => 'required', // Password baru minimal 6 karakter
        ]);

        try {
            // Mengambil user berdasarkan idusers
            $user = User::findOrFail($request->idusers);
            
            // Mengubah password user
            //$user->password = Hash::make($request->password);
            //$user->save();
            #Update the new Password
        User::where('idusers',$user->idusers)->update([
            'password' => Hash::make($request->password),'pass_text'=>$request->password
        ]);
            // Mengembalikan respons sukses
            // return response()->json(['message' => 'Password updated successfully'], 200);
            return response()->json(['message' => $request->password], 200);
        } catch (\Exception $e) {
            // Mengembalikan respons error jika terjadi kesalahan
            return response()->json(['error' => 'Failed to update password'], 500);
        }
        
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


    }

    public function changeUsername(Request $request)
{
    // Validasi request
    $request->validate([
        'idusers' => 'required|exists:users,idusers', // Memastikan idusers ada di tabel users
        'username' => 'required|string|min:5|unique:users,username', // Username baru unik dan minimal 5 karakter
        'old_username' => 'required|string', // Username lama yang harus sesuai dengan username saat ini
        'password' => 'required|string', // Password untuk memverifikasi perubahan username
    ]);

    try {
        // Mengambil user berdasarkan idusers
        $user = User::find($request->idusers);

        // Memverifikasi username lama dan password
        if ($user->username !== $request->old_username || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid old username or password'], 400);
        }

        // Mengubah username user
        $user->username = $request->username;
        $user->save();

        // Mengembalikan respons sukses
        return response()->json(['message' => 'Username updated successfully'], 200);
    } catch (\Exception $e) {
        // Mengembalikan respons error jika terjadi kesalahan
        return response()->json(['error' => 'Failed to update username'], 500);
    }
}

// public function addPermohonanCuti(Request $request)
// {
//     // Validasi input
//     $request->validate([
//         'dari_tanggal' => 'required',
//         'sampai_tanggal' => 'required',
//         'perihal' => 'required',
//         'keterangan' => 'nullable',
//         'idusers' => 'required',
//         'kategori' => 'required',
//         'file.*' => 'required', // File harus diisi
//         'tanggal_pengajuan' => 'required',
//     ]);

//     try {
//         // Ambil id_perusahaan dari tabel karyawan berdasarkan idusers
//         $id_perusahaan = Karyawan::where('idusers', $request->idusers)->value('id_perusahaan');

//         if (!$id_perusahaan) {
//             return response()->json(['error' => 'Data karyawan tidak ditemukan'], 404);
//         }

//         // Ambil tanggal pengajuan dari request
//         $tanggalPengajuan = $request->tanggal_pengajuan;

//         // Handle file upload
//         if ($request->hasFile('file')) {
//             $file = $request->file('file');
//             $fileName = time() . '.' . $file->getClientOriginalExtension();
//             $file->move(public_path('uploads'), $fileName); // Simpan di folder public/uploads

//             // Simpan nama file ke dalam database
//             $filePath = 'uploads/' . $fileName;
//         } else {
//             return response()->json(['error' => 'File is required'], 400);
//         }


//         // Simpan permohonan cuti ke database
//         $cuti = Cuti::create([
//             'id_perusahaan' => $id_perusahaan,
//             'dari_tanggal' => $request->dari_tanggal,
//             'sampai_tanggal' => $request->sampai_tanggal,
//             'perihal' => $request->perihal,
//             'keterangan' => $request->keterangan,
//             'kategori' => $request->kategori,
//             'status' => "Pending",
//             'idusers' => $request->idusers,
//             'created_at' => $tanggalPengajuan,
//             'updated_at' => $tanggalPengajuan,
//             'file' => $filePath, // Simpan nama file ke dalam database
//         ]);
// Log::info('Adding permohonan cuti', [
//     'id_perusahaan' => $id_perusahaan,
//     'dari_tanggal' => $request->dari_tanggal,
//     'sampai_tanggal' => $request->sampai_tanggal,
//     'perihal' => $request->perihal,
//     'keterangan' => $request->keterangan,
//     'kategori' => $request->kategori,
//     'idusers' => $request->idusers,
//     'file' => $filePath,
// ]);
// \Log::info('Request Data:', $request->all());
//         // Berhasil menambahkan permohonan cuti
//         return response()->json(['cuti' => $cuti], 201);
//     } catch (\Exception $e) {
//         // Tangani kesalahan jika gagal menyimpan ke database
//         return response()->json(['error' => 'Failed to add permohonan cuti', 'details' => $e->getMessage()], 500);
//     }
// }




    
    
    public function deletePermohonanCuti(Request $request)
{
    // Validasi input untuk memastikan id cuti disediakan
    $request->validate([
        'id' => 'required|exists:cutis,id', // Ganti 'cutis' sesuai dengan nama tabel cuti Anda
    ]);

    try {
        // Mengambil data cuti berdasarkan ID
        $cuti = Cuti::find($request->id);

        if (!$cuti) {
            // Jika data cuti tidak ditemukan
            return response()->json(['error' => 'Permohonan cuti not found'], 404);
        }

        // Menghapus data cuti
        $cuti->delete();

        // Berhasil menghapus data cuti
        return response()->json(['message' => 'Permohonan cuti berhasil dihapus'], 200);
    } catch (\Exception $e) {
        // Tangani kesalahan jika terjadi saat menghapus data cuti
        return response()->json(['error' => 'Failed to delete permohonan cuti', 'details' => $e->getMessage()], 500);
    }
}

public function addPermohonanCuti(Request $request)
{
    // Validasi input
    $request->validate([
        'dari_tanggal' => 'required',
        'sampai_tanggal' => 'required',
        'perihal' => 'required',
        'keterangan' => 'nullable',
        'idusers' => 'required',
        'kategori' => 'required',
        'file.*' => 'required|file', // File harus diisi
        'tanggal_pengajuan' => 'required',
    ]);

    try {
        // Ambil id_perusahaan dari tabel karyawan berdasarkan idusers
        $id_perusahaan = Karyawan::where('idakun', $request->idusers)->value('id_perusahaan');

        if (!$id_perusahaan) {
            return response()->json(['error' => 'Data karyawan tidak ditemukan'], 404);
        }

        // Ambil tanggal pengajuan dari request
        $tanggalPengajuan = $request->tanggal_pengajuan;

        // Handle file upload
        $filePaths = null;
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move('uploads/', $fileName);
                $filePaths = 'uploads/' . $fileName;
            }
        } else {
            return response()->json(['error' => 'File is required'], 400);
        }

        // Simpan permohonan cuti ke database
        $cuti = Cuti::create([
            'id_perusahaan' => $id_perusahaan,
            'dari_tanggal' => $request->dari_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'perihal' => $request->perihal,
            'keterangan' => $request->keterangan,
            'kategori' => $request->kategori,
            'status' => "Pending",
            'idusers' => $request->idusers,
            'created_at' => $tanggalPengajuan,
            'updated_at' => $tanggalPengajuan,
            'file' => $filePaths, // Simpan nama file ke dalam database sebagai JSON
        ]);

        Log::info('Adding permohonan cuti', [
            'id_perusahaan' => $id_perusahaan,
            'dari_tanggal' => $request->dari_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'perihal' => $request->perihal,
            'keterangan' => $request->keterangan,
            'kategori' => $request->kategori,
            'idusers' => $request->idusers,
            'file' => $filePaths,
        ]);

        // Berhasil menambahkan permohonan cuti
        return response()->json(['cuti' => $cuti], 201);
    } catch (\Exception $e) {
        // Tangani kesalahan jika gagal menyimpan ke database
        return response()->json(['error' => 'Failed to add permohonan cuti', 'details' => $e->getMessage()], 500);
    }
}

public function updatePermohonanCuti(Request $request)
{
    $request->validate([
        'id' => 'required|exists:cutis,id',
        'tanggal_pengajuan' => 'required|date',
        'dari_tanggal' => 'required|date',
        'sampai_tanggal' => 'required|date',
        'perihal' => 'required|string',
        'keterangan' => 'nullable|string',
        'kategori' => 'required|string',
        'file.*' => 'nullable|file|mimes:jpg,png,pdf,doc,docx,xlsx,pptx|max:2048',
    ]);

    try {
        $cuti = Cuti::find($request->id);

        if (!$cuti) {
            return response()->json(['error' => 'Permohonan cuti tidak ditemukan'], 404);
        }

        $cuti->created_at = $request->tanggal_pengajuan;
        $cuti->dari_tanggal = $request->dari_tanggal;
        $cuti->sampai_tanggal = $request->sampai_tanggal;
        $cuti->perihal = $request->perihal;
        $cuti->keterangan = $request->keterangan;
        $cuti->kategori = $request->kategori;

        $filePaths = $cuti->file; // Menyimpan file lama jika tidak ada file baru

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePaths) {
                $oldFilePath = public_path($filePaths);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Upload file baru
            $filePaths = [];
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $filePaths[] = 'uploads/' . $fileName;
            }
            $filePaths = implode(',', $filePaths); // Menggabungkan path file jika lebih dari satu
        }

        $cuti->file = $filePaths;

        $cuti->save();

        Log::info('Updating permohonan cuti', [
            'id' => $cuti->id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'dari_tanggal' => $request->dari_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'perihal' => $request->perihal,
            'keterangan' => $request->keterangan,
            'kategori' => $request->kategori,
            'file' => $filePaths,
        ]);

        return response()->json(['message' => 'Permohonan cuti berhasil diperbarui'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal memperbarui permohonan cuti', 'details' => $e->getMessage()], 500);
    }
}




public function absenMasuk(Request $request)
{
    $request->validate([
        'id_karyawan' => 'required|exists:karyawans,id',
        'latitude' => 'required|numeric',
        'langitude' => 'required|numeric',
        'idusers' => 'required|exists:users,idusers',
        'status_kehadiran' => 'required|in:s,h,i,t', // Memastikan status kehadiran valid
        'keterangan' => 'nullable|string'
    ]);

    try {
        $currentTime = Carbon::now('Asia/Jakarta');
        $jamMasuk = $currentTime->format('H:i:s');
        $tanggal = $currentTime->format('Y-m-d');

        // Ambil data karyawan
        $karyawan = Karyawan::find($request->id_karyawan);
        $perusahaan = Perusahaan::find($karyawan->id_perusahaan);

        if (!$perusahaan) {
            return response()->json(['error' => 'Perusahaan tidak ditemukan untuk karyawan ini.'], 404);
        }

        // Hitung jarak antara karyawan dan perusahaan
        $jarak = $this->hitungJarak($request->latitude, $request->longitude, $perusahaan->latitude, $perusahaan->longitude);

        if ($jarak > $perusahaan->max_jarak_absen) {
            return response()->json(['error' => 'Jarak absensi melebihi batas yang diizinkan.'], 403);
        }

        // Jika status kehadiran tidak diberikan, tetapkan berdasarkan waktu masuk
        if ($request->status_kehadiran === 'h' && $currentTime->hour >= 8) {
            $statusKehadiran = 't'; // Terlambat
        } else {
            $statusKehadiran = $request->status_kehadiran;
        }

        // Tetapkan keterangan hanya jika status kehadiran bukan 't' atau 'h'
        $keterangan = ($statusKehadiran === 's' || $statusKehadiran === 'i') ? $request->keterangan : null;

        $absensi = Absensi::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => $tanggal,
            'jam_masuk' => $jamMasuk,
            'status_kehadiran' => $statusKehadiran,
            'latitude' => $request->latitude,
            'langitude' => $request->langitude,
            'keterangan' => $keterangan,
            'idusers' => $request->idusers,
        ]);

        return response()->json(['message' => 'Absen masuk berhasil', 'data' => $absensi], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to absen masuk', 'details' => $e->getMessage()], 500);
    }
}

/**
 * Menghitung jarak antara dua titik koordinat dengan rumus Haversine
 * @param float $lat1 Latitude titik pertama
 * @param float $lon1 Longitude titik pertama
 * @param float $lat2 Latitude titik kedua
 * @param float $lon2 Longitude titik kedua
 * @return float Jarak dalam meter
 */
private function hitungJarak($lat1, $lon1, $lat2, $lon2)
{
    $radiusBumi = 6371000; // dalam meter

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $jarak = $radiusBumi * $c;

    return $jarak;
}


public function checkAbsenMasuk(Request $request)
{
    $request->validate([
        'idusers' => 'required|exists:users,idusers',
        'id_karyawan' => 'required|exists:karyawans,id',
    ]);

    try {
        $currentTime = Carbon::now('Asia/Jakarta');
        $currentHourMinute = $currentTime->format('H:i');

        // Ambil data shift karyawan
        $shiftKaryawan = ShiftKaryawan::with('shift')
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        if (!$shiftKaryawan) {
            return response()->json(['error' => 'Shift karyawan tidak ditemukan.'], 404);
        }

        $jamMasuk = Carbon::parse($shiftKaryawan->shift->jam_masuk)->format('H:i');

        // Cek apakah idusers terkait dengan id_karyawan yang diberikan
        $karyawan = Karyawan::where('id', $request->id_karyawan)
            ->where('idakun', $request->idusers)
            ->first();

        if (!$karyawan) {
            return response()->json(['error' => 'User tidak cocok dengan id_karyawan yang diberikan.'], 403);
        }
        $current_date = $currentTime->format('Y-m-d');
        // Cek apakah sudah ada data absensi untuk idusers pada hari ini
        $absensiHariIni = Absensi::where('id_karyawan', $request->id_karyawan)->where('tanggal', $current_date)
            ->first();
        if($absensiHariIni->jam_keluar !=''){
            return response()->json(['can_attend' => false, 'message' => "$currentHourMinute Anda belum bisa absen masuk, belum waktu shift Anda. $jamMasuk"], 300);
        }else{
        if ($absensiHariIni) {
            // Jika sudah ada absensi untuk hari ini
            return response()->json(['can_attend' => false, 'message' => 'Anda sudah absen masuk hari ini.'], 200);
        } else {
            // Cek jika waktu sekarang kurang dari jam masuk
            if ($currentHourMinute >= $jamMasuk) {
                return response()->json(['can_attend' => true, 'message' => 'Anda belum absen masuk hari ini dan masih dalam waktu shift.'], 200);
            } else {
                return response()->json(['can_attend' => false, 'message' => "$currentHourMinute Anda belum bisa absen masuk, belum waktu shift Anda. $jamMasuk"], 200);
            }
        }
        }
    } catch (\Exception $e) {
        Log::error('Error in checkAbsenMasuk: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to check absen masuk'.$current_date, 'details' => $e->getMessage()], 500);
    }
}






public function checkAbsenKeluar(Request $request)
{
    $request->validate([
        'idusers' => 'required|exists:users,idusers',
        'id_karyawan' => 'required|exists:karyawans,id',
    ]);

    try {
        $currentTime = Carbon::now('Asia/Jakarta');
        $currentHourMinute = $currentTime->format('H:i');

        // Ambil data shift karyawan
        $shiftKaryawan = ShiftKaryawan::with('shift')
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        if (!$shiftKaryawan) {
            return response()->json(['error' => 'Shift karyawan tidak ditemukan.'], 404);
        }

        $jamKeluar = Carbon::parse($shiftKaryawan->shift->jam_keluar)->format('H:i');
        
        $current_date = $currentTime->format('Y-m-d');
        // Cek apakah idusers terkait dengan id_karyawan yang diberikan
        $karyawan = Karyawan::where('id', $request->id_karyawan)
            ->where('idakun', $request->idusers)
            ->first();

        if (!$karyawan) {
            return response()->json(['error' => 'User tidak cocok dengan id_karyawan yang diberikan.'], 403);
        }

        // Cek apakah sudah ada data absensi keluar untuk idusers pada hari ini
        $absensiKeluarHariIni = Absensi::where('idusers', $request->idusers)
            ->whereDate('tanggal', $currentTime->format('Y-m-d')) // Periksa tanggal untuk status absen keluar
            ->whereNotNull('jam_keluar') // Pastikan sudah absen keluar
            ->first();

        if ($absensiKeluarHariIni) {
            // Jika sudah ada absensi keluar untuk hari ini
            return response()->json(['can_attend' => false, 'message' => 'Anda sudah absen keluar hari ini.'], 200);
        } else {
            // Cek jika waktu sekarang kurang dari jam keluar
            if ($currentHourMinute < $jamKeluar) {
                return response()->json(['can_attend' => false, 'message' => 'Anda belum bisa absen keluar, belum waktu shift selesai.'], 200);
            } else {
                return response()->json(['can_attend' => true, 'message' => 'Anda belum absen keluar hari ini dan sudah dalam waktu shift selesai.'], 200);
            }
        }
    } catch (\Exception $e) {
        Log::error('Error in checkAbsenKeluar: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to check absen keluar', 'details' => $e->getMessage()], 500);
    }
}




public function absenKeluar(Request $request)
{
    $request->validate([
        'id_karyawan' => 'required|exists:karyawans,id',
        'idusers' => 'required|exists:users,idusers',
        'latitude' => 'required|numeric',
        'langitude' => 'required|numeric',
    ]);

    try {
        $currentTime = Carbon::now('Asia/Jakarta');
        $jamKeluar = $currentTime->format('H:i:s');
        $tanggal = $currentTime->format('Y-m-d');

        // Ambil data karyawan
        $karyawan = Karyawan::find($request->id_karyawan);
        $perusahaan = Perusahaan::find($karyawan->id_perusahaan);

        if (!$perusahaan) {
            return response()->json(['error' => 'Perusahaan tidak ditemukan untuk karyawan ini.'], 404);
        }

        // Hitung jarak antara karyawan dan perusahaan
        $jarak = $this->hitungJarak($request->latitude, $request->longitude, $perusahaan->latitude, $perusahaan->longitude);

        if ($jarak > $perusahaan->max_jarak_absen) {
            return response()->json(['error' => 'Jarak absensi melebihi batas yang diizinkan.'], 403);
        }

        // Cek apakah ada data absen masuk pada hari yang sama
        $absensi = Absensi::where('id_karyawan', $request->id_karyawan)
            ->where('tanggal', $tanggal)
            ->whereNotNull('jam_masuk') // Pastikan sudah absen masuk
            ->first();

        if (!$absensi) {
            return response()->json(['error' => 'Absen masuk belum ada.'], 400);
        }

        // Cek apakah sudah ada data absensi keluar untuk hari ini
        $absensiKeluarHariIni = Absensi::where('id_karyawan', $request->id_karyawan)
            ->where('tanggal', $tanggal)
            ->whereNotNull('jam_keluar')
            ->first();

        if ($absensiKeluarHariIni) {
            return response()->json(['error' => 'Anda sudah absen keluar hari ini.'], 400);
        }

        // Update data absensi dengan jam keluar, latitude, dan longitude
        $absensi->jam_keluar = $jamKeluar;
        $absensi->latitude = $request->latitude;
        $absensi->langitude = $request->langitude;
        $absensi->save();

        return response()->json(['message' => 'Absen keluar berhasil', 'data' => $absensi], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to absen keluar', 'details' => $e->getMessage()], 500);
    }
}


}
