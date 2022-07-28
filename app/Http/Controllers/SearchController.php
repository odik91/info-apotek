<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MedichineStock;
use App\Models\MedicalEquipmentStock;
use App\Models\MedicalEquipment;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Apotek';
        return view('search.index', compact('title'));
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

    public function indexObat()
    {
        $title = 'Obat';
        return view('search.obat', compact('title'));
    }

    public function indexAlkes()
    {
        $title = 'Alkes';
        return view('search.alkes', compact('title'));
    }

    public function searchApotek(Request $request)
    {
        $results = null;
        $searchCounts = 0;
        $title = 'Hasil Pencarian';

        if (isset($request->apotek) && isset($request->provinsi_id) && isset($request->kabupaten_id) && isset($request->kecamatan_id)) {
            $results = User::where('nama_apotek', 'like', "%$request->apotek")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->where('kecamatan_id', $request->kecamatan_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('nama_apotek', 'like', "%$request->apotek")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->where('kecamatan_id', $request->kecamatan_id)->count();
        } elseif (isset($request->apotek) && isset($request->provinsi_id) && isset($request->kabupaten_id)) {
            $results = User::where('nama_apotek', 'like', "%$request->apotek")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('nama_apotek', 'like', "%$request->apotek")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->count();
        } elseif (isset($request->apotek) && isset($request->provinsi_id)) {
            $results = User::where('nama_apotek', 'like', "%$request->apotek")->where('provinsi_id', $request->provinsi_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('nama_apotek', 'like', "%$request->apotek")->where('provinsi_id', $request->provinsi_id)->count();
        } elseif (isset($request->apotek)) {
            $results = User::where('id', 'nama_apotek', 'like', "%$request->apotek")->paginate(12, ['nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('nama_apotek', 'like', "%$request->apotek")->count();
        } elseif (isset($request->provinsi_id) && isset($request->kabupaten_id) && isset($request->kecamatan_id)) {
            $results = User::where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->where('kecamatan_id', $request->kecamatan_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->where('kecamatan_id', $request->kecamatan_id)->count();
        } elseif (isset($request->provinsi_id) && isset($request->kabupaten_id)) {
            $results = User::where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->count();
        } else {
            $results = User::paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::count();;
        }
        return view('search.hasilApotek', compact('title', 'results', 'searchCounts'));
    }

    public function showApotek($id)
    {
        $title = 'Detail Apotek';

        $apotek = User::where('id', $id)->first(['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

        $qtyMedichineStock =  MedichineStock::where('apotek_id', $id)->where('status', 'ada')->get();

        $medicalEquipmentStocks = MedicalEquipmentStock::where('apotek_id', $id)->where('status', 'ada')->get();

        $medichine_stocks = MedichineStock::where('apotek_id', $id)->get();

        $medicalEquipmentsStockList = MedicalEquipmentStock::where('apotek_id', $id)->get();

        return view('search.apotek', compact('title', 'apotek', 'qtyMedichineStock', 'medicalEquipmentStocks', 'medichine_stocks', 'medicalEquipmentsStockList'));
    }
}
