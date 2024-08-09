<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\Karyawan;
use App\Models\Shift;
use App\Models\Posisi;
use App\Models\Bagian;
use App\Models\Perusahaan;

use App\Models\ShiftKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Session;

class KaryawanController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        if (Auth::check()) {
            //get posts
            //$karyawan = Karyawan::where('idusers', '=', '1')->get();
            $idusers = Auth::user()->idusers;
            $data = \DB::table('karyawans')
                ->join('perusahaans', 'karyawans.id_perusahaan', '=', 'perusahaans.id')
                ->join('bagians', 'karyawans.id_bagian', '=', 'bagians.id')
                ->join('posisis', 'karyawans.id_posisi', '=', 'posisis.id')->select('karyawans.*', 'perusahaans.nama_perusahaan', 'bagians.nama_bagian', 'posisis.nama_posisi')
                ->where('karyawans.idusers', $idusers)->get();
            //render view with posts
            return view('karyawan.index', compact('data'));
        } else {
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
            //return view('karyawan.create');

            $idusers = Auth::user()->idusers;
            //$bagian = \DB::table('bagians')->select('id', 'nama_bagian', 'id_perusahaan')->where('id_perusahaan', '=', '1')->first();

            //$courses = Course::orderBy('nama_bagian')->get();
            $perusahaan = \DB::table('perusahaans')->where('idusers', '=', $idusers)->get();
            // Note: use DB::table('courses') if you don't have a `Course` model, but models are preferred

            $bagian = \DB::table('bagians')->orderBy('nama_bagian')->where('idusers', '=', $idusers)->get();
            // Note: use DB::table('courses') if you don't have a `Course` model, but models are preferred

            $posisi = \DB::table('posisis')->orderBy('nama_posisi')->where('idusers', '=', $idusers)->get();


            return view('karyawan.create', compact('perusahaan', 'bagian', 'posisi'));
        } else {
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
            $validator = Validator::make($request->all(), [
                'id_perusahaan' => 'required|int',
                'id_bagian' => 'required|int',
                'id_posisi' => 'required|int',
                'nama' => 'required|string',
                'nik' => 'required|numeric|digits_between:1,10',
                'jekel' => 'required|in:L,P',
                'alamat' => 'required|string',
                'telp' => 'required|numeric',
                'email' => 'required|email',
                'tgl_mulai_bekerja' => 'required|date',

            ], [
                'nama.required' => 'Mohon isi nama karyawan.',
                'nik.required' => 'Mohon isi NIK karyawan.',
                'nik.numeric' => 'Mohon isi NIK karyawan hanya dengan angka.',
                'nik.digits' => 'Mohon isi NIK karyawan max. 10 digit.',
                'jekel.required' => 'Mohon pilih jenis kelamin karyawan.',
                'alamat.required' => 'Mohon isi alamat karyawan.',
                'telp.required' => 'Mohon isi telp. karyawan.',
                'telp.numeric' => 'Mohon isi telp. karyawan hanya dengan angka.',
                'email.required' => 'Mohon isi email karyawan.',
                'email.email' => 'Email tidak valid.',
                'tgl_mulai_bekerja.required' => 'Mohon isi tgl. mulai bekerja karyawan.',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $idusers = Auth::user()->idusers;
            $pass = $request->nik;
            $username = $request->nik;
            $create_users = \DB::table('users')->insert([
                'nama' => $request->nama,
                'email' => $request->email,
                'role_level' => "3",
                'username' => $username,
                'password' => \Hash::make($pass),
                'pass_text' => $pass,
            ]);

            // Get idusers
            $datas = \DB::table('users')->where('pass_text', '=', $pass)->get();

            foreach ($datas as $data) {
                //create post
                Karyawan::create([

                    'id_perusahaan' => $request->id_perusahaan,
                    'id_bagian' => $request->id_bagian,
                    'id_posisi' => $request->id_posisi,
                    'nama' => $request->nama,
                    'jekel' => $request->jekel,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'npwp' => $request->npwp,
                    'tgl_mulai_bekerja' => $request->tgl_mulai_bekerja,
                    'idakun' => $data->idusers,
                    'idusers' => $idusers,
                ]);
            }
            $get_lastkaryawan = Karyawan::latest()->limit(1)->get();
            $get_lastshift = Shift::latest()->limit(1)->get();
            // dd($get_lastkaryawan[0]->id);
            ShiftKaryawan::create([
                'id_karyawan' => $get_lastkaryawan[0]->id,
                'id_shift' => $get_lastshift[0]->id,
            ]);

            //redirect to index
            return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
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
            // $karyawan = Karyawan::findOrFail($id);
            $idusers = Auth::user()->idusers;
            $data = \DB::table('karyawans')
                ->join('perusahaans', 'karyawans.id_perusahaan', '=', 'perusahaans.id')
                ->join('bagians', 'karyawans.id_bagian', '=', 'bagians.id')
                ->join('posisis', 'karyawans.id_posisi', '=', 'posisis.id')->select('karyawans.*', 'perusahaans.nama_perusahaan', 'bagians.nama_bagian', 'posisis.nama_posisi', 'posisis.gaji_pokok')
                ->where('karyawans.id', $id)->get();
            //render view with posts
            return view('karyawan.show', compact('data'));
        } else {
            return view('login');
        }

        //render view with post
        //return view('karyawan.show', compact('karyawan'));
    }
    /*
       public function getPerusahaan($id)
       {
            $perusahaan = Perusahaan::find($id);
               return view('karyawan.index', ['perushaan' => $perusahaan], compact('perusahaan'));
       }
     */
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(Request $request, string $id): View
    {
        if (Auth::check()) {
            //get post by ID
            $karyawan = Karyawan::findOrFail($id);
            $idusers = $karyawan->idusers;
            $idperusahaan = $karyawan->id_perusahaan;
            $perusahaan = \DB::table('perusahaans')->where('idusers', '=', Auth::user()->idusers)->get();
            $bagian = \DB::table('bagians')->orderBy('nama_bagian')->where('id_perusahaan', '=', $idperusahaan)->get();
            $posisi = \DB::table('posisis')->orderBy('nama_posisi')->where('id_perusahaan', '=', $idperusahaan)->get();
            // dd($idperusahaan);

            //render view with post
            return view('karyawan.edit', compact('karyawan', 'perusahaan', 'bagian', 'posisi'));
        } else {
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
            $validator = Validator::make($request->all(), [
                'id_perusahaan' => 'required|int',
                'id_bagian' => 'required|int',
                'id_posisi' => 'required|int',
                'nama' => 'required|string',
                'nik' => 'required|numeric|digits_between:1,10',
                'jekel' => 'required|in:L,P',
                'alamat' => 'required|string',
                'telp' => 'required|numeric',
                'email' => 'required|email',
                'tgl_mulai_bekerja' => 'required|date',

            ], [
                'nama.required' => 'Mohon isi nama karyawan.',
                'nik.required' => 'Mohon isi NIK karyawan.',
                'nik.numeric' => 'Mohon isi NIK karyawan hanya dengan angka.',
                'nik.digits_between' => 'Mohon isi NIK karyawan max. 10 digit.',
                'jekel.required' => 'Mohon pilih jenis kelamin karyawan.',
                'alamat.required' => 'Mohon isi alamat karyawan.',
                'telp.required' => 'Mohon isi telp. karyawan.',
                'telp.numeric' => 'Mohon isi telp. karyawan hanya dengan angka.',
                'email.required' => 'Mohon isi email karyawan.',
                'email.email' => 'Email tidak valid.',
                'tgl_mulai_bekerja.required' => 'Mohon isi tgl. mulai bekerja karyawan.',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //get post by ID
            $karyawan = Karyawan::findOrFail($id);

            //check if image is uploaded
            if ($request->hasFile('image')) {

                //upload new image
                $image = $request->file('image');
                $image->storeAs('public/karyawan', $image->hashName());

                //delete old image
                Storage::delete('public/karyawan/' . $karyawan->image);

                //update post with new image
                $karyawan->update([
                    'id_perusahaan' => $request->id_perusahaan,
                    'id_bagian' => $request->id_bagian,
                    'id_posisi' => $request->id_posisi,
                    'nama' => $request->nama,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'tgl_mulai_bekerja' => $request->tgl_mulai_bekerja,
                    'jekel' => $request->jekel
                ]);

            } else {

                //update post without image
                $karyawan->update([
                    'id_perusahaan' => $request->id_perusahaan,
                    'id_bagian' => $request->id_bagian,
                    'id_posisi' => $request->id_posisi,
                    'nama' => $request->nama,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'tgl_mulai_bekerja' => $request->tgl_mulai_bekerja,
                    'jekel' => $request->jekel
                ]);
            }

            //redirect to index
            return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
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
            $karyawan = Karyawan::findOrFail($id);

            //delete image
            Storage::delete('public/posisi/' . $karyawan->image);

            //delete post
            $karyawan->delete();

            //redirect to index
            return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return view('login');
        }
    }

}
