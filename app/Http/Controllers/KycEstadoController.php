<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kyc_estado;

class KycEstadoController extends Controller
{
    public function create(Request $req)
    {
        $estado = kyc_estado::create($req->all());
        return response()->json([
            'data' => $estado
        ], 200);
    }
    public function retrieve($id = null)
    {
        $estados = ($id != null) ? kyc_estado::find($id) : kyc_estado::all();
        $estados = ($estados == null) ? "No hay modelos creados" : $estados;
        return response()->json([
            'data' => $estados
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $estado = kyc_estado::find($id);
        $estado->update($request->all());
        return response()->json([
            'data' => $estado
        ], 200);
    }
    public function delete($id)
    {
        kyc_estado::destroy($id);
        return response()->json([
            'data' => kyc_estado::all()
        ], 200);
    }
}
