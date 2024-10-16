@extends('layouts-anggota.keuangan')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Keuangan</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Keuangan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <div class="text-start mb-2">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#optionExport">
                            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export Pdf
                        </button>
                </div>
            <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKeuangan">
                        <i class="bi bi-file-earmark-plus me-1"></i> Tambah Tabungan
                    </button>
            </div>
            </div>

            <!-- Modal Create -->

            @include('keuangan.create-anggota')

            <!-- End Modal Create -->


            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data Table Keuangan Cuan Bersama</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($keuangans as $keuangan)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($keuangan->tanggal)->format('d-M-Y') }}</td>
                            <td>Rp. {{ number_format($keuangan->jumlah) }}</td>

                            @if ( $keuangan->status == 'Prosses')
                                <td><h5><span class="badge bg-info text-dark">Prosses</span></h5></td>
                                <td>
                                    <form action="{{ route('keuangan.batal', $keuangan->id_keuangan) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-md"
                                            data-bs-toggle="tooltip" data-bs-title="Delete"
                                            onclick="javascript: return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            @elseif ( $keuangan->status == 'Diterima')
                                <td><h5><span class="badge bg-success text-white">Diterima</span></h5></td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#check{{$keuangan->id_keuangan}}" class="btn btn-success btn-md">
                                        <i class="bi bi-eye-fill me-2"></i>Check</a>
                                </td>
                            @elseif ( $keuangan->status == 'Ditolak')
                                <td><h5><span class="badge bg-danger text-white">Ditolak</span></h5></td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#checkTolak{{$keuangan->id_keuangan}}" class="btn btn-info btn-md"> <i class="bi bi-eye-fill me-2"></i>Check</a>
                            </td>
                            @endif
                        </tr>

                        <!-- Modal Check Terima PDF -->

                        @include('keuangan.check-terima')

                        <!-- End Modal Check Terima PDF -->

                        <!-- Modal Export PDF -->

                        @include('keuangan.export')

                        <!-- End Modal Export PDF -->

                        <!-- Modal Check Tolak-->

                        @include('keuangan.check-tolak')

                        <!-- End Modal Check Tolak -->
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
