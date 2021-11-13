<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(){
        $sekolahan = DataSekolah::get();
        $guru = DataGuru::get();
        return view('pages.data_guru.index', compact('sekolahan', 'guru'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'sekolah' => 'required',
            'guru' => 'required',
            'nip' => 'required',
        ]);

        $dataGuru = DataGuru::create([
            'sekolah_id' => $validated['sekolah'],
            'name' => $validated['guru'],
            'nip' => $validated['nip'],
        ]);
    
        return back();   
    }

    public function getData($id){
        $guru = DataGuru::where('id', $id)->first();

        return response()->json([
            'guru' => $guru,
        ]);
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'sekolah' => 'required',
            'guru' => 'required',
            'nip' => 'required',
        ]);

        DataGuru::where('id', $id)
        ->update([
            'sekolah_id' => $validated['sekolah'],
            'name' => $validated['guru'],
            'nip' => $validated['nip'],
        ]);
    
        return back();   
    }

    public function delete($id){
        DataGuru::find($id)->delete();
        return back();
    }
}
