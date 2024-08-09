<?php
namespace App\Http\Controllers;

//import Model "Post
use App\Models\Cuti;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Session;

class IdCardController extends Controller
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
        
		$card = \DB::table('karyawans')
->join('perusahaans', 'karyawans.id_perusahaan', '=', 'perusahaans.id')
->join('bagians', 'karyawans.id_bagian', '=', 'bagians.id')
->join('posisis', 'karyawans.id_posisi', '=', 'posisis.id')->select('karyawans.*', 'perusahaans.nama_perusahaan','perusahaans.latitude','perusahaans.langitude','perusahaans.max_jarak_absen', 'bagians.nama_bagian','posisis.nama_posisi')
->where('karyawans.idakun', $idusers)->get();


        //render view with posts
        return view('idcard.index', compact('card'));
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