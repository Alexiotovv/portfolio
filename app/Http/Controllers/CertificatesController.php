<?php

namespace App\Http\Controllers;

use App\Models\certificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class CertificatesController extends Controller
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
        $cert=DB::table('certificates')->orderBy('orden','asc')->get();
        $id_datos=DB::table('datos')->where('status',1)->first();
        if ($id_datos == null) {
            return view('panel.certificates.create',['certificates'=>$cert,'id_datos'=>'']);
        }else{
        
            return view('panel.certificates.create',['certificates'=>$cert,'id_datos'=>$id_datos->id]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cert=new certificates();
        $cert->id_datos=request('id_datos');
        $cert->institute=request('institute');
        $cert->title=request('title');
        $cert->date=request('date');
        $cert->description=request('description');
        if ($request->hasFile('logo')){
            
            $file = request('logo')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('logo')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('logo')->storeAs('logos/',$archivo,'public');//refiere carpeta publica es el nombre de disco            
            $cert->logo = $archivo;
        }
        if ($request->hasFile('file')){
            $file = request('file')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('file')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('file')->storeAs('files/',$archivo,'public');//refiere carpeta publica es el nombre de disco            
            $cert->file = $archivo;
        }
        $cert->orden = request('orden');
        $cert->save();

        return redirect()->route('panel.certificates.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(certificates $certificates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cert=certificates::find($id);
        return response()->json(['data'=>$cert], 200);
    }


    public function update(Request $request)
    {
        $id=request('id');
        $cert=certificates::findOrFail($id);
        $cert->institute=request('institute');
        $cert->title=request('title');
        $cert->date=request('date');
        $cert->description=request('description_update');
        if ($request->hasFile('logo')){
            //eliminando logo anterior
            $previousLogo = $cert->logo;
            if ($previousLogo) {
                Storage::disk('public')->delete('logos/' . $previousLogo);
            }
            $file = request('logo')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('logo')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('logo')->storeAs('logos/',$archivo,'public');//refiere carpeta publica es el nombre de disco            
            $cert->logo = $archivo;
        }
        if ($request->hasFile('file')){
            //eliminando file anterior
            $previousFile = $cert->file;
            if ($previousFile) {
                Storage::disk('public')->delete('logos/' . $previousFile);
            }
            $file = request('file')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('file')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('file')->storeAs('files/',$archivo,'public');//refiere carpeta publica es el nombre de disco            
            $cert->file = $archivo;
        }
        $cert->orden = request('orden');
        $cert->save();

        return redirect()->route('panel.certificates.create');
    }

    public function destroy(certificates $certificates)
    {
        
        $id=request('id_certificate');
        
        $cert=certificates::find($id);
        $cert->delete();
        return redirect()->route('panel.certificates.create');
    }
}
