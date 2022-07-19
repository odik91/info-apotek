<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\MedicalEquipmentStock;
use App\Models\MedicalEquipment;
use App\Models\MedichineStock;
use Illuminate\Http\Request;
use App\Models\User;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Beranda';
        $users = User::where('id', auth()->user()->id)->first();
        $medichine_stocks = MedichineStock::where('apotek_id', auth()->user()->id)->get();

        $medicalEquipments = MedicalEquipment::orderBy('nama', 'asc')->get();

        $qtyMedichineStock =  MedichineStock::where('apotek_id', auth()->user()->id)->where('status', 'ada')->get();

        $medicalEquipmentStocks = MedicalEquipmentStock::where('apotek_id', auth()->user()->id)->where('status', 'ada')->get();

        // dd(count($medichine_stocks));
        return view('users.apotek.index', compact('title', 'users', 'medichine_stocks', 'medicalEquipments', 'qtyMedichineStock', 'medicalEquipmentStocks'));
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
        // 
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
        $this->validate($request, [
            'no_izin' => 'required|min:6',
            'penanggung_jawab' => 'required|min:5',
            'alamat' => 'required|min:5',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
        ]);

        $namaApotek = auth()->user()->nama_apotek;

        $user = User::find($id);
        $data['no_izin'] = $request['no_izin'];
        $data['penanggung_jawab'] = $request['penanggung_jawab'];
        $data['alamat'] = $request['alamat'];
        $data['provinsi_id'] = $request['provinsi_id'];
        $data['kabupaten_id'] = $request['kabupaten_id'];
        $data['kecamatan_id'] = $request['kecamatan_id'];
        $data['no_telepon'] = $request['no_telepon'];
        $data['longlat'] = $request['longlat'];

        $user->update($data);
        return redirect()->route('apotek.index')->with('message', "Informasi apotek $namaApotek berhasil diperbarui");
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

    public function getCity($id)
    {
        $cities = City::where('provinsi_id', $id)->orderBy('nama_kabupaten_kota', 'asc')->pluck('nama_kabupaten_kota', 'id');
        return response()->json($cities);
    }

    public function getDistic($id)
    {
        $distics = District::where('kabupaten_id', $id)->orderBy('nama_kecamatan', 'asc')->pluck('nama_kecamatan', 'id');
        return response()->json($distics);
    }
}
