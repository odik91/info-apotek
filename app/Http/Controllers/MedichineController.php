<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medichine;
use App\Models\MedichineSubclass;

class MedichineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Obat';
        $medichines = Medichine::orderBy('id', 'asc')->get();
        return view('apotek.obat.index', compact('title', 'medichines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Data Obat';
        return view('apotek.obat.add', compact('title'));
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
            'nama_obat' => 'required|min:3',
            'kelas_obat_id' => 'required',
            'sediaan_obat_id' => 'required'
        ]);
        $data['nama_obat'] = $request['nama_obat'];
        $data['kelas_obat_id'] = $request['kelas_obat_id'];
        $data['subkelas_obat_id'] = null;
        if (!empty($request['subkelas_obat_id'])) {
            $data['subkelas_obat_id'] = $request['subkelas_obat_id'];
        }
        $data['sediaan_obat_id'] = $request['sediaan_obat_id'];
        $data['kekuatan'] = $request['kekuatan'];
        $data['satuan'] = $request['satuan'];
        $data['retriksi'] = $request['retriksi'];
        $data['retriksi_obat'] = $request['retriksi_obat'];
        $data['retriksi_sediaan'] = $request['retriksi_sediaan'];

        Medichine::create($data);
        return redirect()->route('obat.create')->with('message', "Obat dengan nama $request->nama_obat berhasil ditambahkan");
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

    public function ajaxSubkelas($id)
    {
        $medichineSubclasses = MedichineSubclass::where('kelas_id', $id)->orderBy('subkelas_obat', 'asc')->pluck('subkelas_obat', 'id');
        return response()->json($medichineSubclasses);
    }
}
