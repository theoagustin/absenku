<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\Perusahaan;
use App\Models\Bagian;
use App\Models\Posisi;
use App\Models\Absensi;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use App\Post;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Session;

class PerusahaanController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        if(Auth::check()) {
            // dd('asd');
            //get posts
            $idusers = Auth::user()->idusers;
            $bagian = \DB::table('bagians')->where('idusers', '=', $idusers)->get();
            $posisi = \DB::table('posisis')
                ->join('bagians', 'posisis.id_bagian', '=', 'bagians.id')->select('posisis.*', 'bagians.nama_bagian')
                ->where('posisis.idusers', $idusers)->get();

            if (Auth::user()->role_level == 1) {
                $perusahaan = Perusahaan::withCount('karyawans')->get();
                return view('perusahaan.index', compact('perusahaan', 'bagian', 'posisi'));
            } else {

                $data = \DB::table('perusahaans')
                    ->join('users', 'perusahaans.idusers', '=', 'users.idusers')->select('perusahaans.*', 'users.role_level')
                    ->where('perusahaans.idusers', $idusers)->get();
                foreach ($data as $row) {
                    if ("$row->id" <> "") {

                        //render view with posts

                        $perusahaan = Perusahaan::where('idusers', '=', $idusers)->get();
                        return view('perusahaan.index', compact('perusahaan', 'bagian', 'posisi'));
                    } else {
                        //$perusahaan = Perusahaan::where('idusers', '=', $idusers)->get();
                        return view('perusahaan.create');
                    }
                }
            }
            return view('perusahaan.create');
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
            return view('perusahaan.create');
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
            //validate form
            $validator = Validator::make($request->all(), [
                'nama_perusahaan' => 'required|string',
                'alamat' => 'required|string',
                'owner' => 'required|string',
                'bidang' => 'required|string',
                'email' => 'required|email',
                'telp' => 'required|numeric',
                'max_jarak_absen' => 'required|int'
            ], [
                'nama_perusahaan.required' => 'Mohon isi nama perusahaan.',
                'alamat.required' => 'Mohon isi alamat perusahaan.',
                'owner.required' => 'Mohon isi nama owner perusahaan.',
                'bidang.required' => 'Mohon isi bidang perusahaan.',
                'email.required' => 'Mohon isi email perusahaan.',
                'email.email' => 'Email tidak valid.',
                'telp.required' => 'Mohon isi nomor telp. perusahaan.',
                'telp.numeric' => 'Mohon isi nomor telp. perusahaan dengan angka.',
                'max_jarak_absen' => 'Mohon tentukan jarak lokasi absen ke perusahaan.'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Perusahaan::create([
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telp' => $request->telp,
                'owner' => $request->owner,
                'bidang' => $request->bidang,
                'latitude' => $request->lat,
                'langitude' => $request->lan,
                'max_jarak_absen' => $request->max_jarak_absen,
                'idusers' => Auth::user()->idusers
            ]);

            //redirect to index
            return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
            $perusahaan = Perusahaan::findOrFail($id);

            //render view with post
            return view('perusahaan.show', compact('perusahaan'));
        } else {
            return view('login');
        }
    }

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
            $perusahaan = Perusahaan::findOrFail($id);

            //render view with post
            return view('perusahaan.edit', compact('perusahaan'));
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
            $validator = Validator::make($request->all(), [
                'nama_perusahaan' => 'required|string',
                'alamat' => 'required|string',
                'owner' => 'required|string',
                'bidang' => 'required|string',
                'email' => 'required|email',
                'telp' => 'required|numeric',
                'max_jarak_absen' => 'required|int'
            ], [
                'nama_perusahaan.required' => 'Mohon isi nama perusahaan.',
                'alamat.required' => 'Mohon isi alamat perusahaan.',
                'owner.required' => 'Mohon isi nama owner perusahaan.',
                'bidang.required' => 'Mohon isi bidang perusahaan.',
                'email.required' => 'Mohon isi email perusahaan.',
                'email.email' => 'Email tidak valid.',
                'telp.required' => 'Mohon isi nomor telp. perusahaan.',
                'telp.numeric' => 'Mohon isi nomor telp. perusahaan dengan angka.',
                'max_jarak_absen' => 'Mohon tentukan jarak lokasi absen ke perusahaan.'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //get post by ID
            $perusahaan = Perusahaan::findOrFail($id);

            //check if image is uploaded
            if ($request->hasFile('image')) {

                //upload new image
                $image = $request->file('image');
                $image->storeAs('public/perusahaan', $image->hashName());

                //delete old image
                Storage::delete('public/perusahaan/' . $perusahaan->image);

                //update post with new image
                $perusahaan->update([
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'telp' => $request->telp,
                    'owner' => $request->owner,
                    'bidang' => $request->bidang,
                    'max_jarak_absen' => $request->max_jarak_absen,
                    'latitude' => $request->lat,
                    'langitude' => $request->lan
                ]);

            } else {

                //update post without image
                $perusahaan->update([
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'telp' => $request->telp,
                    'owner' => $request->owner,
                    'bidang' => $request->bidang,
                    'latitude' => $request->lat,
                    'langitude' => $request->lan,
                    'max_jarak_absen' => $request->max_jarak_absen,
                ]);
            }

            //redirect to index
            return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            return view('login');
        }
    }
    public function approve(Request $request, $id)
    {
        $dataupdate = ['approv' => $request->approv];
        $absensi = \DB::table('perusahaans')->where('id', '=', $id)->update($dataupdate);
        $response = array(
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $dataupdate
        );
        return json_encode($response);
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
            $perusahaan = Perusahaan::findOrFail($id);

            //delete image
            Storage::delete('public/perusahaan/' . $perusahaan->image);

            //delete post
            $perusahaan->delete();

            //redirect to index
            return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return view('login');
        }
    }

    public function saveBagian(Request $request)
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
        $idusers = Auth::user()->idusers;
        //create post
        Bagian::create([
            'id_perusahaan' => $request->id_perusahaan,
            'nama_bagian' => $request->nama_bagian,
            'idusers' => $idusers
        ]);

        //redirect to index
        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function savePosisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_perusahaan' => 'required|int',
            'id_bagian' => 'required|int',
            'nama_posisi' => 'required|string'
        ], [
            'id_bagian.required' => 'Mohon pilih bagian',
            'nama_posisi.required' => 'Mohon isi nama posisi.',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idusers = Auth::user()->idusers;

        Posisi::create([
            'id_perusahaan' => $request->id_perusahaan,
            'id_bagian' => $request->id_bagian,
            'nama_posisi' => $request->nama_posisi,
            'idusers' => $idusers
        ]);

        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function perusahaan_approve()
    {
        if (Auth::check()) {
            //get posts
            $idusers = Auth::user()->idusers;
            $bagian = \DB::table('bagians')->where('idusers', '=', $idusers)->get();
            $posisi = \DB::table('posisis')
                ->join('bagians', 'posisis.id_bagian', '=', 'bagians.id')->select('posisis.*', 'bagians.nama_bagian')
                ->where('posisis.idusers', $idusers)->get();

            if (Auth::user()->role_level == 1) {
                $perusahaan = Perusahaan::withCount('karyawans')->where('approv', '=', 'Y')->paginate(5);
                return view('perusahaan.index', compact('perusahaan', 'bagian', 'posisi'));
            } else {

                $data = \DB::table('perusahaans')
                    ->join('users', 'perusahaans.idusers', '=', 'users.idusers')->select('perusahaans.*', 'users.role_level')
                    ->where('perusahaans.idusers', $idusers)->get();
                foreach ($data as $row) {
                    if ("$row->id" <> "") {

                        //render view with posts

                        $perusahaan = Perusahaan::where('idusers', '=', $idusers)->get();
                        return view('perusahaan.index', compact('perusahaan', 'bagian', 'posisi'));
                    } else {
                        //$perusahaan = Perusahaan::where('idusers', '=', $idusers)->get();
                        return view('perusahaan.create');
                    }
                }
            }
            return view('perusahaan.create');
        } else {
            return view('login');
        }
    }
    public function dashboard(Request $request) {
        $date = $request->input('date', date('Y-m-d')); // Default to today's date if no date is provided
        $hadir = Absensi::where('tanggal', $date)->where('status_kehadiran', 'h')->count();
        $izin = Absensi::where('tanggal', $date)->where('status_kehadiran', 'i')->count();
        $sakit = Absensi::where('tanggal', $date)->where('status_kehadiran', 's')->count();

        return view('perusahaan.dashboard', compact('hadir', 'izin', 'sakit', 'date'));
    }
    public function edit_perusahaan()
    {
        // Ambil id pengguna yang login
        $userId = Auth::id();

        // Ambil data perusahaan yang sesuai dengan iduser
        $perusahaan = Perusahaan::where('idusers', $userId)->firstOrFail();

        return view('perusahaan.profil', compact('perusahaan'));
    }

    public function update_perusahaan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
            'bidang' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'latitude' => 'required|numeric',
            'langitude' => 'required|numeric',
            'max_jarak_absen' => 'required|numeric',
        ]);

        // Ambil id pengguna yang login
        $userId = Auth::id();

        // Update data perusahaan
        $perusahaan = Perusahaan::where('idusers', $userId)->firstOrFail();
        $perusahaan->update($request->all());

        return redirect()->route('perusahaan.edit_perusahaan')->with('success', 'Data perusahaan berhasil diperbarui.');
    }
}
