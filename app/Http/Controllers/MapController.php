<?php

    namespace App\Http\Controllers;

    use App\Models\Article;
    use App\Models\User;
    use Illuminate\Http\Request;

    class MapController extends Controller{
    
         

        public function showMap(Request $request){
        

          $locations = [
            ["lat" => 12.9716, "lng" => 77.5946],
            ["lat" => 26.9124, "lng" => 75.7873],
            ["lat" => 22.2587, "lng" => 71.1924],
          ];
          return view("show-map",['locations'=>$locations]);
		}
	}