<?php
namespace App\Http\Controllers;

//import Model "Post
use App\Models\Absensi;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Session;

class LapAbsensiController extends Controller
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
->join('absensis', 'karyawans.id', '=', 'absensis.id_karyawan')
->join('posisis', 'karyawans.id_posisi', '=', 'posisis.id')->select('karyawans.*', 'perusahaans.nama_perusahaan','perusahaans.latitude','perusahaans.langitude','perusahaans.max_jarak_absen', 'bagians.nama_bagian','posisis.nama_posisi','absensis.tanggal','absensis.status_kehadiran','absensis.jam_masuk','absensis.jam_keluar','absensis.keterangan')
->where('karyawans.idusers', $idusers)->get();

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
        return view('lapabsensi.index', compact('datakaryawan','absensi','absensi_mingguan'));
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
		if($id==''){
        Absensi::create([
                'id_karyawan'=>$request->id_karyawan,
				'tanggal'   => date('Y-m-d'),
                'jam_masuk'   => date('H:i'),
                'jam_keluar'   => $request->telp,
                'latitude'   => $request->lat,
                'langitude'   => $request->lan,
				'idusers'=>Auth::user()->idusers
        ]);
		}else{
			$absensi= \DB::table('absensis')->where('id','=',$id)->update(['jam_keluar'=> date('H:i'),]);
			
		
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
    
}