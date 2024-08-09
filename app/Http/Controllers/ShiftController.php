<?php
namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Session;

class ShiftController extends Controller
{
    public function index()
{
$shifts = Shift::where('idusers', '=', \Auth::user()->idusers)->get();
		return view('shifts.index', compact('shifts'));
}


    public function create()
    {
        return view('shifts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_shift' => 'required|string|max:255',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
        ]);
        Shift::create($request->all());
        return redirect()->route('shifts.index')->with('success', 'Shift created successfully.');
    }

    public function edit(Shift $shift)
    {
        return view('shifts.edit', compact('shift'));
    }
    
public function update(Request $request, $id)
{
    $request->validate([
        'nama_shift' => 'required|string|max:255',
        'jam_masuk' => 'required|date_format:H:i',
        'jam_keluar' => 'required|date_format:H:i',
    ]);

    Log::info('Data yang diterima untuk update:', $request->all()); // Log data yang diterima
    $updated = Shift::findOrFail($id);
   // $updated = $shift->update($request->all());
    $updated->update([
                    'nama_shift' => $request->nama_shift,
                    'jam_masuk' => $request->jam_masuk,
                    'jam_keluar' => $request->jam_keluar
                ]);
    Log::info('Hasil update:', ['updated' => $updated]); // Log hasil update

    return redirect()->route('shifts.index')->with('success', 'Shift updated successfully.');
}
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('shifts.index')->with('success', 'Shift deleted successfully.');
    }
}

?>