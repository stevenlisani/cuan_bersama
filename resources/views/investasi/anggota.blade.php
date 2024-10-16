@extends('layouts-anggota.investasi')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Investasi</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Investasi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data Table Investasi Cuan Bersama</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nama Coin</th>
                      <th class="text-center">Harga Entri</th>
                      <th>Nominal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($investasis as $investasi)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($investasi->created_at)->format('d-M-Y') }}</td>
                            <td>{{ $investasi->coin }}</td>
                            <td class="text-center">{{ ($investasi->harga_entri) }}</td>
                            <td>Rp. {{ number_format($investasi->nominal) }}</td>
                            <td>{{ ($investasi->status) }}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
        </div>
      </section>



  </main><!-- End #main -->
  @endsection
