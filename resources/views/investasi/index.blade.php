@extends('layouts.investasi')
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
            <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInvestasi">
                        <i class="bi bi-file-earmark-plus me-1"></i> Tambah Data
                    </button>
            </div>

            <!-- Modal Create -->

            @include('investasi.create')

            <!-- End Modal Create -->



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
                      <th>Profit</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($investasis as $investasi)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($investasi->created_at)->format('d-M-Y') }}</td>
                            <td>{{ $investasi->coin }}</td>
                            <td class="text-center">{{ ($investasi->harga_entri) }}</td>
                            <td>Rp. {{ number_format($investasi->nominal) }}</td>
                            @if ( $investasi->status == 'Berlangsung')
                                <td class="text-center">-</td>
                                <td><h5><span class="badge bg-info text-dark">Berlangsung</span></h5></td>
                                <td>
                                    <form action="{{ route('investasi.destroy', $investasi->id_investasi) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a
                                        data-bs-toggle="modal" data-bs-target="#selesaiInvestasi{{$investasi->id_investasi}}"
                                        class="btn btn-success btn-md">
                                        <i class="bi bi-check me-2"></i>Selesai
                                        </a>
                                        <a
                                        data-bs-toggle="modal" data-bs-target="#editInvestasi{{$investasi->id_investasi}}" data-bs-title="Edit"
                                        class="btn btn-warning btn-md">
                                        <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-md"
                                            data-bs-toggle="tooltip" data-bs-title="Delete"
                                            onclick="javascript: return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            @elseif ( $investasi->status == 'Selesai')
                                <td>Rp. {{ number_format($investasi->profit) }}</td>
                                <td><h5><span class="badge bg-success text-white">Selesai</span></h5></td>
                                <td>
                                <form action="{{ route('investasi.destroy', $investasi->id_investasi) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md"
                                        data-bs-toggle="tooltip" data-bs-title="Delete"
                                        onclick="javascript: return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>

                        <!-- Modal edit -->

                        @include('investasi.edit')

                        <!-- End Modal edit -->

                        <!-- Modal selesai -->

                        @include('investasi.selesai')

                        <!-- End Modal selesai -->
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
