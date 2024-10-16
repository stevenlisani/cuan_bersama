<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CryptoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData()
    {

        return view('coin.index'); // Pass the data to the view
    }

    public function indexAnggota()
    {

        return view('coin.anggota'); // Pass the data to the view
    }

}
