<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataSekolah;
use Illuminate\Http\Request;

class DataSekolahController extends Controller
{
    public function index(){
        $sekolahan = DataSekolah::get();
        return view('pages.data_sekolah.index', compact('sekolahan'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'jenjang' => 'required',
            'lokasi' => 'required',
        ]);

        $dataSekolah = DataSekolah::create([
            'name' => $validated['name'],
            'jenjang' => $validated['jenjang'],
            'lokasi' => $validated['lokasi'],
        ]);
    
        return back();   
    }

    public function getData($id){
        $sekolah = DataSekolah::where('id', $id)->first();

        return response()->json([
            'sekolah' => $sekolah,
        ]);
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'jenjang' => 'required',
            'lokasi' => 'required',
        ]);

        DataSekolah::where('id', $id)
        ->update([
            'name' => $validated['name'],
            'jenjang' => $validated['jenjang'],
            'lokasi' => $validated['lokasi'],
        ]);
    
        return back();   
    }

    public function delete($id){
        DataSekolah::find($id)->delete();
        return back();
    }
}
