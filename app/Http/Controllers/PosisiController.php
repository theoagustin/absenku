<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\Posisi;
use App\Models\Bagian;
use App\Models\Perusahaan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Session;
class PosisiController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        //$posisi = Posisi::where('idusers', '=', '1')->get();
		 if (Auth::check()) {
        
$idusers=Auth::user()->idusers;
$posisi = \DB::table('posisis')
->join('perusahaans', 'posisis.id_perusahaan', '=', 'perusahaans.id')
->join('bagians', 'posisis.id_bagian', '=', 'bagians.id')->select('posisis.*', 'perusahaans.nama_perusahaan', 'bagians.nama_bagian')
->where('posisis.idusers', $idusers)->get(); 
        //render view with posts
        return view('posisi.index', compact('posisi'));
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
        //return view('posisi.create');
		
		$idperusahaan = 1;

//$bagian = \DB::table('bagians')->select('id', 'nama_bagian', 'id_perusahaan')->where('id_perusahaan', '=', '1')->first();
$idusers=1;
//$courses = Course::orderBy('nama_bagian')->get();
$perusahaan= \DB::table('perusahaans')->where('idusers', '=', '1')->get();
// Note: use DB::table('courses') if you don't have a `Course` model, but models are preferred

 
$bagian= \DB::table('bagians')->orderBy('nama_bagian')->where('id_perusahaan', '=', $idperusahaan)->get();
// Note: use DB::table('courses') if you don't have a `Course` model, but models are preferred


return view('posisi.create', compact('perusahaan','bagian'));
		}else{
            return view('login');
        }
    }
	

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
		if (Auth::check()) {
        //validate form
        $this->validate($request, [
            //'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            //'title'     => 'required|min:5',
            //'content'   => 'required|min:10'
        ]);

        //upload image
        //$image = $request->file('image');
        //$image->storeAs('public/posts', $image->hashName());

        //create post
        Posisi::create([
                'id_perusahaan'     => $request->id_perusahaan,
                'id_bagian'     => $request->id_bagian,
                'nama_posisi'   => $request->nama_posisi,
                'jenis_gaji'   => $request->jenis_gaji,
                'gaji_pokok'   => $request->gaji_pokok,
                'gaji_lembur_perjam'   => $request->gaji_lembur_perjam
        ]);

        //redirect to index
        return redirect()->route('posisi.index')->with(['success' => 'Data Berhasil Disimpan!']);
		}else{
            return view('login');
        }
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
		if (Auth::check()) {
        //get post by ID
        $posisi = Posisi::findOrFail($id);

        //render view with post
        return view('posisi.show', compact('posisi'));
		}else{
            return view('login');
        }
    }
	/*
	public function getPerusahaan($id)
    {
         $perusahaan = Perusahaan::find($id);
            return view('posisi.index', ['perushaan' => $perusahaan], compact('perusahaan'));
    }
  */
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
		if (Auth::check()) {
        //get post by ID
        $posisi = Posisi::findOrFail($id);
		$idusers=$posisi->idusers;
		$idperusahaan = $posisi->id_perusahaan;
		$perusahaan= \DB::table('perusahaans')->where('idusers', '=', '1')->get();
		$bagian= \DB::table('bagians')->orderBy('nama_bagian')->where('id_perusahaan', '=', $idperusahaan)->get();


        //render view with post
        return view('posisi.edit', compact('posisi','perusahaan','bagian'));
		}else{
            return view('login');
        }
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
		if (Auth::check()) {
        //validate form
        $this->validate($request, [
            //'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            //'title'     => 'required|min:5',
            //'content'   => 'required|min:10'
        ]);

        //get post by ID
        $posisi = Posisi::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/bagian', $image->hashName());

            //delete old image
            Storage::delete('public/posisi/'.$posisi->image);

            //update post with new image
            $posisi->update([
                'id_perusahaan'     => $request->id_perusahaan,
                'id_bagian'     => $request->id_bagian,
                'nama_posisi'   => $request->nama_posisi,
                'jenis_gaji'   => $request->jenis_gaji,
                'gaji_pokok'   => $request->gaji_pokok,
                'gaji_lembur_perjam'   => $request->gaji_lembur_perjam
            ]);

        } else {

            //update post without image
            $posisi->update([
                'id_perusahaan'     => $request->id_perusahaan,
                'id_bagian'     => $request->id_bagian,
                'nama_posisi'   => $request->nama_posisi,
                'jenis_gaji'   => $request->jenis_gaji,
                'gaji_pokok'   => $request->gaji_pokok,
                'gaji_lembur_perjam'   => $request->gaji_lembur_perjam
            ]);
        }

        //redirect to index
        return redirect()->route('posisi.index')->with(['success' => 'Data Berhasil Diubah!']);
		}else{
            return view('login');
        }
    }
	
	/**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
		if (Auth::check()) {
        //get post by ID
        $posisi = Posisi::findOrFail($id);

        //delete image
        Storage::delete('public/posisi/'. $posisi->image);

        //delete post
        $posisi->delete();

        //redirect to index
        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
		}else{
            return view('login');
        }
    }

}