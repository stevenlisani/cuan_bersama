<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="margin:0 auto; width:595px;">
    <div style="margin-left:20px">

    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <div align="center">
            <font size="7">Cuan Bersama</font>
          </div>
        </td>
      </tr>
    </table>
    <hr>
    <div style="text-align: center;">
      <label>
        <font size="6">Laporan Data Tabungan </font>
      </label>
    </div>
    <p>&nbsp;</p>

    <table style="border: 1px solid gray;" width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <th style="border-right: 1px solid gray;" width="5%">#</th>
        <th style=" border-right: 1px solid gray;">Nama Anggota</th>
        <th style="border-right: 1px solid gray;">Nomer Telepon</th>
        <th style=" border-right: 1px solid gray;">Tanggal</th>
        <th style="border-right: 1px solid gray;">Jumlah</th>
        <th style="border-right: 1px solid gray;">Status</th>
      </tr>
      @php
          $i = 0;
      @endphp
      @foreach ($keuangan as $data)
      <tr align="center">
        <td align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;">{{ ++$i }}</td>
        <td align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;">{{ $data->nama_lengkap}}</td>
        <td align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;">{{ $data->no_tlp}}</td>
        <td align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y')}}</td>
        <td align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;">Rp. {{ number_format($data->jumlah) }}</td>
        <td align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;">{{ $data->status}}</td>
      </tr>
      @endforeach
      <tr align="center">
        <th align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;"></th>
        <th align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 1px 5px;"></th>
        <th align="center" style="border-right: 3px solid gray; border-top: 1px solid gray; padding: 3px 5px;"></th>
        <th align="right" style="border-right: 0px solid gray; border-top: 4px solid gray; padding: 3px 5px;">Total = </th>
        <th align="left" style="border-right: 3px solid gray; border-top: 4px solid gray; padding: 3px 5px;">Rp. {{ number_format($total) }}</th>
        <th align="center" style="border-right: 1px solid gray; border-top: 1px solid gray; padding: 3px 5px;"></th>
      </tr>

    </table>
    <p>&nbsp;</p><p>&nbsp;</p>
<table align="right" cellpadding="0" cellspacing="0" style="margin-top: 15px">
          <center>Cirebon, {{ date("d F Y"); }}</center>
        </td>
      </tr>
      <tr>
        <td>
          <center>Cuan Bersama</center>
        </td>
      </tr>
    </table>
  </body>

</html>
