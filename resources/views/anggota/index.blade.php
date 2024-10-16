@extends('layouts.anggota')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Anggota</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Anggota</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnggota">
                        <i class="bi bi-file-earmark-plus me-1"></i> Tambah Data
                    </button>
            </div>

            <!-- Modal Create -->

            @include('anggota.create')

            <!-- End Modal Create -->



            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data Table Anggota Cuan Bersama</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>
                        <b>N</b>ame
                      </th>
                      <th>Email</th>
                      <th>Nomer Telepon</th>
                      {{-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> --}}
                      <th>Alamat</th>
                      <th>Total Tabungan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($anggotas as $anggota)
                        <tr>
                            <td>{{ $anggota->nama_lengkap }}</td>
                            <td>{{ $anggota->email }}</td>
                            <td>{{ ($anggota->no_tlp) }}</td>
                            <td>{{ ($anggota->alamat) }}</td>
                            <td>Rp. {{ number_format($anggota->total_tabungan) }}</td>
                            <td class="text-center">

                                <form action="{{ route('anggota.destroy', $anggota->id_anggota) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a
                                    data-bs-toggle="modal" data-bs-target="#editAnggota{{$anggota->id_anggota}}" data-bs-title="Edit"
                                    class="btn btn-warning btn-lg">
                                    <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-lg"
                                        data-bs-toggle="tooltip" data-bs-title="Delete"
                                        onclick="javascript: return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal edit -->

                        @include('anggota.edit')

                        <!-- End Modal edit -->
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
