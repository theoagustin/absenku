<?php
namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftKaryawan;
use App\Models\Karyawan;
use App\Models\Perusahaan;
use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftKaryawanController extends Controller
{
    public function index(Request $request)
    {
        $perusahaan_id = Perusahaan::where('idusers', Auth::id())->get();
        $karyawans = Karyawan::where('id_perusahaan', Auth::id())->get();
        $shifts = Shift::where('idusers', Auth::user()->idusers)->get();
        $bagians = Bagian::where('idusers', Auth::id())->get();

        $query = ShiftKaryawan::with('shift', 'karyawan');
       if ($request->has('filter_bagian') && $request->filter_bagian != '') {
        $query->whereHas('karyawan', function($q) use ($request) {
            $q->where('id_bagian', $request->filter_bagian)
              ->where('idusers', Auth::id());
        });
    }
        $shiftKaryawans = $query->join('karyawans', 'karyawans.id', '=', 'shift_karyawans.id_karyawan')->join('perusahaans', 'perusahaans.idusers', '=', 'karyawans.idusers')->where('perusahaans.idusers', Auth::id())->get();
        // dd($shiftKaryawans);
        return view('shift_karyawan.index', compact('shiftKaryawans', 'karyawans', 'shifts', 'bagians'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        $shifts = Shift::all();
        return view('shift_karyawan.create', compact('karyawans', 'shifts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'id_shift' => 'required|exists:shifts,id',
        ]);

        ShiftKaryawan::create($request->all());
        return redirect()->route('shift_karyawan.index')->with('success', 'Shift Karyawan created successfully.');
    }

    public function edit(ShiftKaryawan $shiftKaryawan)
    {
        $karyawans = Karyawan::all();
        $shifts = Shift::all();
        return view('shift_karyawan.edit', compact('shiftKaryawan', 'karyawans', 'shifts'));
    }

    public function update(Request $request, $id)
    {
        $shiftKaryawan = ShiftKaryawan::where('id_karyawan',$id)->update([
            'id_shift' => $request->id_shift
        ]);
        if($shiftKaryawan) {
            return response()->json(['success' => 'Shift updated successfully.']);
        }
        return response()->json(['error' => 'Shift not found.'], 404);
    }

    public function destroy($id)
    {
        $shiftKaryawan = ShiftKaryawan::find($id);

        if ($shiftKaryawan) {
            $shiftKaryawan->delete();
            return response()->json(['success' => 'Shift deleted successfully.']);
        }

        return response()->json(['error' => 'Shift not found.'], 404);
    }
}

?>