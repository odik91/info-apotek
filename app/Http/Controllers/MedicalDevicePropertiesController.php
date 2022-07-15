<?php

namespace App\Http\Controllers;

use App\Models\MedicalDeviceProperties;
use Illuminate\Http\Request;

class MedicalDevicePropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Sifat Alkes';
        $medicalDeviceProperties = MedicalDeviceProperties::orderBy('nama_sifat_alkes', 'asc')->get();
        return view('medicalEquipment.sifat_alkes.index', compact('title', 'medicalDeviceProperties'));
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
            'nama_sifat_alkes' => 'required|min:3'
        ]);
        $data = $request->all();
        MedicalDeviceProperties::create($data);
        return redirect()->route('sifat-alkes.index')->with('message', "Sifat alkes $request->nama_sifat_alkes berhasil ditambahkan");
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
