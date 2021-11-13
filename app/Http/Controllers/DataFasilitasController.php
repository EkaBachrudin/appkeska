<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataFasilitas;
use App\Models\DataSekolah;
use Illuminate\Http\Request;

class DataFasilitasController extends Controller
{
    public function index(){
        $sekolahan = DataSekolah::orderBy('jenjang', 'asc')->get();
        $fasilitas = DataFasilitas::get();
        return view('pages.data_fasilitas.index', compact('sekolahan', 'fasilitas'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'sekolah' => 'required',
            'fasilitas' => 'required',
            'jumlah' => 'required',
        ]);

        $dataFasilitas = DataFasilitas::create([
            'sekolah_id' => $validated['sekolah'],
            'name' => $validated['fasilitas'],
            'jumlah' => $validated['jumlah'],
        ]);
    
        return back();   
    }

    public function getData($id){
        $fasilitas = DataFasilitas::where('id', $id)->first();

        return response()->json([
            'fasilitas' => $fasilitas,
        ]);
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'sekolah' => 'required',
            'fasilitas' => 'required',
            'jumlah' => 'required',
        ]);

        DataFasilitas::where('id', $id)
        ->update([
            'sekolah_id' => $validated['sekolah'],
            'name' => $validated['fasilitas'],
            'jumlah' => $validated['jumlah'],
        ]);
    
        return back();   
    }

    public function delete($id){
        DataSekolah::find($id)->delete();
        return back();
    }
}
