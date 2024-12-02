<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TiketResource;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{

    // TODO : GET ALL
    public function index()
    {
        return TiketResource::collection(Tiket::all());
    }

    // TODO : POST
    public function store(Request $request)
    {
        $request->validate([
            'nama_tiket' => 'required',
            'harga' => 'required|numeric',
            'pembeli_id' => 'required|exists:pembelis,id',
        ]);

        $tiket = Tiket::create($request->all());
        return new TiketResource($tiket);
    }

    // TODO : GET BY ID
    public function show($id)
    {
        $tiket = Tiket::find($id);
        if (!$tiket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }
        return new TiketResource($tiket);
    }

    // TODO : PUT
    public function update(Request $request, $id)
    {
        $tiket = Tiket::find($id);

        if (!$tiket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_tiket' => 'sometimes|required',
            'harga' => 'sometimes|required|numeric',
            'pembeli_id' => 'sometimes|required|exists:pembelis,id',
        ]);

        $tiket->update($request->all());

        return response()->json(['message' => 'Tiket berhasil diperbarui', 'data' => $tiket], 200);
    }

    // TODO : DELETE
    public function destroy($id)
    {
        $tiket = Tiket::find($id);

        if (!$tiket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        $tiket->delete();

        return response()->json(['message' => 'Tiket berhasil dihapus'], 200);
    }
}
