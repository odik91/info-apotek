<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\MedicalEquipment;
use App\Models\MedicalEquipmentStock;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class MedicalDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Alkes';
        $medicalEquipments = MedicalEquipment::orderBy('nama', 'asc')->paginate(10);
        return view('users.medicalDevice.index', compact('title', 'medicalEquipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Alkes';
        return view('users.medicalDevice.add', compact('title'));
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
            'nama' => 'required|min:3',
            'kelompok_alkes_id' => 'required',
            'kategori_alkes_id' => 'required',
            'kelas_alkes_id' => 'required',
            'kelas_resiko_alkes_id' => 'required',
            'sifat_alkes_id' => 'required'
        ]);

        // $checkDBData = MedicalEquipment::where('nama', strtolower($request['nama']))->where('kelompok_alkes_id', $request['kelompok_alkes_id'])->get();
        $checkDBData = MedicalEquipment::where('nama', strtolower($request['nama']))->where('kelompok_alkes_id', $request['kelompok_alkes_id'])->first();

        if ($checkDBData == null) {
            $data['nama'] = $request['nama'];
            $data['kelompok_alkes_id'] = $request['kelompok_alkes_id'];
            $data['kategori_alkes_id'] = $request['kategori_alkes_id'];
            $data['kelas_alkes_id'] = $request['kelas_alkes_id'];
            $data['kelas_resiko_alkes_id'] = $request['kelas_resiko_alkes_id'];
            $data['sifat_alkes_id'] = $request['sifat_alkes_id'];
            MedicalEquipment::create($data);

            $checkCurrentData = MedicalEquipment::where('nama', strtolower($request['nama']))->first();

            $stock['apotek_id'] = auth()->user()->id;
            $stock['alkes_id'] = $checkCurrentData['id'];
            $stock['status'] = "";
            if ($request['ada'] != null) {
                $stock['status'] = $request['ada'];
            } else {
                $stock['status'] = 'tidak';
            }
            MedicalEquipmentStock::create($stock);
            return redirect()->route('medical-device.create')->with('message', "Alkes $request->nama berhasil ditambahkan");
        } else {
            $checkStockIsAvailable = MedicalEquipmentStock::where('apotek_id', auth()->user()->id)->where('alkes_id', $checkDBData['id'])->first();
            if ($checkStockIsAvailable == null) {
                $stock['apotek_id'] = auth()->user()->id;
                $stock['alkes_id'] = $checkDBData['id'];
                $stock['status'] = "";
                if ($request['ada'] != null) {
                    $stock['status'] = $request['ada'];
                } else {
                    $stock['status'] = 'tidak';
                }
                MedicalEquipmentStock::create($stock);
                return redirect()->route('medical-device.create')->with('message', "Alkes $request->nama berhasil ditambahkan");
            } else {
                $updateStock = MedicalEquipmentStock::find($checkStockIsAvailable['id']);
                $stock['status'] = "";
                if ($request['ada'] != null) {
                    $stock['status'] = $request['ada'];
                } else {
                    $stock['status'] = 'tidak';
                }
                $updateStock->update($stock);
                return redirect()->route('medical-device.create')->with('message', "Alkes $request->nama berhasil diubah");
            }
        }
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

    public function setAvailability(Request $request)
    {
        $this->validate($request, [
            'sendArr' => 'required|min:3'
        ]);

        $baseArr = explode(",", $request['sendArr']);
        // dd($baseArr);
        $totalData = sizeof($baseArr);
        $perubahanData = 0;

        // $checkForUpdate = [];

        for ($i = 0; $i < $totalData; $i++) {
            $checkDBData = explode("+", $baseArr[$i]);
            $stokMedicalDevice = MedicalEquipmentStock::where('apotek_id', $checkDBData[1])->where('alkes_id', $checkDBData[0])->get();
            // dd(count($stokMedicalDevice));
            if (count($stokMedicalDevice) == 0) {
                $data['apotek_id'] = $checkDBData[1];
                $data['alkes_id'] = $checkDBData[0];
                $status = '';
                if ($checkDBData[2] == 1) {
                    $status = 'ada';
                } else {
                    $status = 'tidak';
                }
                $data['status'] = $status;
                if (MedicalEquipmentStock::create($data)) {
                    $perubahanData++;
                }
            } else {
                $stockinDB = MedicalEquipmentStock::where('alkes_id', $checkDBData[0])->where('apotek_id', $checkDBData[1])->first();
                // array_push($checkForUpdate, $stockinDB['id']);
                // dd($baseArr, $stockinDB);
                // dd($stockinDB);
                $stock = MedicalEquipmentStock::find($stockinDB['id']);
                $status = '';
                if ($checkDBData[2] == 1) {
                    $status = 'ada';
                } else {
                    $status = 'tidak';
                }
                $data['status'] = $status;
                $data['apotek_id'] = auth()->user()->id;
                $data['alkes_id'] = $checkDBData[0];
                if ($stock->update($data)) {
                    $perubahanData++;
                }
            }
        }
        // dd($checkForUpdate);
        return redirect()->route('medical-device.index')->with('message', "$perubahanData data alkes berhasil diubah dari total $totalData yang diproses");
    }

    public function cariAlkes(Request $request)
    {
        $this->validate($request, [
            'cari_alkes' => 'required|min:3'
        ]);

        $title = 'Hasil Pencarian Alkes';
        $medicalEquipments = MedicalEquipment::where('nama', 'like', "%$request->cari_alkes%")->paginate(10);
        return view('users.medicalDevice.search', compact('title', 'medicalEquipments'));
    }
}
