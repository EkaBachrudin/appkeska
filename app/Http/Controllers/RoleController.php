<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataSekolah;
use App\Models\Role;
use App\Models\RolePolice;
use App\Models\RoleSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(){
        $sekolah = DataSekolah::orderBy('jenjang', 'asc')->get();
        $roles = Role::get();
        return view('pages.role.index', compact('sekolah', 'roles'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'role'          => 'required',
            'sekolah'       => 'required',
        ]);

        $request->dataSiswa             != null ? $dataSiswaCheckbox        = 1 :  $dataSiswaCheckbox = 0;
        $request->dataFasilitas         != null ? $dataFasilitasCheckbox    = 1 :  $dataFasilitasCheckbox = 0;
        $request->dataSekolah           != null ? $dataSekolahCheckbox      = 1 :  $dataSekolahCheckbox = 0;
        $request->dataGuru              != null ? $dataGuruCheckbox         = 1 :  $dataGuruCheckbox = 0;
        $request->rolepermission        != null ? $rolepermissionCheckbox   = 1 :  $rolepermissionCheckbox = 0;
        $request->user                  != null ? $userCheckbox             = 1 :  $userCheckbox = 0;


        $role = Role::create([
            'name'      => $validated['role'],
            'slug'       =>\Str::slug($validated['role'], '-'),
        ]);

        RolePolice::create([
            'role_id'           => $role->id,
            'data_siswa'        => $dataSiswaCheckbox,
            'data_fasilitas'    => $dataFasilitasCheckbox,
            'data_sekolah'      => $dataSekolahCheckbox,
            'data_guru'         => $dataGuruCheckbox,
            'role_permission'   => $rolepermissionCheckbox,
            'user'              => $userCheckbox,
        ]);

        foreach($validated['sekolah'] as $sekolah){
            RoleSekolah::insert([
                'role_id' => $role->id,
                'sekolah_id' => $sekolah,
            ]);
        }
    
        return back();   
    }

    public function getData($id){
        $role           = Role::where('id', $id)->first();
        $rolePolice     = RolePolice::where('role_id', $id)->first();
        $roleSekolah    = RoleSekolah::where('role_id', $id)->get();

        return response()->json([
            'role'          => $role,
            'rolePolice'    => $rolePolice,
            'roleSekolah'   => $roleSekolah,
        ]);
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'role'          => 'required',
            'sekolah'       => 'required',
        ]);

        $request->dataSiswa             != null ? $dataSiswaCheckbox        = 1 :  $dataSiswaCheckbox = 0;
        $request->dataFasilitas         != null ? $dataFasilitasCheckbox    = 1 :  $dataFasilitasCheckbox = 0;
        $request->dataSekolah           != null ? $dataSekolahCheckbox      = 1 :  $dataSekolahCheckbox = 0;
        $request->dataGuru              != null ? $dataGuruCheckbox         = 1 :  $dataGuruCheckbox = 0;
        $request->rolepermission        != null ? $rolepermissionCheckbox   = 1 :  $rolepermissionCheckbox = 0;
        $request->user                  != null ? $userCheckbox             = 1 :  $userCheckbox = 0;

        $role = Role::find($id)->update([
            'name'      => $validated['role'],
            'slug'       =>\Str::slug($validated['role'], '-'),
        ]);

        RolePolice::where('role_id', $id)->update([
            'data_siswa'        => $dataSiswaCheckbox,
            'data_fasilitas'    => $dataFasilitasCheckbox,
            'data_sekolah'      => $dataSekolahCheckbox,
            'data_guru'         => $dataGuruCheckbox,
            'role_permission'   => $rolepermissionCheckbox,
            'user'              => $userCheckbox,
        ]);

        RoleSekolah::where('role_id', $id)->delete();

        foreach($validated['sekolah'] as $sekolah){
            RoleSekolah::insert([
                'role_id'       => $id,
                'sekolah_id'    => $sekolah,
            ]);
        }
    
        return back();   
    }

    public function delete($id){
        Role::find($id)->delete();
        RolePolice::where('role_id', $id)->delete();
        RoleSekolah::where('role_id', $id)->delete();
        return back();
    }
}
