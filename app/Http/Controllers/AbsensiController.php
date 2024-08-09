<?php
namespace App\Http\Controllers;

//import Model "Post
use App\Models\Absensi;
use App\Models\Karyawan;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Session;

class AbsensiController extends Controller
{
	
    /**
     * index
     *
     * @return View
     */
public function index(): View
    {
		date_default_timezone_set('Asia/Jakarta');
		if (Auth::check()) {
        //get posts
		$idusers=Auth::user()->idusers;
        
		$datakaryawan = \DB::table('karyawans')
->join('perusahaans', 'karyawans.id_perusahaan', '=', 'perusahaans.id')
->join('bagians', 'karyawans.id_bagian', '=', 'bagians.id')
->join('posisis', 'karyawans.id_posisi', '=', 'posisis.id')->select('karyawans.*', 'perusahaans.nama_perusahaan','perusahaans.latitude','perusahaans.langitude','perusahaans.max_jarak_absen', 'bagians.nama_bagian','posisis.nama_posisi')
->where('karyawans.idakun', $idusers)->get();

$absensi = Absensi::where('idusers', '=', $idusers)->where('tanggal', 'LIKE', date('Y-m')."%")->get();

$tgl_now=date('d');
if($tgl_now <=7){
$tgl_str=1;
}else{
	$tgl_str=$tgl_now - 7;
}
//$absensi_mingguan = Absensi::where('idusers', '=', $idusers)->where('tanggal', '>=', date('Y-m-').$tgl_str."%")->orderBy('tanggal','DESC')->get();

$absensi_mingguan = Absensi::where('idusers', '=', $idusers)->where('tanggal', '>=', date('Y-m-').$tgl_str."%")->orderBy('tanggal','DESC')->limit('7')->get();
        //render view with posts
        return view('absensi.index', compact('datakaryawan','absensi','absensi_mingguan'));
		}else{
            return view('login');
        }
    }

    /**
     * index
     *
     * @return View
     */
    public function create(): View
    {
		if (Auth::check()) {
			$idusers=Auth::user()->idusers;
        
		$datakaryawan = \DB::table('karyawans')
->join('perusahaans', 'karyawans.id_perusahaan', '=', 'perusahaans.id')
->join('bagians', 'karyawans.id_bagian', '=', 'bagians.id')
->join('posisis', 'karyawans.id_posisi', '=', 'posisis.id')->select('karyawans.*', 'perusahaans.nama_perusahaan','perusahaans.latitude','perusahaans.langitude','perusahaans.max_jarak_absen', 'bagians.nama_bagian','posisis.nama_posisi')
->where('karyawans.idakun', $idusers)->get();
			$absensi = Absensi::where('idusers', '=', $idusers)->where('tanggal', '=', date('Y-m-d'))->get();
        return view('absensi.create',compact('datakaryawan','absensi'));
		}else{
            return view('login');
        }
    }
	
	/*
	public function show(Request $request,$id)
    {
        $absensi = Absensi::find($id);
        return view('absensi.show',compact('absensi'))->renderSections()['content'];
    }
	*/

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
		date_default_timezone_set('Asia/Jakarta');
		if (Auth::check()) {
        //create 
		$id=$request->idabsen;
		if($request->jenis_absen=='M'){
			$status_kehadiran="h";
		}elseif($request->jenis_absen=='K'){
			$status_kehadiran="h";
		}elseif($request->jenis_absen=='S'){
			$status_kehadiran="s";
		}elseif($request->jenis_absen=='I'){
			$status_kehadiran="i";
		}
		
		if($id==''){
        Absensi::create([
                'id_karyawan'=>$request->id_karyawan,
				'tanggal'   => date('Y-m-d'),
                'jam_masuk'   => date('H:i'),
                'jam_keluar'   => $request->telp,
                'status_kehadiran'   => $status_kehadiran,
                'keterangan'   => $request->keterangan,
                'latitude'   => $request->lat,
                'langitude'   => $request->lan,
				'idusers'=>Auth::user()->idusers
        ]);
		}else{
			$absensi= \DB::table('absensis')->where('id','=',$id)->update(['jam_keluar'=> date('H:i'),'keterangan'=>$request->keterangan]);
			
		
		}

        //redirect to index
        return redirect()->route('absensi.index')->with(['success' => 'Data Berhasil Disimpan!']);
		}else{
            return view('login');
        }
    }
    
	public function absen(Request $request):view
    {
        
		$idusers=Auth::user()->idusers;
        
		$datakaryawan = \DB::table('karyawans')
->join('perusahaans', 'karyawans.id_perusahaan', '=', 'perusahaans.id')
->join('bagians', 'karyawans.id_bagian', '=', 'bagians.id')
->join('posisis', 'karyawans.id_posisi', '=', 'posisis.id')->select('karyawans.*', 'perusahaans.nama_perusahaan','perusahaans.latitude','perusahaans.langitude','perusahaans.max_jarak_absen', 'bagians.nama_bagian','posisis.nama_posisi')
->where('karyawans.idakun', $idusers)->get();

		return view('absensi.absen', compact('datakaryawan'));

    }

    public function index_rekap(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));

        $karyawanHadir = Karyawan::select('shift_karyawans.*', 'absensis.*','karyawans.*', 'shifts.*', 'shifts.jam_masuk as shift_jam_masuk', 'shifts.jam_keluar as shift_jam_keluar', 'absensis.jam_masuk as absensi_jam_masuk', 'absensis.jam_keluar as absensi_jam_keluar')->join('absensis', 'absensis.id_karyawan', '=', 'karyawans.id')->join('shift_karyawans', 'shift_karyawans.id_karyawan', '=', 'absensis.id_karyawan')->join('shifts', 'shifts.id', '=', 'shift_karyawans.id_shift')->where('tanggal', $tanggal)->where('karyawans.idusers', Auth::user()->idusers)->get();
        // dd($karyawanHadir);
       
       
        // Karyawan yang belum hadir
        $karyawanBelumHadir = Karyawan::whereDoesntHave('absensis', function ($query) use ($tanggal) {
            $query->where('tanggal', $tanggal);
        })->where('idusers', Auth::user()->idusers)->get();
        // dd($karyawanBelumHadir);
        return view('absensi.index', compact('karyawanHadir', 'karyawanBelumHadir', 'tanggal'));
    }

    public function update_rekap(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|in:h,s,i,t,a'
        ]);

        Absensi::create(
            ['id_karyawan' => $request->id_karyawan, 'tanggal' => $request->tanggal, 'status_kehadiran' => $request->status_kehadiran]
        );

        return response()->json(['success' => true, 'message' => 'Status kehadiran berhasil diperbarui.']);
    }
    public function updateRekap(Request $request)
    {
        
        // $request->validate([
        //     'id_karyawan' => 'required|exists:karyawans,id',
        //     'tanggal' => 'required|date',
        //     'status_kehadiran' => 'required|in:h,s,i,t'
        // ]);
        Absensi::where('id_karyawan', $request->id_karyawan)
                ->where('tanggal', $request->tanggal)
                ->update(['status_kehadiran' => $request->status_kehadiran]);

        return response()->json(['success' => true, 'message' => 'Status kehadiran berhasil diperbarui.']);
    }
    
}