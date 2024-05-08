<?php

namespace App\Http\Controllers;

use App\Models\datos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use DB;
class DatosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datos=DB::table('datos')
        ->get();
        
        return view('panel.datos.create',['datos'=>$datos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        datos::query()->update(['status' => 0]);

        $datos = new datos();
        $datos->names=request('names');
        $datos->description=request('description');
        if ($request->hasFile('photo')){
            $file = request('photo')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('photo')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('photo')->storeAs('datos/',$archivo,'public');//refiere carpeta publica es el nombre de disco            
            $datos->photo = $archivo;
        }
        $datos->status = request('status');
        $datos->detalles = request('detalles');
        $datos->save();

        return redirect()->route('panel.datos.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(datos $datos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datos=datos::find($id);
        return response()->json(['data'=>$datos], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        datos::query()->update(['status' => 0]);
        
        $id=request('id');
        $datos = datos::findOrFail($id);
        $datos->names=request('names');
        $datos->description=request('description');
        if ($request->hasFile('photo')){
             //eliminando photo anterior
             $previousPhoto = $datos->photo;
             if ($previousPhoto) {
                 Storage::disk('public')->delete('datos/' . $previousPhoto);
             }


            $file = request('photo')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('photo')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('photo')->storeAs('datos/',$archivo,'public');//refiere carpeta publica es el nombre de disco            
            $datos->photo = $archivo;
            
           
        }
        $datos->status = request('status');
        $datos->detalles = request('detalles');
        $datos->save();


        return redirect()->route('panel.datos.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(datos $datos)
    {
        //
    }
}
