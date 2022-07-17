<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\Medichine;
use App\Models\MedichineStock;
use Illuminate\Http\Request;

class MedichineManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kelola Obat';
        $medichines = Medichine::orderBy('kelas_obat_id', 'asc')->paginate(25);
        return view('users.medichine_management.index', compact('title', 'medichines'));
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
            'sendArr' => 'required|min:3'
        ]);

        $baseArr = explode(",", $request['sendArr']);
        $totalData = sizeof($baseArr);
        $perubahanData = 0;

        for ($i = 0; $i < $totalData; $i++) {
            $checkDBData = explode("+", $baseArr[$i]);
            $stockMedichine = MedichineStock::where('apotek_id', $checkDBData[1])->where('obat_id', $checkDBData[0])->get();
            // dd(count($stockMedichine));
            if (count($stockMedichine) == 0) {
                $data['apotek_id'] = $checkDBData[1];
                $data['obat_id'] = $checkDBData[0];
                $status = '';
                if ($checkDBData[2] == 1) {
                    $status = 'ada';
                } else {
                    $status = 'tidak';
                }
                $data['status'] = $status;
                if (MedichineStock::create($data)) {
                    $perubahanData++;
                }
            } else {
                $stockinDB = $stockMedichine = MedichineStock::where('apotek_id', $checkDBData[1])->where('obat_id', $checkDBData[0])->first();
                // dd($stockinDB);
                $stock = MedichineStock::find($stockinDB['id']);
                $status = '';
                if ($checkDBData[2] == 1) {
                    $status = 'ada';
                } else {
                    $status = 'tidak';
                }
                $data['status'] = $status;
                if ($stock->update($data)) {
                    $perubahanData++;
                }
            }
        }
        return redirect()->route('manage-medichine.index')->with('message', "$perubahanData data obat berhasil diubah dari total $totalData yang diproses");
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
