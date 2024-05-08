<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\datosdetails;
use App\Models\experiences;
use App\Models\certificates;
use App\Models\datos;

class HomeController extends Controller
{
    public function home(){
        $datos=datos::where('status',1)->first();
        if ($datos) {
            $experiences=experiences::where('id_datos',$datos->id)
            ->orderBy('orden','asc')->orderBy('id','asc')->get();
            $certificates=certificates::where('id_datos',$datos->id)
            ->orderBy('orden','asc')->orderBy('id','asc')->get();
            
            return view('home',['datos'=>$datos,'experiences'=>$experiences,'certificates'=>$certificates]);
        }
        return view('home',compact('datos'));
    }
    public function certificates(){
        $datos=datos::where('status',1)->first();
        if ($datos) {
            $certificates=certificates::where('id_datos',$datos->id)
            ->orderBy('orden','asc')->orderBy('id','asc')->get();
            
            return view('certificates',['datos'=>$datos,'certificates'=>$certificates]);
        }
        return view('certificates',compact('datos'));
    }
}
