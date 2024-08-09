<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiAdminController extends Controller
{
    public function index()
    {
        $cutis = Cuti::with('user')->get();
        return view('cuti.index_admin', compact('cutis'));
    }
    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'Approve';
        $cuti->save();

        return redirect()->route('cuti.index_admin')->with('success', 'Cuti approved successfully.');
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'Reject';
        $cuti->save();

        return redirect()->route('cuti.index_admin')->with('success', 'Cuti rejected successfully.');
    }
}
