<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MedichineStock;
use App\Models\MedicalEquipmentStock;
use App\Models\MedicalEquipment;
use App\Models\Medichine;
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
            $results = User::where('nama_apotek', 'like', "%$request->apotek%")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->where('kecamatan_id', $request->kecamatan_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('nama_apotek', 'like', "%$request->apotek%")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->where('kecamatan_id', $request->kecamatan_id)->count();
        } elseif (isset($request->apotek) && isset($request->provinsi_id) && isset($request->kabupaten_id)) {
            $results = User::where('nama_apotek', 'like', "%$request->apotek%")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('nama_apotek', 'like', "%$request->apotek%")->where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->count();
        } elseif (isset($request->apotek) && isset($request->provinsi_id)) {
            $results = User::where('nama_apotek', 'like', "%$request->apotek%")->where('provinsi_id', $request->provinsi_id)->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

            $searchCounts = User::where('nama_apotek', 'like', "%$request->apotek")->where('provinsi_id', $request->provinsi_id)->count();
        } elseif (isset($request->apotek)) {
            $results = User::where('nama_apotek', 'like', "%$request->apotek%")->paginate(12, ['id', 'nama_apotek', 'email', 'no_izin', 'penanggung_jawab', 'alamat', 'kecamatan_id', 'kabupaten_id', 'provinsi_id', 'no_telepon', 'longlat']);

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

    public function searchObat(Request $request)
    {
        $items = [];
        $title = 'Hasil Pencarian';
        $results = null;

        if ($request['nama_obat'] == null) {
            $results = Medichine::orderBy('nama_obat', 'asc')->get(['id', 'nama_obat', 'kelas_obat_id', 'subkelas_obat_id', 'sediaan_obat_id', 'kekuatan', 'satuan']);
        } else {
            $results = Medichine::where('nama_obat', 'like', "%$request->nama_obat%")->get(['id', 'nama_obat', 'kelas_obat_id', 'subkelas_obat_id', 'sediaan_obat_id', 'kekuatan', 'satuan']);
        }

        foreach ($results as $result) {
            $medichinePharmacies = MedichineStock::where('obat_id', $result['id'])->get();

            foreach ($medichinePharmacies as $medichinePharmacy) {
                if ($request['provinsi_id'] == null && $request['kabupaten_id'] == null && $request['kecamatan_id'] == null) {
                    array_push($items, (object)[
                        'obat_id' => $result['id'],
                        'nama_obat' => $result['nama_obat'],
                        'kelas_obat_id' => $result['kelas_obat_id'],
                        'subkelas_obat_id' => $result['subkelas_obat_id'],
                        'sediaan_obat_id' => $result['sediaan_obat_id'],
                        'kekuatan' => $result['kekuatan'],
                        'satuan' => $result['satuan'],
                        'apotek_id' => $medichinePharmacy['apotek_id'],
                        'status' => $medichinePharmacy['status']
                    ]);
                } elseif (isset($request['provinsi_id']) && isset($request['kabupaten_id']) && isset($request['kecamatan_id'])) {
                    $findPharmacies = User::where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->where('kecamatan_id', $request->kecamatan_id)->get('id');
                    foreach ($findPharmacies as $findPharmacy) {
                        if ($findPharmacy['id'] == $medichinePharmacy['apotek_id']) {
                            array_push($items, (object)[
                                'obat_id' => $result['id'],
                                'nama_obat' => $result['nama_obat'],
                                'kelas_obat_id' => $result['kelas_obat_id'],
                                'subkelas_obat_id' => $result['subkelas_obat_id'],
                                'sediaan_obat_id' => $result['sediaan_obat_id'],
                                'kekuatan' => $result['kekuatan'],
                                'satuan' => $result['satuan'],
                                'apotek_id' => $findPharmacy['id'],
                                'status' => $medichinePharmacy['status']
                            ]);
                        }
                    }
                } elseif (isset($request['provinsi_id']) && isset($request['kabupaten_id'])) {
                    $findPharmacies = User::where('provinsi_id', $request->provinsi_id)->where('kabupaten_id', $request->kabupaten_id)->get('id');
                    foreach ($findPharmacies as $findPharmacy) {
                        if ($findPharmacy['id'] == $medichinePharmacy['apotek_id']) {
                            array_push($items, (object)[
                                'obat_id' => $result['id'],
                                'nama_obat' => $result['nama_obat'],
                                'kelas_obat_id' => $result['kelas_obat_id'],
                                'subkelas_obat_id' => $result['subkelas_obat_id'],
                                'sediaan_obat_id' => $result['sediaan_obat_id'],
                                'kekuatan' => $result['kekuatan'],
                                'satuan' => $result['satuan'],
                                'apotek_id' => $findPharmacy['id'],
                                'status' => $medichinePharmacy['status']
                            ]);
                        }
                    }
                } elseif (isset($request['provinsi_id'])) {
                    $findPharmacies = User::where('provinsi_id', $request->provinsi_id)->get('id');
                    foreach ($findPharmacies as $findPharmacy) {
                        if ($findPharmacy['id'] == $medichinePharmacy['apotek_id']) {
                            array_push($items, (object)[
                                'obat_id' => $result['id'],
                                'nama_obat' => $result['nama_obat'],
                                'kelas_obat_id' => $result['kelas_obat_id'],
                                'subkelas_obat_id' => $result['subkelas_obat_id'],
                                'sediaan_obat_id' => $result['sediaan_obat_id'],
                                'kekuatan' => $result['kekuatan'],
                                'satuan' => $result['satuan'],
                                'apotek_id' => $findPharmacy['id'],
                                'status' => $medichinePharmacy['status']
                            ]);
                        }
                    }
                }
            }
        }

        $searchCounts = count($items);
        return view('search.hasilObat', compact('title', 'searchCounts', 'items'));
    }
}
