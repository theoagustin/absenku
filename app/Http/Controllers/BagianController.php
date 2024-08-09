<?php

namespace App\Http\Controllers;

//import Model "Post

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
class BagianController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        //get posts
		/*$idusers=Auth::user()->idusers;
		 //$bagian1 = \App\Models\Bagian::where('idusers', $idusers)->get();
        $bagian = Bagian::where('idusers', '=', $idusers)->get();
		$idperusahaan = $bagian[0];
		$perusahaan= \DB::table('perusahaans')->find($idperusahaan);
		*/
		//sqlCopy code$table = 'bagians'; 
 $idusers=Auth::user()->idusers;
$bagian = \DB::table('bagians')->join('perusahaans', 'bagians.id_perusahaan', '=', 'perusahaans.id')->select('bagians.*', 'perusahaans.nama_perusahaan')->where('bagians.idusers', $idusers)->get(); 
		//render view with post
        return view('bagian.index', compact('bagian'));
    }
	
	
    /**
     * index
     *
     * @return View
     */
    public function create(): View
    {
        return view('bagian.create');
    }
	

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            //'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            //'title'     => 'required|min:5',
            //'content'   => 'required|min:10'
        ]);

        //upload image
        //$image = $request->file('image');
        //$image->storeAs('public/posts', $image->hashName());
		$idusers=Auth::user()->idusers;
        //create post
        Bagian::create([
            	'id_perusahaan'     => $request->id_perusahaan,
                'nama_bagian'   => $request->nama_bagian,
                'idusers'   => $idusers
        ]);

        //redirect to index
        return redirect()->route('bagian.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $bagian = Bagian::findOrFail($id);

        //render view with post
        return view('bagian.show', compact('bagian'));
    }
  
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $bagian = Bagian::findOrFail($id);

        //render view with post
        return view('bagian.edit', compact('bagian'));
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
        //validate form
        $this->validate($request, [
            //'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            //'title'     => 'required|min:5',
            //'content'   => 'required|min:10'
        ]);

        //get post by ID
        $bagian = Bagian::findOrFail($id);
		$idusers=Auth::user()->idusers;
        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/bagian', $image->hashName());

            //delete old image
            Storage::delete('public/bagian/'.$bagian->image);

            //update post with new image
            $bagian->update([
                'id_perusahaan'     => $request->id_perusahaan,
                'nama_bagian'   => $request->nama_bagian
            ]);

        } else {

            //update post without image
            $bagian->update([
                'id_perusahaan'     => $request->id_perusahaan,
                'nama_bagian'   => $request->nama_bagian,
				'idusers'=>$idusers
            ]);
        }

        //redirect to index
        return redirect()->route('bagian.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
	
	/**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $bagian = Bagian::findOrFail($id);

        //delete image
        Storage::delete('public/bagian/'. $bagian->image);

        //delete post
        $bagian->delete();

        //redirect to index
        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}