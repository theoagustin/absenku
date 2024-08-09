<?php
  
namespace App\Http\Controllers;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Log;
  
class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequest()
    {
        return view('ajaxRequest');
    }
     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();
          $dataupdate=['approv'=> $request->approv];
			$absensi= \DB::table('perusahaans')->where('id','=',$request->idp)->update($dataupdate);
        //Log::info($input);
     
        return response()->json(['success'=>'Got Simple Ajax Request.'.$request->approv]);
    }
}