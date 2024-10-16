<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Anggota;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'Admin'){
            Alert::success('Success', 'Register Berhasil.');
            return redirect()->route('admin.home');
        }elseif (Auth::user()->role == 'Anggota'){
            Alert::success('Success', 'Register Berhasil, Silahkan Lengkapi Data Diri Anda');
            return redirect()->route('lengkapi.profile');
        }
    }

    public function indexLogin()
    {
        if (Auth::user()->role == 'Admin'){
            Alert::success('Success', 'Login Berhasil.');
            return redirect()->route('admin.home');
        }elseif (Auth::user()->role == 'Anggota'){
            Alert::success('Success', 'Login Berhasil.');
            return redirect()->route('anggota.home');
        }
    }

    public function admin()
    {
        $tanggal = Carbon::now();

        $profit_investasis = DB::table('table_investasi')
                            ->get();

        $tot_profit = $profit_investasis->sum('profit');

        $tbl_total_tabungans = DB::table('table_anggota')
                                ->get();
        $total_tabungan = $tbl_total_tabungans->sum('total_tabungan');

        $total_profit = $tot_profit - $total_tabungan;

        $anggota = $tbl_total_tabungans->count();

        $table_terimas = DB::table('table_keuangan')
                            ->where('status', '=', 'Diterima')
                            ->get();
        $tabungan_terima = $table_terimas->count();

        $table_tolaks = DB::table('table_keuangan')
                            ->where('status', '=', 'Ditolak')
                            ->get();
        $tabungan_tolak = $table_tolaks->count();

        $table_prossess = DB::table('table_keuangan')
                            ->where('status', '=', 'Prosses')
                            ->get();
        $tabungan_prosses = $table_prossess->count();

        // <!--- Pie Chart Diagram Data  --->
        $anggota_data = DB::table('table_anggota')
                ->select('nama_lengkap', DB::raw("SUM(total_tabungan) as total_tabungan"))
                ->groupBy('nama_lengkap')
                ->get();

        $labels = $anggota_data->pluck('nama_lengkap');
        $series = $anggota_data->pluck('total_tabungan');



        // <!--- End Pie Chart Diagram Data  --->

        return view('admin', compact('total_tabungan', 'total_profit', 'anggota', 'tabungan_terima', 'tabungan_tolak', 'tabungan_prosses', 'labels', 'series'));
    }

    public function anggota()
    {
        $id_user = Auth::user()->id;
        $id_anggota = DB::table('table_anggota')->where('id_user', $id_user)->value('id_anggota');

        $profit_investasis = DB::table('table_investasi')
                            ->get();

        $tot_profit = $profit_investasis->sum('profit');

        $tbl_total_tabungans = DB::table('table_anggota')
                                ->where('id_anggota', '=', $id_anggota)
                                ->get();
        $total_tabungan = $tbl_total_tabungans->sum('total_tabungan');

        $tbl_total_tabungans_all = DB::table('table_anggota')
                                ->get();
        $total_tabungan_all = $tbl_total_tabungans_all->sum('total_tabungan');

        $total_profit = $tot_profit - $total_tabungan_all;

        $table_terimas = DB::table('table_keuangan')
                            ->where('id_anggota', '=', $id_anggota)
                            ->where('status', '=', 'Diterima')
                            ->get();
        $tabungan_terima = $table_terimas->count();

        $table_tolaks = DB::table('table_keuangan')
                            ->where('id_anggota', '=', $id_anggota)
                            ->where('status', '=', 'Ditolak')
                            ->get();
        $tabungan_tolak = $table_tolaks->count();

        $table_prossess = DB::table('table_keuangan')
                            ->where('id_anggota', '=', $id_anggota)
                            ->where('status', '=', 'Prosses')
                            ->get();
        $tabungan_prosses = $table_prossess->count();

        // <!--- Pie Chart Diagram Data  --->
        $anggota_data = DB::table('table_anggota')
                ->select('nama_lengkap', DB::raw("SUM(total_tabungan) as total_tabungan"))
                ->groupBy('nama_lengkap')
                ->get();

        $labels = $anggota_data->pluck('nama_lengkap');
        $series = $anggota_data->pluck('total_tabungan');



        // <!--- End Pie Chart Diagram Data  --->

        return view('anggota', compact('total_profit', 'total_tabungan', 'total_tabungan_all','tabungan_terima', 'tabungan_tolak', 'tabungan_prosses', 'labels', 'series'));
    }

    public function profile(){
        return view('profile');
    }

    public function profileUpdate(Request $request, User $user){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Alert::success('Success', 'Data Profile Berhasil Diubah.');
        return redirect()->route('profile');
    }

    public function changePassword(Request $request, User $user){

        $request->validate([
            'password'=>'required|min:8|max:100',
            'newpassword'=>'required|min:8|max:100',
            'renewpassword'=>'required|same:newpassword',
        ]);

        $newpassword = $request->newpassword;
        $current_pass = Auth::user();

        if(Hash::check($request->password,$current_pass->password)){
            $user->update([
                'password'=>bcrypt($newpassword)
            ]);
            Alert::success('Success', 'Password berhasil di ubah.');
            return redirect()->route('profile');
        }else{
            Alert::error('Password Salah', 'Password lama yang anda masukkan salah!!');
            return redirect()->back();
        }

    }

    public function profileAnggota(){
        $id_user = Auth::user()->id;
        $id_anggota = DB::table('table_anggota')->where('id_user', $id_user)->value('id_anggota');
        $anggota_data = DB::table('table_anggota')
            ->where('id_anggota', '=', $id_anggota)
            ->get();

            $nomer_telepon = '';
            $alamat = '';

            foreach ($anggota_data as $data) {
                $nomer_telepon = $data->no_tlp;
                $alamat = $data->alamat;
            }
        return view('anggota-profile', compact('nomer_telepon', 'alamat'));
    }

    public function profileUpdateAnggota(Request $request, User $user){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'no_tlp'=>'required|numeric',
            'alamat'=>'required',
        ]);

        $name = $request->name;
        $email = $request->email;
        $no_tlp = $request->no_tlp;
        $alamat = $request->alamat;
        $id_user = Auth::user()->id;
        $id_anggota = DB::table('table_anggota')->where('id_user', $id_user)->value('id_anggota');

        $anggota = Anggota::find($id_anggota);
        $anggota->nama_lengkap = $name;
        $anggota->email = $email;
        $anggota->no_tlp = $no_tlp;
        $anggota->alamat = $alamat;
        $anggota->save();

        $user->update([
            'name' => $name,
            'email' => $request->email,
        ]);

        Alert::success('Success', 'Data Profile Berhasil Diubah.');
        return redirect()->route('anggota.profile');
    }

    public function changePasswordAnggota(Request $request, User $user){

        $request->validate([
            'password'=>'required|min:8|max:100',
            'newpassword'=>'required|min:8|max:100',
            'renewpassword'=>'required|same:newpassword',
        ]);

        $newpassword = $request->newpassword;
        $current_pass = Auth::user();

        if(Hash::check($request->password,$current_pass->password)){
            $user->update([
                'password'=>bcrypt($newpassword)
            ]);
            Alert::success('Success', 'Password berhasil di ubah.');
            return redirect()->route('anggota.profile');
        }else{
            Alert::error('Password Salah', 'Password lama yang anda masukkan salah!!');
            return redirect()->back();
        }

    }
}
