<?php

namespace App\Http\Controllers;

use App\Models\MedicalDeviceGroup;
use Illuminate\Http\Request;

class MedicalDeviceGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kelompok Alkes';
        $medicalDeviceGroups = MedicalDeviceGroup::orderBy('nama_kelompok_alat_kesehatan', 'asc')->get();
        return view('medicalEquipment.kelompok_alkes.index', compact('title', 'medicalDeviceGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kelompok_alat_kesehatan' => 'required|min:3'
        ]);

        $data = $request->all();
        MedicalDeviceGroup::create($data);
        return redirect()->route('kelompok-alkes.index')->with('message', "Kelompok alkes $request->nama_kelompok_alat_kesehatan berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
