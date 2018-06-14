<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kyc_tipo;

class KycTipoController extends Controller
{
    public function create(Request $req)
    {
        $kyc_tipo = kyc_tipo::create($req->all());
        return response()->json([
            'data' => $kyc_tipo
        ], 200);
    }
    public function retrieve($id = null)
    {
        $kyc_tipos = ($id != null) ? kyc_tipo::find($id) : kyc_tipo::all();
        $kyc_tipos = ($kyc_tipos == null) ? "No hay modelos creados" : $kyc_tipos;
        return response()->json([
            'data' => $kyc_tipos
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $kyc_tipo = kyc_tipo::find($id);
        $kyc_tipo->update($request->all());
        return response()->json([
            'data' => $kyc_tipo
        ], 200);
    }
    public function delete($id)
    {
        kyc_tipo::destroy($id);
        return response()->json([
            'data' => kyc_tipo::all()
        ], 200);
    }
}
