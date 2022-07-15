<?php

namespace App\Http\Controllers;

use App\Models\MedicalDeviceRiskClass;
use Illuminate\Http\Request;

class MedicalDeviceRiskClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kelas Resiko Alkes';
        $medicalDeviceRiskClasses = MedicalDeviceRiskClass::orderBy('nama_kelas_resiko_alkes', 'asc')->get();
        return view('medicalEquipment.kelas_resiko.index', compact('title', 'medicalDeviceRiskClasses'));
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
            'nama_kelas_resiko_alkes' => 'required|min:3'
        ]);
        $data = $request->all();
        MedicalDeviceRiskClass::create($data);
        return redirect()->route('kelas-resiko.index')->with('message', "Kelas resiko $request->nama_kelas_resiko_alkes berhasil ditambahkan");
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
