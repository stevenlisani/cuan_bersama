<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $keuangans = DB::table('table_keuangan')
                    ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                    ->latest()
                    ->get();

        $anggotas = Anggota::all();

        return view('keuangan.index', compact('keuangans', 'anggotas'))->with('i',(request()->input('page',1)-1)*20);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_anggota'=>'required',
            'foto'=>'required',
            'jumlah'=>'required',
        ]);

        $jumlah = $request->jumlah;
        $tanggal = Carbon::now();

        if($jumlah >= 2000){
            $acc_jumlah = $request->jumlah;
        }else{
            return redirect()->back()->withInput();
        }

        // Upload Foto //
        $file = $request->file('foto');

        $nama_file = time()."_".$file->getClientOriginalName();

        $tujuan_upload = 'img_bukti_transfer/';
        $file->move($tujuan_upload,$nama_file);
        // End Upload Foto //

        Keuangan::create([
            'id_anggota' => $request->id_anggota,
            'tanggal' => $tanggal,
            'jumlah' => $acc_jumlah,
            'status' => 'Prosses',
            'foto' => $nama_file,
        ]);
        Alert::success('Success', 'Data Tabungan Berhasil Ditambahkan.');
        return redirect()->route('keuangan.index');
    }

    public function delete(Keuangan $keuangan)
    {
        File::delete('img_bukti_transfer/'.$keuangan->foto);

       $keuangan->delete();
       toast('Data Tabungan Berhasil dihapus.', 'error');
       return redirect()->route('keuangan.index');


    }
    public function batal(Keuangan $keuangan)
    {
        File::delete('img_bukti_transfer/'.$keuangan->foto);

       $keuangan->delete();
       toast('Data Tabungan Berhasil dibatalkan.', 'error');
       return redirect()->route('anggota.keuangan');
    }

    public function indexAnggota()
    {
        $id_user = Auth::user()->id;

        $keuangans = DB::table('table_keuangan')
                    ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                    ->where('id_user', '=', $id_user)
                    ->get();

        $anggotas = Anggota::all();

        return view('keuangan.anggota', compact('keuangans', 'anggotas'))->with('i',(request()->input('page',1)-1)*20);
    }

    public function tambahTabungan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user'=>'required',
            'jumlah'=>'required',
            'foto'=>'required',
        ]);

        $jumlah = $request->jumlah;
        $id_user = $request->id_user;
        $id_anggota = DB::table('table_anggota')->where('id_user', $id_user)->value('id_anggota');
        $tanggal = Carbon::now();

        if($jumlah >= 2000){
            $acc_jumlah = $request->jumlah;
        }else{
            return redirect()->back()->withInput();
        }

        // Upload Foto //
        $file = $request->file('foto');

        $nama_file = time()."_".$file->getClientOriginalName();

        $tujuan_upload = 'img_bukti_transfer/';
        $file->move($tujuan_upload,$nama_file);
        // End Upload Foto //

        Keuangan::create([
            'id_anggota' => $id_anggota,
            'tanggal' => $tanggal,
            'jumlah' => $acc_jumlah,
            'status' => 'Prosses',
            'foto' => $nama_file,
        ]);
        Alert::success('Success', 'Tabungan Berhasil Ditambahkan, Dalam Tahap Pemeriksaan oleh Admin.');
        return redirect()->route('anggota.keuangan');
    }

    public function checkTerima(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'status'=>'required',
            'id_anggota'=>'required',
            'jumlah'=>'required',
        ]);

        $jumlah = $request->jumlah;
        $id_anggota = $request->id_anggota;
        $total_lama = DB::table('table_anggota')->where('id_anggota', $id_anggota)->value('total_tabungan');

        if($id_anggota != null){
            $total_tabungan = $jumlah + $total_lama;
            $anggota = Anggota::find($id_anggota);
            $anggota->total_tabungan = $total_tabungan;
            $anggota->save();
        }else{
            return redirect()->back()->withInput();
        }

        $keuangan->update([
            'status' => $request->status,
        ]);

        Alert::success('Success', 'Tabungan Berhasil Diterima.');
        return redirect()->route('keuangan.index');
    }

    public function checkTolak(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'status'=>'required',
        ]);

        $keuangan->update([
            'status' => $request->status,
        ]);
        Alert::error('Success', 'Tabungan Berhasil Ditolak.');
        return redirect()->route('keuangan.index');
    }

    public function export()
    {
    $keuangans = DB::table('table_keuangan')
                ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                ->get();
                $totals = $keuangans->sum('jumlah');

                $pdf = Pdf::loadView('pdf.keuangan', ['keuangan' => $keuangans, 'total' => $totals]);
    return $pdf->stream('data-tabungan.pdf');
    }

    public function exportFilter(Request $request)
    {

        $id_anggota = $request->id_anggota;
        $date_start = $request->date_start;
        $date_end = $request->date_end;

        if($id_anggota != null && $date_start != null && $date_end != null){
            $keuangans = DB::table('table_keuangan')
                ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                ->where('table_keuangan.id_anggota', '=', $id_anggota) // Specify the table alias
                ->where('table_keuangan.tanggal', '>=', $date_start)
                ->where('table_keuangan.tanggal', '<=', $date_end)
                ->get();
        }elseif($id_anggota == null && $date_start != null && $date_end != null){
            $keuangans = DB::table('table_keuangan')
                ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                ->where('table_keuangan.tanggal', '>=', $date_start)
                ->where('table_keuangan.tanggal', '<=', $date_end)
                ->get();
        }elseif($id_anggota != null && $date_start == null && $date_end == null){
            $keuangans = DB::table('table_keuangan')
                ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                ->where('table_keuangan.id_anggota', '=', $id_anggota) // Specify the table alias
                ->get();
        }else{
            return redirect()->back()->withInput()->with('message', 'Silahkan Memilih Option Nama Anggota atau Tanggal');
        }

        if (count($keuangans) < 1 ){
            return redirect()->back()->withInput()->with('message', 'Data Tidak Ditemukan');
         }else{
            $totals = $keuangans->sum('jumlah');

        $pdf = Pdf::loadView('pdf.keuangan', ['keuangan' => $keuangans, 'total' => $totals]);
        return $pdf->stream('data-tabungan.pdf');
         }


    }

    public function exportAnggota()
    {
    $id_user = Auth::user()->id;
    $keuangans = DB::table('table_keuangan')
                ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                ->where('id_user', '=', $id_user)
                ->get();
                $totals = $keuangans->sum('jumlah');

    $pdf = Pdf::loadView('pdf.keuangan', ['keuangan' => $keuangans, 'total' => $totals]);
    return $pdf->stream('data-tabungan.pdf');
    }

    public function exportFilterAnggota(Request $request)
    {
        $id_user = Auth::user()->id;
        $date_start = $request->date_start;
        $date_end = $request->date_end;

        if($date_start != null && $date_end != null){
            $keuangans = DB::table('table_keuangan')
                ->join('table_anggota', 'table_anggota.id_anggota','=','table_keuangan.id_anggota')
                ->where('id_user', '=', $id_user)
                ->where('table_keuangan.tanggal', '>=', $date_start)
                ->where('table_keuangan.tanggal', '<=', $date_end)
                ->get();
        }elseif($date_start == null && $date_end == null){
            return redirect()->back()->withInput()->with('message', 'Silahkan Memilih Option Nama Anggota atau Tanggal');
        }

        if (count($keuangans) < 1 ){
            return redirect()->back()->withInput()->with('message', 'Data Tidak Ditemukan');
         }else{
            $totals = $keuangans->sum('jumlah');

        $pdf = Pdf::loadView('pdf.keuangan', ['keuangan' => $keuangans, 'total' => $totals]);
        return $pdf->stream('data-tabungan.pdf');
         }
    }
}
