<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getDistrics($data)
    {
        $distics = District::where('kabupaten_id', $data)->orderBy('nama_kecamatan', 'asc')->pluck('nama_kecamatan', 'id');
        return response()->json($distics);
    }

    public function getCity($id)
    {
        $cities = City::where('provinsi_id', $id)->orderBy('nama_kabupaten_kota', 'asc')->pluck('nama_kabupaten_kota', 'id');
        return response()->json($cities);
    }
}
