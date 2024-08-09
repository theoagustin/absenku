<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\ListBagian;

use Illuminate\Http\Request;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class ListBagianController extends Controller
{
    /**
     * index
     *
     * @return View
     */
	public function getBagian($id_perusahaan)
	{
		$bagian = Bagian::where('id_perusahaan', $id_perusahaan)->get();
		return response()->json($bagian);
	}
}