<?php

namespace App\Http\Controllers;

use App\Models\experiences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class ExperiencesController extends Controller
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
        $exp=experiences::all();
        $id_datos=DB::table('datos')->where('status',1)->first();
        if ($id_datos == null) {
            return view('panel.experiences.create',['experiences'=>$exp,'id_datos'=>'']);
        }else{
        
            return view('panel.experiences.create',['experiences'=>$exp,'id_datos'=>$id_datos->id]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $expe=new experiences();
        $expe->id_datos=request('id_datos');
        $expe->place=request('place');
        $expe->position=request('position');
        $expe->date=request('date');
        $expe->orden = request('orden');
        $expe->description=request('description');
        $expe->save();

        return redirect()->route('panel.experiences.create');

    }

    /**
     * Display the specified resource.
     */
    public function show(experiences $experiences)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exp=experiences::find($id);
        return response()->json(['data'=>$exp], 200);
        // return view('panel.experiences.edit',['exp'=>$exp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id=request('id');
        $expe=experiences::findOrFail($id);
        $expe->place=request('place');
        $expe->position=request('position');
        $expe->date=request('date');
        $expe->orden = request('orden');
        $expe->description=request('description_update');
        $expe->save();

        return redirect()->route('panel.experiences.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(experiences $experiences)
    {
        $id=request('id_experience');
        $exp=experiences::find($id);
        $exp->delete();
        return redirect()->route('panel.experiences.create');
    }
}
