@extends('layouts-anggota.lengkapi-profile')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Lengkapi Profile Anda...</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Isi form di bawah ini untuk melengkapi data diri anda</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <!-- Vertical Form -->
          <form class="row g-3" action="{{ route('lengkapi.create') }}" method="POST">
            @csrf
            <div class="col-12">
              <label for="inputName" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" name="nama_lengkap">
            </div>
            <div class="col-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
            </div>
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Nomer Telepon</label>
              <input type="text" class="form-control" id="inputPassword4" placeholder="Nomer Telepon" name="no_tlp">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Jl.Indonesia No..." name="alamat">
            </div>
            <div class="text-start">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </div>
        </form><!-- Vertical Form -->

          </div>
        </div>
      </section>



  </main><!-- End #main -->
  @endsection
