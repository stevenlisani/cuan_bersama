<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $anggotas = DB::table('table_anggota')
                    ->get();

        return view('anggota.index', compact('anggotas'))->with('i',(request()->input('page',1)-1)*20);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap'=>'required',
            'email'=>'required',
            'no_tlp'=>'required',
            'alamat'=>'required',
        ]);

        Anggota::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,

        ]);

        Alert::success('Success', 'Data Anggota Berhasil Ditambahkan.');
        return redirect()->route('anggota.index');
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama_lengkap'=>'required',
            'email'=>'required',
            'no_tlp'=>'required',
            'alamat'=>'required',
        ]);

        $anggota->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
        ]);

        Alert::success('Success', 'Data Anggota Berhasil Diubah.');
        return redirect()->route('anggota.index');
    }

    public function delete(Anggota $anggota)
    {
       $anggota->delete();

       toast('Data Anggota Berhasil dihapus.', 'error');
       return redirect()->route('anggota.index');
    }

    public function profileCreate()
    {
        return view('anggota.lengkapi-profile')->with('i',(request()->input('page',1)-1)*20);
    }

    public function lengkapiProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap'=>'required',
            'email'=>'required',
            'no_tlp'=>'required',
            'alamat'=>'required',
        ]);

        $id_user = Auth::user()->id;
        $name = $request->nama_lengkap;

        Anggota::create([
            'id_user' => $id_user,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
        ]);

        // Update Name Table User //
            $user = User::find($id_user);
            $user->name = $name;
            $user->save();
        // End Update Name Table User //

        Alert::success('Success', 'Data Profile Anda sudah Lengkap.');
        return redirect()->route('anggota.home');
    }
}
