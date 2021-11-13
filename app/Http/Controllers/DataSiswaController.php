<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataSekolah;
use App\Models\DataSiswa;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(){
        $sekolahan = DataSekolah::orderBy('jenjang', 'asc')->get();
        $siswa = DataSiswa::get();
        return view('pages.data_siswa.index', compact('sekolahan', 'siswa'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'sekolah' => 'required',
            'siswa' => 'required',
            'nis' => 'required',
            'kelas' => 'required',
        ]);

        $dataSiswa = DataSiswa::create([
            'sekolah_id' => $validated['sekolah'],
            'name' => $validated['siswa'],
            'nis' => $validated['nis'],
            'kelas' => $validated['kelas'],
        ]);
    
        return back();   
    }

    public function getData($id){
        $siswa = DataSiswa::where('id', $id)->first();

        return response()->json([
            'siswa' => $siswa,
        ]);
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'sekolah' => 'required',
            'siswa' => 'required',
            'nis' => 'required',
            'kelas' => 'required',
        ]);

        DataSiswa::where('id', $id)
        ->update([
            'sekolah_id' => $validated['sekolah'],
            'name' => $validated['siswa'],
            'nis' => $validated['nis'],
            'kelas' => $validated['kelas'],
        ]);
    
        return back();   
    }

    public function delete($id){
        DataSiswa::find($id)->delete();
        return back();
    }
}
