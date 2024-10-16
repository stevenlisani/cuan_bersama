<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class InvestasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $investasis = DB::table('table_investasi')
                    ->get();

        return view('investasi.index', compact('investasis'))->with('i',(request()->input('page',1)-1)*20);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coin'=>'required',
            'harga_entri'=>'required',
            'nominal'=>'required',
        ]);

        Investasi::create([
            'coin' => $request->coin,
            'harga_entri' => $request->harga_entri,
            'nominal' => $request->nominal,
        ]);

        Alert::success('Success', 'Data Investasi Berhasil Ditambahkan.');
        return redirect()->route('investasi.index');
    }

    public function update(Request $request, Investasi $investasi)
    {
        $request->validate([
            'coin'=>'required',
            'harga_entri'=>'required',
            'nominal'=>'required',
            'status'=>'required',
        ]);

        $investasi->update([
            'coin' => $request->coin,
            'harga_entri' => $request->harga_entri,
            'nominal' => $request->nominal,
            'status' => $request->status,
        ]);

        Alert::success('Success', 'Data Investasi Berhasil Diubah.');
        return redirect()->route('investasi.index');
    }

    public function delete(Investasi $investasi)
    {
       $investasi->delete();

       toast('Data Investasi Berhasil dihapus.', 'error');
       return redirect()->route('investasi.index');
    }

    public function indexAnggota()
    {
        $investasis = DB::table('table_investasi')
                    ->get();

        return view('investasi.anggota', compact('investasis'))->with('i',(request()->input('page',1)-1)*20);
    }

    public function selesai(Request $request, Investasi $investasi)
    {
        $request->validate([
            'profit'=>'required|numeric',
        ]);

        $investasi->update([
            'profit' => $request->profit,
            'status' => 'Selesai',
        ]);

        Alert::success('Success', 'Data Status Investasi berhasil di selesaikan.');
        return redirect()->route('investasi.index');
    }
}
