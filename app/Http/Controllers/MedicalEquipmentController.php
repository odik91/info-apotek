<?php

namespace App\Http\Controllers;

use App\Models\MedicalEquipment;
use Illuminate\Http\Request;

class MedicalEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Alat Kesehatan';
        $medicalEquipments = MedicalEquipment::orderBy('nama', 'asc')->get();
        return view('medicalEquipment.alkes.index', compact('title', 'medicalEquipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Alkes';
        return view('medicalEquipment.alkes.add', compact('title'));
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
            'nama' => 'required|min:3'
        ]);
        $data['nama'] = $request['nama'];
        $data['kelompok_alkes_id'] = $request['kelompok_alkes_id'];
        $data['kategori_alkes_id'] = $request['kategori_alkes_id'];
        $data['kelas_alkes_id'] = $request['kelas_alkes_id'];
        $data['kelas_resiko_alkes_id'] = $request['kelas_resiko_alkes_id'];
        $data['sifat_alkes_id'] = $request['sifat_alkes_id'];
        // dd($data);
        MedicalEquipment::create($data);
        return redirect()->route('alkes.index')->with('message', "Alkes $request->nama berhasil ditambahkan");
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
